<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parenComment extends Model
{
    use HasFactory;

    protected $table = 'parent_comment';
    protected $primaryKey = 'id';
}
