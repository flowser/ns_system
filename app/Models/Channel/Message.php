<?php

namespace App\Models\Channel;

use App\Models\User\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    use Uuids;
    protected $fillable = [
        'message',
        'send_method',
        'sender_id',
        'recipient_id',
    ];
    protected $casts = [
        // 'id' => 'string',
        'active'    => 'boolean',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
