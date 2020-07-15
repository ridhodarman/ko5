<?php

namespace App\Http\Controllers;

use App\Kampus_sekolah;
use Illuminate\Http\Request;

class Kampus_sekolahsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kampus = Kampus_sekolah::select('id','nama')
                            ->get();
        return view ('admin.kampus.index',['kampus' => $kampus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kampus.tambah');
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
            'nama' => 'required|unique:kampus_sekolahs|not_regex:/`/i',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        Kampus_sekolah::create($request->all());
        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/kampus')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kampus_sekolah  $kampus_sekolah
     * @return \Illuminate\Http\Response
     */
    public function show($kampus)
    {
        $query = Kampus_sekolah::select('*')
                    ->where('id', '=', '?')
                    ->setBindings([$kampus])
                    ->get();
        return view ('admin.kampus.view',['kampus' => $query]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kampus_sekolah  $kampus_sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Kampus_sekolah $kampus_sekolah)
    {
        return view ('admin.kampus.edit', compact('kampus_sekolah') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kampus_sekolah  $kampus_sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kampus_sekolah $kampus_sekolah)
    {
        $request->validate([
            'nama' => 'required|unique:kampus_sekolahs,id|not_regex:/`/i',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        Kampus_sekolah::where('id', $kampus_sekolah->id)
            ->update([
                'nama' => $request->nama
            ]);
        $pesan = "Data kampus <b>".$request->nama.'</b> berhasil diubah';
        return redirect('/kampus')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kampus_sekolah  $kampus_sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kampus_sekolah $kampus_sekolah)
    {
        Kampus_sekolah::destroy($kampus_sekolah->id);
        $pesan = "Kampus '<b>".$kampus_sekolah->nama."</b>' berhasil dihapus !";
        return redirect('/kampus')->with('status-hapus', $pesan);
    }
}
