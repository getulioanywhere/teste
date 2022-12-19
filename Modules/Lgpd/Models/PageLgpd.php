<?php

namespace Modules\Lgpd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageLgpd extends Model {

    use HasFactory;

    protected $table = 'lgpd';
    protected $fillable = [
        'page_active', 
        'page_title',
        'page_body',
        'slug',
        'modal_title',
        'modal_body',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'locale'
    ];   

}
