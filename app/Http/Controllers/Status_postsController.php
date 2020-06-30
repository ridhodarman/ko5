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
     * @param  \App\Status_post  $status_post
     * @return \Illuminate\Http\Response
     */
    public function show($status_post)
    {
        $query = Status_post::select('status_posts.*')
                    ->selectRaw('count(posts.id) as jumlah')
                    ->leftJoin('posts', 'posts.status_posts', '=', 'status_posts.id')
                    ->groupBy('status_posts.id')
                    ->orderBy('status_posts.nama')
                    ->where('status_posts.id', '=', '?')
                    ->setBindings([$status_post])
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status_post  $status_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status_post $status_post)
    {
        //
    }
}
