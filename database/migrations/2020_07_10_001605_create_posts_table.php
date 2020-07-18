<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('jenis_posts')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('alamat')->nullable();
            $table->foreignId('status_posts')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('deskripsi')->nullable();
            $table->foreignId('kelurahan_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('cover')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('link_kontak')->nullable();
            $table->foreignId('pemilik_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
