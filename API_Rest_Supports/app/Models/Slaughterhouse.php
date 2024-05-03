<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slaughterhouse extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'prepaidAmount', 'location'];
}
