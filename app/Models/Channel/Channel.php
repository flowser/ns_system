<?php

namespace App\Models\Channel;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;
    use Uuids;
    protected $fillable = [
        'name',
        'active',
    ];
    protected $casts = [
        // 'id' => 'string',
        'active'    => 'boolean',
    ];
}
