<?php

namespace App\Http\Controllers;

use App\Status_post;
use Illuminate\Http\Request;

class Status_postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status_post::select('id','nama')
                            ->get();
        //return $status;
        return view ('admin.status.index',['status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.status.tambah');
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
            'nama' => 'required|unique:status_posts|not_regex:/`/i'
        ]);
        Status_post::create($request->all());
        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/status')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status_post  $status_post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Status_post::select('status_posts.*')
                    ->selectRaw('count(posts.id) as jumlah')
                    ->leftJoin('posts', 'posts.status_posts', '=', 'status_posts.id')
                    ->groupBy('status_posts.id')
                    ->orderBy('status_posts.nama')
                    ->where('status_posts.id', '=', '?')
                    ->setBindings([$id])
                    ->get();
        //return $query;
        return view ('admin.status.view',['status' => $query]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status_post  $status_post
     * @return \Illuminate\Http\Response
     */
    public function edit(Status_post $status_post)
    {
        return view ('admin.status.edit', compact('status_post') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status_post  $status_post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status_post $status_post)
    {
        $request->validate([
            'nama' => 'required|unique:status_posts,id|not_regex:/`/i'
        ]);
        Status_post::where('id', $status_post->id)
            ->update([
                'nama' => $request->nama
            ]);
        $pesan = "Nama status berhasil diubah menjadi <b>".$request->nama.'</b>';
        return redirect('/status')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status_post  $status_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status_post $status_post)
    {
        Status_post::destroy($status_post->id);
        $pesan = "Status '<b>".$status_post->nama."</b>' berhasil dihapus !";
        return redirect('/status')->with('status-hapus', $pesan);
        //return $status_post;
    }

}
