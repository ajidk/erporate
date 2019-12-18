<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pariwisata extends Model
{
    protected $table = 'table_pariwisata';
    protected $fillable = [
        'pariwisata_nama',
        'pariwisata_alamat',
        'pariwisata_detail',
        'pariwisata_gambar',
    ];
    // protected $guarded = [];
    
}
