<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name'];

    use HasFactory;

    public function getResults(string $name = null)
    {
        if(!$name){
            return $this->all();
        }
        return $this->where('name', 'LIKE', "%{$name}%")->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
