<?php

namespace App\Http\Controllers;

use App\Jenis_post;
use Illuminate\Http\Request;
use DB;

class Jenis_postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenis_post::select('id','nama')->orderBy('nama')
                            ->get();
        //return $jenis;
        return view ('admin.jenis.index',['jenis' => $jenis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenis.tambah');
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
            'nama' => 'required|unique:jenis_posts|not_regex:/`/i'
        ]);
        Jenis_post::create($request->all());
        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/jenis')->with('jenis', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jenis_post  $jenis_post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Jenis_post::select('jenis_posts.*')
                    ->selectRaw('count(posts.id) as jumlah')
                    ->leftJoin('posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->groupBy('jenis_posts.id')
                    ->orderBy('jenis_posts.nama')
                    ->where('jenis_posts.id', '=', '?')
                    ->setBindings([$id])
                    ->get();
        //return $query;
        return view ('admin.jenis.view',['jenis' => $query]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jenis_post  $jenis_post
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis_post $jenis_post)
    {
        return view ('admin.jenis.edit', compact('jenis_post') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jenis_post  $jenis_post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis_post $jenis_post)
    {
        $request->validate([
            'nama' => 'required|unique:jenis_posts|not_regex:/`/i'
        ]);
        Jenis_post::where('id', $jenis_post->id)
            ->update([
                'nama' => $request->nama
            ]);
        $pesan = "Nama jenis berhasil diubah menjadi <b>".$request->nama.'</b>';
        return redirect('/jenis')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jenis_post  $jenis_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis_post $jenis_post)
    {
        Jenis_post::destroy($jenis_post->id);
        $pesan = "Jenis post '<b>".$jenis_post->nama."</b>' berhasil dihapus !";
        return redirect('/jenis')->with('hapus', $pesan);
    }
}
