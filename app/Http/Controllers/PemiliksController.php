<?php

namespace App\Http\Controllers;

use App\Pemilik;
use App\User;
use Illuminate\Http\Request;

class PemiliksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Pemilik::select('id', 'nama')
                    ->get();
        return view ('admin.pemilik.index',['pemilik' => $query]);
        //return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('id', 'name','email')->get();

        return view('admin.pemilik.tambah',['user' => $user]);
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
            'nama' => 'required|not_regex:/`/i'
        ]);
        Pemilik::create($request->all());
        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/pemilik')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function show($pemilik)
    {
        $query = Pemilik::select('pemiliks.*', 'posts.nama AS post', 'posts.id AS post_id')
                    ->leftJoin('posts', 'posts.pemilik_id', '=', 'pemiliks.id')
                    ->where('pemiliks.id', '=', '?')
                    ->setBindings([$pemilik])
                    ->get();
        return view ('admin.pemilik.view',['pemilik' => $query]);
        //return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemilik $pemilik)
    {
        $user = User::select('id', 'name','email')->get();
        return view ('admin.pemilik.edit', ['pemilik' => $pemilik, 'user' => $user] );
        //return $pemilik;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        $request->validate([
            'nama' => 'required|unique:pemiliks|not_regex:/`/i'
        ]);
        Pemilik::where('id', $pemilik->id)
            ->update([
                'nama' => $request->nama,
                'kontak' => $request->kontak,
                'deskripsi' => $request->deskripsi
            ]);
        $pesan = "Data pemilik `<b>".$request->nama."</b>` berhasil diubah";
        return redirect('/pemilik')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemilik $pemilik)
    {
        Pemilik::destroy($pemilik->id);
        $pesan = "Pemilik '<b>".$pemilik->nama."</b>' berhasil dihapus !";
        return redirect('/pemilik')->with('status-hapus', $pesan);
    }
}
