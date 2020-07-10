<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use App\Kecamatan;
use Illuminate\Http\Request;

class KelurahansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = Kelurahan::select('kelurahans.id','kelurahans.nama', 'kecamatans.nama AS kecamatan')
                            ->leftJoin('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
                            ->get();
        //return $kelurahan;
        return view ('admin.kelurahan.index',['kelurahan' => $kelurahan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::select('id','nama')
                            ->get();

        return view('admin.kelurahan.tambah',['kecamatan' => $kecamatan]);
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
            'nama' => 'required|unique:kelurahans|not_regex:/`/i'
        ]);
        Kelurahan::create($request->all());
        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/kelurahan')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show($kelurahan)
    {
        $query = Kelurahan::select('kelurahans.*', 'kecamatans.nama AS kecamatan')
                    ->selectRaw('count(posts.id) as jumlah')
                    ->leftJoin('posts', 'posts.kelurahan_id', '=', 'kelurahans.id')
                    ->leftJoin('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
                    ->groupBy('kelurahans.id')
                    ->orderBy('kelurahans.nama')
                    ->where('kelurahans.id', '=', '?')
                    ->setBindings([$kelurahan])
                    ->get();
        return view ('admin.kelurahan.view',['kelurahan' => $query]);
        //return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        $kecamatan = Kecamatan::select('id AS kecamatan_id','nama AS kecamatan')
                            ->get();
        return view ('admin.kelurahan.edit', ['kelurahan' => $kelurahan, 'kecamatan' => $kecamatan] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        Kelurahan::destroy($kelurahan->id);
        $pesan = "Kelurahan '<b>".$kelurahan->nama."</b>' berhasil dihapus !";
        return redirect('/kelurahan')->with('status-hapus', $pesan);
    }
}
