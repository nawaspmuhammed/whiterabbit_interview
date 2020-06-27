<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Directory extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = "directory";
    public function getRouteKeyName()
    {
        return 'uuid';
    }

   
}