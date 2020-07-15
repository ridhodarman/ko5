<?php

namespace App\Http\Controllers;

use App\Fasilitas_post;
use Illuminate\Http\Request;

class Fasilitas_postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = Fasilitas_post::select('id','nama')
                            ->get();
        //return $fasilitas;
        return view ('admin.fasilitas.index',['fasilitas' => $fasilitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fasilitas.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:fasilitas_posts|not_regex:/`/i'
        ]);
        Fasilitas_post::create($request->all());
        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/fasilitas')->with('fasilitas', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fasilitas_post  $fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Fasilitas_post::select('fasilitas_posts.*')
                    ->selectRaw('count(posts.id) as jumlah')
                    ->leftJoin('detail_fasilitas_posts', 'detail_fasilitas_posts.fasilitas_posts', '=', 'fasilitas_posts.id')
                    ->leftJoin('posts', 'posts.id', '=', 'detail_fasilitas_posts.post_id')
                    ->groupBy('fasilitas_posts.id')
                    ->orderBy('fasilitas_posts.nama')
                    ->where('fasilitas_posts.id', '=', '?')
                    ->setBindings([$id])
                    ->get();
        //return $query;
        return view ('admin.fasilitas.view',['fasilitas' => $query]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fasilitas_post  $fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function edit(Fasilitas_post $fasilitas_post)
    {
        return view ('admin.fasilitas.edit', compact('fasilitas_post') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fasilitas_post  $fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fasilitas_post $fasilitas_post)
    {
        $request->validate([
            'nama' => 'required|unique:fasilitas_posts|not_regex:/`/i'
        ]);
        Fasilitas_post::where('id', $fasilitas_post->id)
            ->update([
                'nama' => $request->nama
            ]);
        $pesan = "Nama fasilitas berhasil diubah menjadi <b>".$request->nama.'</b>';
        return redirect('/fasilitas')->with('fasilitas', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fasilitas_post  $fasilitas_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fasilitas_post $fasilitas_post)
    {
        Fasilitas_post::destroy($fasilitas_post->id);
        $pesan = "Fasilitas '<b>".$fasilitas_post->nama."</b>' berhasil dihapus !";
        return redirect('/fasilitas')->with('fasilitas-hapus', $pesan);
        //return $fasilitas_post;
    }

}
