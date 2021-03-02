<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Domain extends Model
{
    use HasFactory;
    public function Category(){
        return $this->belongsTo(Category::class);
    }
    
    public function Sibcategory(){
        return $this->belongsTo(Subcategory::class);
    }
}
