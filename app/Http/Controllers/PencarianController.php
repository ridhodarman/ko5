<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Kampus_sekolah;
use App\Fasilitas_post;
use App\Jenis_post;
use App\Status_post;

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
        $fasilitas = Fasilitas_post::select('id', 'nama')->get();
        $jenis = Jenis_post::select('id', 'nama')->get();
        $status = Status_post::select('id', 'nama')->get();
        return view ('cari.inc.sidebar',[
                                            'fasilitas' => $fasilitas,
                                            'jenis' => $jenis,
                                            'status' => $status
                                        ]);
    }

    public function keyword($jenis, $kampus, $teks){
        $kampus = Kampus_sekolah::where('id', $kampus)->first();
        //return $kampus;
        $query = DB::table(DB::raw('posts, kampus_sekolahs')) 
                        ->Select('posts.id', 'posts.nama', 'cover', 'kampus_sekolahs.nama AS kampus')
                        ->addSelect(DB::raw('
                            6371 * acos( 
                                cos( radians(-0.3198473) ) 
                                * cos( radians( posts.lat ) ) 
                                * cos( radians( posts.lng ) - radians(100.3918649) ) 
                                + sin( radians(-0.3198473) ) 
                                * sin( radians( posts.lat ) )
                            ) as distance        
                        '))
                    ->where('posts.jenis_posts', '=', '?')
                    ->setBindings([$jenis])
                    ->orderBy('distance')
                    ->get();

        $post = array();
        foreach ($query as $row) {
            $data = array(
                "id" => $row->id,
                "nama" => $row->nama,
                "cover" => $row->cover,
                "keterangan" => "sekitar ".round($row->distance, 2)." meter dari pusat kampus ".$row->kampus
            );
            array_push($post, $data);
        }
        $object = json_decode(json_encode($post), FALSE);
        //return $object;
        $teks2 = base64_decode($teks);
        return view ('cari.index',[
                                    'post' => $object,
                                    'teks' => $teks2
                                ]);
    }

    public function show($id){
        $post = Post::where('id', $id)->get();
        //return $kampus;
        
        //return $post;
        return view ('cari.show',[
            'post' => $post
        ]);
    }
}
