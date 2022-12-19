<?php
namespace App\Support\EloquentScopes;

trait Activated
{
    public function scopeActivated($query)
    {
        return $query->where('active', true);
    }
}
