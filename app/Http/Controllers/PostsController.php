<?php

namespace App\Http\Controllers;

use App\Post;
use App\Jenis_post;
use App\Status_post;
use App\Kecamatan;
use App\Pemilik;
use Illuminate\Http\Request;
use File;

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
    public function edit($post)
    {
        $jenis = Jenis_post::select('id','nama')->get();
        $status = Status_post::select('id','nama')->get();
        $pemilik = Pemilik::select('id','nama')->get();
        $kecamatan = Kecamatan::select('id','nama')->get();
        $query = Post::select('posts.*', 'kecamatans.id AS kecamatan_id')
                    ->leftJoin('kelurahans', 'kelurahans.id', '=', 'posts.kelurahan_id')
                    ->leftJoin('kecamatans', 'kecamatans.id', '=', 'kelurahans.kecamatan_id')
                    ->where('posts.id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        return view('admin.post.edit',[
                                        'jenis' => $jenis,
                                        'status' => $status,
                                        'post' => $query,
                                        'kecamatan' => $kecamatan,
                                        'pemilik' => $pemilik
                                        ]);
        //return $query;
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
                'nama' => $request->nama,
                'jenis_posts' => $request->jenis_posts,
                'alamat' => $request->alamat,
                'status_posts' => $request->status_posts,
                'deskripsi' => $request->deskripsi,
                'kelurahan_id' => $request->kelurahan_id,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'pemilik_id' => $request->pemilik_id
            ]);
        $pesan = "Data post <b>".$request->nama."</b> berhasil diubah";
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

    public function destroy_foto(Post $post)
    {   
        // hapus file
        $gambar = Post::where('id', $post->id)->first();
        File::delete('foto/'.$gambar->cover);
    
        Post::where('id', $post->id)
            ->update([
                'cover' => null
            ]);
        $pesan = "Foto depan berhasil dihapus !";
        return redirect()->back()->with('status-foto', $pesan);
    }

    public function edit_foto(Post $post)
    {   
        return view ('admin.post.edit-foto', compact('post') );
    }

    public function update_foto(Request $request, Post $post)
    {   
        $this->validate($request, [
			'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000|unique:posts,cover,required'
		]);
        $file = $request->file('file');
        $nama_file = $request->nama."_".time().".".$file->getClientOriginalExtension();
        $tujuan_upload = 'foto';
        $file->move($tujuan_upload,$nama_file);
        
        Post::where('id', $post->id)
            ->update([
                'cover' => $nama_file
            ]);
        $pesan = "Foto depan berhasil di-upload !";
        return redirect('/post/'.$post->id)->with('status-foto', $pesan);
    }
}
