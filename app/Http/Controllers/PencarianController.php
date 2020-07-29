<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Kampus_sekolah;
use App\Fasilitas_post;
use App\Jenis_post;
use App\Status_post;
use App\Foto;
use App\Kamar;
use App\Harga;
use App\Detail_fasilitas_post;

class PencarianController extends Controller
{
    public function index()
    {
        $post = Post::select('posts.id', 'posts.nama', 'posts.cover', 'jenis_posts.nama AS jenis')
                    ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->orderByDesc('posts.created_at')
                    ->paginate(12);
                    //->get();
        return view ('cari.index',['post' => $post]);
        //return $query;
    }

    public function sidebar(){
        $fasilitas = Fasilitas_post::select('id', 'nama')->orderBy('nama')->get();
        $jenis = Jenis_post::select('id', 'nama')->orderBy('nama')->get();
        $status = Status_post::select('id', 'nama')->orderBy('nama')->get();
        $kampus = Kampus_sekolah::select('id', 'nama')->orderBy('nama')->get();
        return view ('cari.inc.sidebar',[
                                            'fasilitas' => $fasilitas,
                                            'jenis' => $jenis,
                                            'status' => $status,
                                            'kampus' => $kampus
                                        ]);
    }

    public function keyword($lat, $lng, $teks){
        $lat2 = (double)base64_decode($lat);
        $lng2 = (double)base64_decode($lng);
        $teks2 = base64_decode($teks);
        $post = DB::table(DB::raw('posts')) 
                        ->Select('posts.id', 'posts.nama', 'cover', 'jenis_posts.nama AS jenis', 'pembayaran')
                        ->addSelect(DB::raw("
                            min(harga) AS harga,
                            6371 * acos( 
                                cos( radians('$lat2') ) 
                                * cos( radians( posts.lat ) ) 
                                * cos( radians( posts.lng ) - radians('$lng2') ) 
                                + sin( radians('$lat2') ) 
                                * sin( radians( posts.lat ) )
                            ) as jarak        
                        "))
                    ->leftJoin('hargas', 'posts.id', '=', 'hargas.post_id')
                    ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->groupBy('posts.id', 'hargas.post_id')
                    ->orderBy('jarak')
                    ->paginate(12);

        $teks2 = base64_decode($teks);
        $filter = "<span class='badge badge-pill badge-primary'>sekitar ".$teks2."</span>";
        return view ('cari.index',[
                                    'post' => $post,
                                    'lokasi' => $teks2,
                                    'filter' => $filter
                                ]);
    }

    public function nama(Request $request)
    {
        //return $request;
        $nama = strtolower($request->nama_kos);
        $post = Post::select('posts.id', 'posts.nama', 'posts.cover', 'jenis_posts.nama AS keterangan')
                    ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->whereRaw("LOWER('posts.nama') LIKE '%". $nama."%'")
                    ->orderBy('posts.created_at')
                    ->paginate(12);

        $filter= "<span class='badge badge-pill badge-light'>Cari nama: <b>".$nama."</b></span> ";
        return view ('cari.index',['post' => $post, 
                                    'nama_kos' => $request->nama_kos,
                                    'filter' => $filter
                                ]);
        //return $query;
    }

    public function cari(Request $request){
        //return $request;
        $post = Post::select('posts.id', 'posts.nama', 'posts.cover', 'jenis_posts.nama AS jenis')
                ->addSelect(DB::raw("min(harga) as harga"))
                ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                ->leftJoin('hargas', 'posts.id', '=', 'hargas.post_id')
                ->groupBy('posts.id', 'hargas.post_id');
        

        $filter="";
        if (isset($request->fasilitas)){
            $total = count ($request->fasilitas);
            $post = $post->leftjoin('detail_fasilitas_posts', 'posts.id',  '=', 'detail_fasilitas_posts.post_id')
            ->whereIn('detail_fasilitas_posts.fasilitas_posts', $request->fasilitas)
            ->groupBy('detail_fasilitas_posts.post_id', 'posts.id')
            ->havingRaw('COUNT(*) = '. $total);

            foreach($request->fasilitas as $f){
                $fasilitas = Fasilitas_post::select('nama')->where('id', $f)->first();
                $filter= $filter."<span class='badge badge-pill badge-light'>".$fasilitas->nama."</span> ";
            }
        }

        if (isset($request->jenis)){
            $post = $post->whereIn('jenis_posts.id', $request->jenis);
            foreach($request->jenis as $j){
                $jenis = Jenis_post::select('nama')->where('id', $j)->first();
                $filter= $filter."<span class='badge badge-pill badge-warning' style='color: black;'>".$jenis->nama."</span> ";
            }
        }

        if (isset($request->status)){
            $post = $post->whereIn('posts.status_posts', $request->status);
            foreach($request->status as $s){
                $status = Status_post::select('nama')->where('id', $s)->first();
                $filter= $filter."<span class='badge badge-pill badge-info'>".$status->nama."</span> ";
            }
        }

        if ($request->atur_harga=="rentang"){
            $post = $post->whereBetween('harga', [$request->min, $request->max]);
            $min = $harga = str_replace (",", ".", number_format( $request->min ) );
            $filter= $filter."<span class='badge badge-pill badge-success'>min: Rp. ".$min."</span> ";
            $max = $harga = str_replace (",", ".", number_format( $request->max ) );
            $filter= $filter."<span class='badge badge-pill badge-success'>max: Rp. ".$max."</span> ";
            
        }

        $lokasi = "kampus ";
        if ($request->urutan=="dekat_kampus"){
            $kampus = Kampus_sekolah::select('nama', 'lat', 'lng')->where('id', $request->kampus)->first();
            $lokasi = $lokasi.$kampus->nama;
            $filter= $filter."<span class='badge badge-pill badge-secondary'>Urutkan lokasi dari yang paling dekat ".$kampus->nama."</span> ";
            
            $post = $post->addSelect(DB::raw("
                            CONCAT_WS(' Kilometer perkiraan jarak dari pusat kampus ',
                                ROUND(
                                    6371 * acos( 
                                        cos( radians( $kampus->lat ) ) 
                                        * cos( radians( posts.lat ) ) 
                                        * cos( radians( posts.lng ) - radians( $kampus->lng ) ) 
                                        + sin( radians( $kampus->lat ) ) 
                                        * sin( radians( posts.lat ) )
                                    ) 
                                , 2) 
                            , '$kampus->nama') AS jarak
                        "));
        }
        else {
            if ($request->urutan=="harga_rendah"){
                $filter= $filter."<span class='badge badge-pill badge-secondary'>Urutkan harga dari yang paling rendah</span> ";
                $post = $post->orderBy('harga', 'asc');
            }
            else if ($request->urutan=="harga_tinggi"){
                $filter= $filter."<span class='badge badge-pill badge-secondary'>Urutkan lokasi dari yang paling tinggi</span> ";
                $post = $post->orderBy('harga', 'desc');
            }
        }
        

        $post = $post->paginate(12);
        // foreach ($post as $p){
        //     if($p->id==null){
        //         $post = [];
        //         $post = json_decode(json_encode($post), FALSE);
        //     }
        // }

        // $array = array();
        // foreach ($post as $row) {
        //     $harga = str_replace (",", ".", number_format( $row->harga ) );
        //     $jarak = str_replace (".", ",", round($row->distance, 2) );
        //     $data = array(
        //         "id" => $row->id,
        //         "nama" => $row->nama,
        //         "cover" => $row->cover,
        //         "harga" => "Rp. ". $harga ." / ".$row->pembayaran,
        //         "keterangan" => $row->keterangan
        //     );
        //     array_push($array, $data);
        // }
        // $post = json_decode(json_encode($array), FALSE);

        //return $post;
        return view ('cari.index',[
            'post' => $post,
            'filter' => $filter,
            'lokasi' => $lokasi            
        ]);
    }

    public function show($id){
        $post = Post::select('posts.*', 
                                'jenis_posts.nama AS jenis', 
                                'status_posts.nama AS status',
                                'kelurahans.nama AS kelurahan',
                                'kecamatans.nama AS kecamatan'
                            )
                ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                ->leftJoin('status_posts', 'posts.status_posts', '=', 'status_posts.id')
                ->leftJoin('kelurahans', 'posts.kelurahan_id', '=', 'kelurahans.id')
                ->leftJoin('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
                ->where('posts.id', $id)->get();
        $foto = Foto::select('url')->where('post_id', $id)->get();
        $kamar = Kamar::select('panjang', 'lebar', 'jumlah')->where('post_id', $id)->get();
        $harga = Harga::select('harga', 'pembayaran', 'keterangan')->where('post_id', $id)->get();

        $fasilitas = Detail_fasilitas_post::select('fasilitas_posts.nama')
                ->leftJoin('fasilitas_posts', 'detail_fasilitas_posts.fasilitas_posts', '=', 'fasilitas_posts.id')
                ->where('detail_fasilitas_posts.post_id', $id)->get();
        
        //return $fasilitas;
        return view ('cari.show',[
            'post' => $post,
            'foto' => $foto,
            'kamar' => $kamar,
            'harga' => $harga,
            'fasilitas' => $fasilitas
        ]);
    }
}
