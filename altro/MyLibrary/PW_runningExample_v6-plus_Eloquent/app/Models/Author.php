<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;
    protected $table = 'author';
    // protected $primaryKey = 'alter_field_as_primary_key';
    // use SoftDeletes;
    // public $timestamps = false;

    protected $fillable = ['firstname', 'lastname'];

    // Method of Author model
    public function books()
    {
        // the property $author->books returns an array of Books
        return $this->hasMany(Book::class,'author_id','id');
    }

    // Method of Author model
    public function address()
    {
        // the property $author->address returns an object of type Address
        return $this->hasOne(Address::class,'author_id','id');
    }
}
