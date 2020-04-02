<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = 'kategori';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function Barangs()
    {
        return $this->hasMany('App\Barang');
    }
}
