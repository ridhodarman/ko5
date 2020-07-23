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
        $post = Post::select('posts.id', 'posts.nama', 'posts.cover', 'jenis_posts.nama AS keterangan')
                    ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->get();
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
        $query = DB::table(DB::raw('posts')) 
                        ->Select('posts.id', 'posts.nama', 'cover', 'jenis_posts.nama AS jenis', 'pembayaran')
                        ->addSelect(DB::raw("
                            min(harga) AS harga,
                            6371 * acos( 
                                cos( radians('$lat2') ) 
                                * cos( radians( posts.lat ) ) 
                                * cos( radians( posts.lng ) - radians('$lng2') ) 
                                + sin( radians('$lat2') ) 
                                * sin( radians( posts.lat ) )
                            ) as distance        
                        "))
                    ->leftJoin('hargas', 'posts.id', '=', 'hargas.post_id')
                    ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->get();

        $post = array();
        foreach ($query as $row) {
            $harga = str_replace (",", ".", number_format( $row->harga ) );
            $jarak = str_replace (".", ",", round($row->distance, 2) );
            $data = array(
                "id" => $row->id,
                "nama" => $row->nama,
                "cover" => $row->cover,
                "harga" => $row->harga,
                "harga" => "Rp. ". $harga ." / ".$row->pembayaran,
                "keterangan" => "<span class='badge badge-pill badge-light'>".$row->jenis."</span>sekitar ". $jarak ." Kilometer dari pusat ".$teks2
            );
            array_push($post, $data);
        }
        $object = json_decode(json_encode($post), FALSE);
        //return $object;
        $teks2 = base64_decode($teks);
        return view ('cari.index',[
                                    'post' => $object
                                ]);
    }

    public function nama(Request $request)
    {
        //return $request;
        $nama = strtolower($request->nama_kos);
        $post = Post::select('posts.id', 'posts.nama', 'posts.cover', 'jenis_posts.nama AS keterangan')
                    ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->where('posts.nama', 'like', '%' . $nama . '%')
                    ->get();
        return view ('cari.index',['post' => $post]);
        //return $query;
    }

    public function cari(Request $request){
        //return $request;

        $filter="";
        if (isset($request->fasilitas)){
            foreach($request->fasilitas as $f){
                $fasilitas = Fasilitas_post::select('nama')->where('id', $f)->get();
                $filter= $filter."<span class='badge badge-pill badge-light'>".$fasilitas[0]['nama']."</span> ";
            }
        }

        if (isset($request->jenis)){
            foreach($request->jenis as $j){
                $jenis = Jenis_post::select('nama')->where('id', $j)->get();
                $filter= $filter."<span class='badge badge-pill badge-warning' style='color: black;'>".$jenis[0]['nama']."</span> ";
            }
        }

        if (isset($request->status)){
            foreach($request->status as $s){
                $status = Status_post::select('nama')->where('id', $s)->get();
                $filter= $filter."<span class='badge badge-pill badge-info'>".$status[0]['nama']."</span> ";
            }
        }

        if ($request->atur_harga=="rentang"){
            $min = $harga = str_replace (",", ".", number_format( $request->min ) );
            $filter= $filter."<span class='badge badge-pill badge-success'>min: Rp. ".$min."</span> ";
            $max = $harga = str_replace (",", ".", number_format( $request->max ) );
            $filter= $filter."<span class='badge badge-pill badge-success'>max: Rp. ".$max."</span> ";
        }

        if ($request->urutan=="dekat_kampus"){
            $kampus = Kampus_sekolah::select('nama')->where('id', $request->kampus)->get();
            $filter= $filter."<span class='badge badge-pill badge-secondary'>Urutkan harga dari yang paling dekat ".$kampus[0]['nama']."</span> ";
            $urutan = 'harga ASC';
        }
        else {
            if ($request->urutan=="harga_rendah"){
                $filter= $filter."<span class='badge badge-pill badge-secondary'>Urutkan harga dari yang paling rendah</span> ";
                $urutan = 'harga ASC';
            }
            else if ($request->urutan=="harga_tinggi"){
                $filter= $filter."<span class='badge badge-pill badge-secondary'>Urutkan lokasi dari yang paling tinggi</span> ";
                $urutan = 'harga DESC';
            }
        }
        
        $post = Post::select('posts.id', 'posts.nama', 'posts.cover', 'jenis_posts.nama AS keterangan')
                    ->leftJoin('jenis_posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->get();
        return view ('cari.index',[
            'post' => $post,
            'filter' => $filter
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
