<?php
namespace App\Support\EloquentScopes;

trait Featured
{
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
