<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = "address";
    // protected $primaryKey = 'alter_field_as_primary_key';
    // use SoftDeletes;
    // public $timestamps = false;

    // for massive assignment
    protected $fillable = ['street_and_number', 'city', 'province', 'country', 'postcode', 'author_id'];

    // Method of Address model
    public function author()
    {
        // the property $address->author returns an object of type Author
        return $this->belongsTo(Author::class,'author_id','id');
    }
}
