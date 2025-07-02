<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'user_id'];
    
    public function user() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo(LibUser::class);
    }
    
    public function books() {
        // use the 'books' property: $author->books (returns an array)
        return $this->hasMany(Book::class);
    }
}
