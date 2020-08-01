<?php

namespace App\Http\Controllers;

use App\Foto;
use Illuminate\Http\Request;
use App\Post;
use File;

class FotosController extends Controller
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
        return view ('admin.foto.tambah',['post' => $p]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000|unique:fotos,url,required'
		]);
        $file = $request->file('file');

        $p = Post::select('id','nama')->where('id', $request->post_id)->first();
        $nama2 = preg_replace('/[^A-Za-z0-9\-]/', '', $p->nama);
        $nama_file = $nama2."_".time().".".$file->getClientOriginalExtension();
        $tujuan_upload = 'foto';
        $file->move($tujuan_upload,$nama_file);

        $request->merge([ 'url' => $nama_file]);

        Foto::create($request->all());
        $pesan = "Foto berhasil ditambahkan";
        return redirect('/post/'.$request->post_id)->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        $gambar = Foto::where('id', $foto->id)->first();
        File::delete('foto/'.$gambar->url);
    
        Foto::destroy($foto->id);
        $pesan = "foto berhasil dihapus";
        return redirect('/post/'.$foto->post_id)->with('status2', $pesan);
    }
}
