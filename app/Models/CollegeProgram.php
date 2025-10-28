<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_name',
        'program_name',
        'major_name',
    ];
}
