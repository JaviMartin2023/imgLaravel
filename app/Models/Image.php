<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['original_name', 'stored_name'];

    public function getImageUrlAttribute()
    {
        return asset('storage/ejercicio/' . $this->stored_name);
    }
}
