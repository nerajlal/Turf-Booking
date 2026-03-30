<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchInvitation extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sport',
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
