<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'harga',
        'harga_diskon',
        'is_diskon',
        'description',
        'image_url',
        'stock',
        'category',
        'user_id',
    ];

    protected $appends = ['harga_display', 'harga_diskon_display'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function getHargaDisplayAttribute($value)
    {
        return number_format($this->harga, 0, ",", ".");
    }

    public function getHargaDiskonDisplayAttribute($value)
    {
        return number_format($this->harga_diskon, 0, ",", ".");
    }

    public function getIsDiskonAttribute($value)
    {
        return $value == "1" ? 1 : 0;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
