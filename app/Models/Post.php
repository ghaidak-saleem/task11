<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'title',
        'description',
        'user_id',
        'category_id',
    ];
    public function getImageUrlAttribute(){
        if($this->image){
            $basePath='storage';
            $imagePath= str_replace('public/','',$this->image);
            return url("$basePath/$imagePath");
        }
        return null;
    }

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
