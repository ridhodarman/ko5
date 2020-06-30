<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::select('id','nama','alamat','created_at')
                            ->get();
        //return $post;
        return view ('admin.post.index',['post' => $post]);
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
        $this->validate($request, [
			'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8000|unique:posts,cover',
			'nama' => 'required',
		]);
        
        $file = $request->file('file');
 
            // nama file
        echo 'File Name: '.$file->getClientOriginalName();
        echo '<br>';

                // ekstensi file
        echo 'File Extension: '.$file->getClientOriginalExtension();
        echo '<br>';

                // real path
        echo 'File Real Path: '.$file->getRealPath();
        echo '<br>';

                // ukuran file
        echo 'File Size: '.$file->getSize();
        echo '<br>';

                // tipe mime
        echo 'File Mime Type: '.$file->getMimeType();
        echo '<br>';

        $nama_file = $request->nama."_".time().".".$file->getClientOriginalExtension();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'foto';
        $file->move($tujuan_upload,$nama_file);

        $request->merge([
            'cover' => $nama_file,
        ]);
        
        

        //dd ($request);
        Post::create($request->all());

        $pesan = "<b>".$request->nama.'</b> berhasil ditambahkan';
        return redirect('/post')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $query = Post::select('posts.*', 
                            'kelurahans.nama AS kelurahan',
                            'kecamatans.nama AS kecamatan',
                            'users.name AS pemilik'
                            )
                    ->leftJoin('kelurahans', 'kelurahans.id', '=', 'posts.kelurahan_id')
                    ->leftJoin('kecamatans', 'kecamatans.id', '=', 'kelurahans.kecamatan_id')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->where('posts.id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        //return $query;
        return view ('admin.post.view',['post' => $query]);
    }

    public function view_edit($post)
    {
        $query = Post::select('posts.*', 
                            'kelurahans.nama AS kelurahan', 'kelurahans.id AS kelurahan_id',
                            'kecamatans.nama AS kecamatan', 'kecamatans.id AS kecamatan_id',
                            'users.name AS pemilik'
                            )
                    ->leftJoin('kelurahans', 'kelurahans.id', '=', 'posts.kelurahan_id')
                    ->leftJoin('kecamatans', 'kecamatans.id', '=', 'kelurahans.kecamatan_id')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->where('posts.id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        //return $query;
        return view ('admin.post.edit',['post' => $query]);
    }

    public function view_add()
    {
        $query = Post::select('posts.*', 
                            'kelurahans.nama AS kelurahan', 'kelurahans.id AS kelurahan_id',
                            'kecamatans.nama AS kecamatan', 'kecamatans.id AS kecamatan_id',
                            'users.name AS pemilik'
                            )
                    ->leftJoin('kelurahans', 'kelurahans.id', '=', 'posts.kelurahan_id')
                    ->leftJoin('kecamatans', 'kecamatans.id', '=', 'kelurahans.kecamatan_id')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->where('posts.id', '=', '?')
                    ->setBindings([1])
                    ->get();
        //return $query;
        return view ('admin.post.tambah',
                        ['post' => $query]
                    );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
