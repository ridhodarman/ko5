<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use Illuminate\Http\Request;

class KecamatansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan = Kecamatan::select('id','nama')
                            ->get();
        return view ('admin.kecamatan.index',['kecamatan' => $kecamatan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kecamatan.tambah');
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
            'nama' => 'required|unique:kecamatans|not_regex:/`/i'
        ]);
        Kecamatan::create($request->all());
        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/kecamatan')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show($kecamatan)
    {
        $query = Kecamatan::select('kecamatans.*')
                    ->selectRaw('count(posts.id) as jumlah')
                    ->selectRaw('count(kelurahans.id) as jumlah_kel')
                    ->leftJoin('kelurahans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
                    ->leftJoin('posts', 'posts.kelurahan_id', '=', 'kelurahans.id')
                    ->groupBy('kecamatans.id')
                    ->orderBy('kecamatans.nama')
                    ->where('kecamatans.id', '=', '?')
                    ->setBindings([$kecamatan])
                    ->get();
        return view ('admin.kecamatan.view',['kecamatan' => $query]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        return view ('admin.kecamatan.edit', compact('kecamatan') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama' => 'required|unique:kecamatans|not_regex:/`/i'
        ]);
        Kecamatan::where('id', $kecamatan->id)
            ->update([
                'nama' => $request->nama
            ]);
        $pesan = "Nama kecamatan berhasil diubah menjadi <b>".$request->nama.'</b>';
        return redirect('/kecamatan')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        Kecamatan::destroy($kecamatan->id);
        $pesan = "Kecamatan '<b>".$kecamatan->nama."</b>' berhasil dihapus !";
        return redirect('/kecamatan')->with('status-hapus', $pesan);
    }
}
