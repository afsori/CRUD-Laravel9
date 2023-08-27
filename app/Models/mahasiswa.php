<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;
    // payload yg boleh lewat hanya nim, nama, jurusan
    protected $fillable = ['nim', 'nama', 'jurusan'];

    // table yg akan di tuju adalah mahasiswa
    protected $table = 'mahasiswa';

    // hide created_at dan updated_at
    public $timestamps = false;
}
