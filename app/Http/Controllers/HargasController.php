<?php

namespace App\Http\Controllers;

use App\Harga;
use Illuminate\Http\Request;
use App\Post;

class HargasController extends Controller
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
        return view ('admin.harga.tambah',['post' => $p]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 'harga' => 'numeric' ]);
        Harga::create($request->all());
        $pesan = "Harga per <b>".$request->pembayaran.'</b> berhasil ditambahkan';
        return redirect('/post/'.$request->post_id)->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function show(Harga $harga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function edit(Harga $harga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Harga $harga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Harga $harga, $post)
    {
        Harga::destroy($harga->id);
        $pesan = "harga berhasil dihapus";
        return redirect('/post/'.$post)->with('status2', $pesan);
    }
}
