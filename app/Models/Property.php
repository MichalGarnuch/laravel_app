<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['name','address','area','price','description'];

    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $casts = [
        'area' => 'integer',
        'price' => 'decimal:2'
        ];
}
