<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'partners';
    protected $primaryKey = 'id';

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
}
