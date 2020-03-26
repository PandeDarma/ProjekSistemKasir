<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = "barang";
    protected $fillable = [];
    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
