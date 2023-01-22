<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'organization_id', 'event', 'read_at', 'created_at', 'updated_at'];
}
