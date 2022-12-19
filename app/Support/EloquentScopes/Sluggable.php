<?php
namespace App\Support\EloquentScopes;

trait Sluggable
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value);
    }
}