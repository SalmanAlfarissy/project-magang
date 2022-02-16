<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentasi extends Model
{
    protected $table = 'presentasi';
    protected $primaryKey='id';
    protected $guarded=['id,id_user','id_pengajuan'];
}
