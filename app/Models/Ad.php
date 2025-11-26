<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $filable = [
        'shop_bannar',
        'serve_bannar',
        'pack_bannar',
        ];
}
