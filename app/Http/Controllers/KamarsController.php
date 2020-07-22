<?php

namespace App\Http\Controllers;

use App\Kamar;
use Illuminate\Http\Request;
use App\Post;

class KamarsController extends Controller
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
        return view ('admin.kamar.tambah',['post' => $p]);
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
                            'panjang' => 'required|numeric',
                            'lebar' => 'required|numeric',
                            'jumlah' => 'numeric'
                        ]);
        Kamar::create($request->all());
        $pesan = "Kamar <b>".$request->panjang." x ".$request->lebar.'</b> berhasil ditambahkan';
        return redirect('/post/'.$request->post_id)->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamar $kamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $kamar)
    {
        Kamar::destroy($kamar->id);
        $pesan = "kamar ".$kamar->panjang." x ".$kamar->lebar." berhasil dihapus";
        return redirect('/post/'.$kamar->post_id)->with('status2', $pesan);
    }
}
