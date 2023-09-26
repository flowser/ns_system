<?php

namespace App\Models\Channel;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessageAnalytic extends Model
{
    use HasFactory;
    use Uuids;
    protected $fillable = [
        'message_id',
        'recipient_id',
        'delivery_status',
        'delivery_timestamp',
    ];
    protected $casts = [
        // 'id' => 'string',
        'active'    => 'boolean',
    ];
}
