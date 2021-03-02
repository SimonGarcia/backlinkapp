<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function Domains(){
        return $this->hasMany(Domain::class);
    }
}
