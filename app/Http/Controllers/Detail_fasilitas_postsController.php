<?php

namespace App\Http\Controllers;

use App\Detail_fasilitas_post;
use Illuminate\Http\Request;
use App\Fasilitas_post;
use App\Post;

class Detail_fasilitas_postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post)
    {
        $p = Post::select('id','nama')->where('id', $post)->first();
        $fasilitas = Fasilitas_post::select('id','nama')->orderBy('nama')->get();
        return view ('admin.detail_fasilitas.tambah',['post' => $p, 'fasilitas' => $fasilitas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['fasilitas_posts' => 'required']);
        $f = Fasilitas_post::where('id', $request->fasilitas_posts)->first();
        $cek = Detail_fasilitas_post::where([
            ['post_id', '=', $request->post_id],
            ['fasilitas_posts', $request->fasilitas_posts],
        ])->get();
        $row = count($cek);
        
        if ($row == 0) {
            Detail_fasilitas_post::create($request->all());
            $pesan = "<b>".$f->nama.'</b> berhasil ditambahkan';
            return redirect('/post/'.$request->post_id)->with('status', $pesan);
        }
        else {
            $pesan = "fasilitas <b>".$f->nama.'</b> sudah ada';
            return redirect('/post/'.$request->post_id)->with('status2', $pesan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detail_fasilitas_post  $detail_fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function show(Detail_fasilitas_post $detail_fasilitas_post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detail_fasilitas_post  $detail_fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail_fasilitas_post $detail_fasilitas_post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detail_fasilitas_post  $detail_fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail_fasilitas_post $detail_fasilitas_post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detail_fasilitas_post  $detail_fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail_fasilitas_post $detail_fasilitas_post)
    {
        //return $detail_fasilitas_post;
        Detail_fasilitas_post::destroy($detail_fasilitas_post->id);
        $f = Fasilitas_post::where('id', $detail_fasilitas_post->fasilitas_posts)->first();
        $pesan = "Fasilitas '<b>".$f->nama."</b>' berhasil dihapus !";
        return redirect('/post/'.$detail_fasilitas_post->post_id)->with('status2', $pesan);
    }
}
