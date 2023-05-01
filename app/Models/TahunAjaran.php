<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'tahun_ajaran_id');
    }
}
