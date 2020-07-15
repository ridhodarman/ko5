<?php

namespace App\Http\Controllers;

use App\Post;
use App\Jenis_post;
use App\Status_post;
use App\Kecamatan;
use App\Pemilik;
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
        $jenis = Jenis_post::select('id','nama')->get();
        $status = Status_post::select('id','nama')->get();
        $kecamatan = Kecamatan::select('id','nama')->get();
        $pemilik = Pemilik::select('id','nama')->get();
        return view('admin.post.tambah',[
                                        'jenis' => $jenis,
                                        'status' => $status,
                                        'kecamatan' => $kecamatan,
                                        'pemilik' => $pemilik
                                        ]);
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
			'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000|unique:posts,cover',
            'nama' => 'required|not_regex:/`/i',
            'alamat' => 'not_regex:/`/i',
            'deskripsi' => 'not_regex:/`/i',
            'lat' => 'numeric',
            'lng' => 'numeric'
		]);
        
        $file = $request->file('file');
        
        if ($request->file){
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
        }
        
        

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
    public function show($post)
    {
        $query = Post::select('posts.*', 
                            'kelurahans.nama AS kelurahan',
                            'kecamatans.nama AS kecamatan',
                            'pemiliks.nama AS pemilik',
                            'jenis_posts.nama AS jenis',
                            'status_posts.nama AS status'
                            )
                    ->leftJoin('kelurahans', 'kelurahans.id', '=', 'posts.kelurahan_id')
                    ->leftJoin('kecamatans', 'kecamatans.id', '=', 'kelurahans.kecamatan_id')
                    ->leftJoin('jenis_posts', 'jenis_posts.id', '=', 'posts.jenis_posts')
                    ->leftJoin('status_posts', 'status_posts.id', '=', 'posts.status_posts')
                    ->leftJoin('pemiliks', 'pemiliks.id', '=', 'posts.pemilik_id')
                    ->where('posts.id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        //return $query;
        return view ('admin.post.view',['post' => $query]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $jenis = Jenis_post::select('id','nama')->get();
        $status = Status_post::select('id','nama')->get();
        $pemilik = Pemilik::select('id','nama')->get();
        $kecamatan = Kecamatan::select('id','nama')->get();
        return view('admin.post.edit',[
                                        'jenis' => $jenis,
                                        'status' => $status,
                                        'post' => $post,
                                        'kecamatan' => $kecamatan,
                                        'pemilik' => $pemilik
                                        ]);
        //return $post;
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
        $this->validate($request, [
            'nama' => 'required|not_regex:/`/i',
            'alamat' => 'not_regex:/`/i',
            'deskripsi' => 'not_regex:/`/i',
            'lat' => 'numeric',
            'lng' => 'numeric'
		]);
        Post::where('id', $post->id)
            ->update([
                'nama' => $request->nama
            ]);
        $pesan = "Nama post berhasil diubah menjadi <b>".$request->nama.'</b>';
        return redirect('/post')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        $pesan = "Post '<b>".$post->nama."</b>' berhasil dihapus !";
        return redirect('/post')->with('status-hapus', $pesan);
    }
}
