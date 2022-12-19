<?php
namespace App\Support\EloquentScopes;

trait Native
{
    public function scopeNative($query)
    {
        return $query->where('native', 1);
    }

    public function scopeNotNative($query)
    {
        return $query->where('native', 0);
    }
}