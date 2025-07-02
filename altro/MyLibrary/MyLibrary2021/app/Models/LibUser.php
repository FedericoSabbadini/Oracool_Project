<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibUser extends Model
{
    protected $table = "user";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['username', 'password', 'email'];
    
    public function authors() {
        // use the 'authors' property: $user->authors (returns an array)
        return $this->hasMany(Author::class);
    }    
    
    public function books() {
        // use the 'books' property: $user->books (returns an array)
        return $this->hasMany(Book::class);
    }
}
