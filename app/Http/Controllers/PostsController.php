<?php

namespace App\Http\Controllers;

use App\Post;
use App\Jenis_post;
use App\Status_post;
use App\Kecamatan;
use App\Pemilik;
use App\Detail_fasilitas_post;
use App\Harga;
use App\Foto;
use App\Kamar;
use App\Kampus_sekolah;
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
        $jenis = Jenis_post::select('id','nama')->orderBy('nama')->get();
        $status = Status_post::select('id','nama')->orderBy('nama')->get();
        $kecamatan = Kecamatan::select('id','nama')->orderBy('nama')->get();
        $pemilik = Pemilik::select('id','nama')->orderBy('nama')->get();
        $kampus = Kampus_sekolah::select('nama','lat', 'lng')->orderBy('nama')->get();
        return view('admin.post.tambah',[
                                        'jenis' => $jenis,
                                        'status' => $status,
                                        'kecamatan' => $kecamatan,
                                        'pemilik' => $pemilik,
                                        'kampus' => $kampus
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
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable',
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

            $nama2 = preg_replace('/[^A-Za-z0-9\-]/', '', $request->nama);
            $nama_file = $nama2."_".time().".".$file->getClientOriginalExtension();
    
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
                            'pemiliks.id AS pemilik_id',
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
        $fasilitas = Detail_fasilitas_post::select('detail_fasilitas_posts.id', 'fasilitas_posts.nama')
                    ->leftJoin('fasilitas_posts', 'fasilitas_posts.id', '=', 'detail_fasilitas_posts.fasilitas_posts')
                    ->where('detail_fasilitas_posts.post_id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        //return $fasilitas;
        $harga = Harga::select('id', 'harga', 'pembayaran', 'keterangan')
                    ->where('post_id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        $foto = Foto::select('id','url')
                    ->where('post_id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        //return $foto;
        $kamar = Kamar::select('id', 'panjang', 'lebar', 'jumlah')
                    ->where('post_id', '=', '?')
                    ->setBindings([$post])
                    ->get();
        return view ('admin.post.view',[
                                        'post' => $query,
                                        'fasilitas' => $fasilitas,
                                        'harga' => $harga,
                                        'foto' => $foto,
                                        'kamar' => $kamar
                                    ]);
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
        $kampus = Kampus_sekolah::select('nama','lat', 'lng')->orderBy('nama')->get();
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
                                        'pemilik' => $pemilik,
                                        'kampus' => $kampus
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
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable'
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
                'link_kontak' => $request->link_kontak,
                'pemilik_id' => $request->pemilik_id
            ]);
        $pesan = "Data post <b>".$request->nama."</b> berhasil diubah";
        return redirect('/post/'.$post->id)->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        $gambar = Post::where('id', $post->id)->first();
        File::delete('foto/'.$gambar->cover);
        
        //hapus foto
        $foto = Foto::where('post_id', $post->id)->get();
        foreach ($foto as $f){
            File::delete('foto/'.$f->url);
        }

        Post::destroy($post->id);
        $pesan = "Post '<b>".$post->nama."</b>' berhasil dihapus !";
        return redirect('/post')->with('status-hapus', $pesan);
    }

    public function destroy_cover(Post $post)
    {   
        // hapus cover
        $gambar = Post::where('id', $post->id)->first();
        File::delete('foto/'.$gambar->cover);
    
        Post::where('id', $post->id)
            ->update([
                'cover' => null
            ]);
        $pesan = "Foto depan berhasil dihapus !";
        return redirect()->back()->with('status', $pesan);
    }

    public function edit_cover(Post $post)
    {   
        return view ('admin.post.edit-foto', compact('post') );
    }

    public function update_cover(Request $request, Post $post)
    {   
        $gambar = Post::where('id', $post->id)->first();
        if($gambar->cover){
            File::delete('foto/'.$gambar->cover);
        }
        
        $this->validate($request, [
			'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000|unique:posts,cover,required'
		]);
        $file = $request->file('file');
        $nama2 = preg_replace('/[^A-Za-z0-9\-]/', '', $request->nama);
        $nama_file = $nama2."_".time().".".$file->getClientOriginalExtension();
        $tujuan_upload = 'foto';
        $file->move($tujuan_upload,$nama_file);
        
        Post::where('id', $post->id)
            ->update([
                'cover' => $nama_file
            ]);
        $pesan = "Foto depan berhasil di-upload !";
        return redirect('/post/'.$post->id)->with('status', $pesan);
    }
    
}
