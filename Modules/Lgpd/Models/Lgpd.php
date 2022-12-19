<?php

namespace Modules\Lgpd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lgpd extends Model {

    use HasFactory;

    protected $table = 'lgpd_consents';
    
    protected $fillable = [
        'type', 'data', 'ip'
    ];
}
