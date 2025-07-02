<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "category";
    // protected $primaryKey = 'alter_field_as_primary_key';
    // use SoftDeletes;
    // public $timestamps = false;

    protected $fillable = ['name'];

    // Method of Category model
    public function books()
    {
        // the property $category->books returns an array of Book
        return $this->belongsToMany(Book::class,'book_category','category_id','book_id');
    }
}
