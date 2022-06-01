<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    use HasFactory;

    public $table = 'persons';

    protected $fillable = [
        'name',
        'address',
        'age',
    ];
}
