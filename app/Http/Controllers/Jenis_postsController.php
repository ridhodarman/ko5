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
        $jenis = Jenis_post::select('id','nama')
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jenis_post  $jenis_post
     * @return \Illuminate\Http\Response
     */
    public function show($jenis_post)
    {
        $query = Jenis_post::select('jenis_posts.*')
                    ->selectRaw('count(posts.id) as jumlah')
                    ->leftJoin('posts', 'posts.jenis_posts', '=', 'jenis_posts.id')
                    ->groupBy('jenis_posts.id')
                    ->orderBy('jenis_posts.nama')
                    ->where('jenis_posts.id', '=', '?')
                    ->setBindings([$jenis_post])
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jenis_post  $jenis_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis_post $jenis_post)
    {
        //
    }
}
