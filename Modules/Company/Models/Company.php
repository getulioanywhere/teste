<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    use HasFactory;

    protected $table = 'company';
    
    protected $fillable = [
        'name', 'cnpj','foundation', 'email', 'phone',
        'facebook', 'instagram', 'whatsapp_1', 'whatsapp_2', 'twitter', 'youtube', 'linkedin',
        'address_street', 'address_number', 'address_neighborhood', 'address_city', 'address_state', 'address_zipcod',
        'map', 'opening_hours', 
        'header', 'footer', 'seal_1', 'seal_2', 'seal_3',
        'path_header', 'path_footer', 'path_seal_1', 'path_seal_2', 'path_seal_3', 'http_website',
    ];

    /*protected $appends = [
        'header_url', 'footer_url', 'seal_1_url', 'seal_2_url', 'seal_3_url'
    ];

    public function getHeaderUrlAttribute()
    {
        if($this->header) return '/company/header/'.$this->header;
        return $this->footer;
    }

    public function getFooterUrlAttribute()
    {
        if($this->footer) return '/company/footer/'.$this->footer;
        return $this->footer;
    }

    public function getSeal1UrlAttribute()
    {
        if($this->seal_1) return '/company/seal_1/'.$this->seal_1;
        return $this->seal_1;
    }

    public function getSeal2UrlAttribute()
    {
        if($this->seal_2) return '/company/seal_2/'.$this->seal_2;
        return $this->seal_2;
    }
    
    public function getSeal3UrlAttribute()
    {
        if($this->seal_3) return '/company/seal_3/'.$this->seal_3;
        return $this->seal_3;
    }

    public function columnsAddress()
    {
        return $this->only(
            'address_street',
            'address_number',
            'address_neighborhood',
            'address_city',
            'address_state',
            'address_zipcod'
        );
    }*/
}