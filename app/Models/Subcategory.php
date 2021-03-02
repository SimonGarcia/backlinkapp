<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Domains(){
        return $this->hasMany(Domain::class);
    }
}
