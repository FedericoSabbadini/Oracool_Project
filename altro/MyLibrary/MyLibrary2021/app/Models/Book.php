<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['title', 'author_id', 'user_id'];
    
    public function author() {
        // use the 'author' property: $book->author (returns an object Author)
        return $this->belongsTo(Author::class);
    }
    
    public function user() {
        // use the 'user' property: $book->user (returns an object LibUser)
        return $this->belongsTo(LibUser::class);
    }
}
