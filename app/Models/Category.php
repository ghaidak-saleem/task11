<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'image',
    ];

    public function getImageUrlAttribute(){
        if($this->image){
            $basePath='storage';
            $imagePath= str_replace('public/','',$this->image);
            return url("$basePath/$imagePath");
        }
        return null;
    }

    public function posts(){
    return $this->hasMany(Post::class);
    }
}
