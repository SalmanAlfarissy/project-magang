<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $table = 'magang';
    protected $primaryKey='id';
    protected $guarded=['id,id_user'];
}
