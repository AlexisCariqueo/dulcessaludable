<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaBlog extends Model
{
    use HasFactory;

    protected $table = 'categoria_blog';

    protected $fillable = [
        'nombre',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'categoria_id');
    }
}