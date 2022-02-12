<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMagang extends Model
{
    protected $table = 'data_magang';
    protected $primaryKey='id';
    protected $guarded=['id,id_user'];
}
