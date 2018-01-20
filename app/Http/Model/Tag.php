<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table='tag';
    protected $primaryKey = 'tag_id';
    public $timestamps = false;
    protected $guarded = [];
}