<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'speakers';
    protected $primaryKey = 'idSpeaker';

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

}
