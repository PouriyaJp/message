<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_one_id',
        'user_two_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(Message::class);
    }
}
