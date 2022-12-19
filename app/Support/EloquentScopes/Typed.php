<?php
namespace App\Support\EloquentScopes;

trait Typed
{
    public function scopeWhereType($query, $value)
    {
        return $query->where('type', $value);
    }

    public function scopeGetByType($query, $value)
    {
        return $this->where('type', $value)->get();
    }
}