<?php

namespace Modules\MenuSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSystem extends Model {

    use HasFactory;
    protected $table = 'menu_system';
    protected $fillable = [
        'menu_main',
        'menu_module_name',
    ];

    public function setMenuMainAttribute($menu_main) {
        $this->attributes['menu_main'] = json_encode($menu_main);
    }
    
    public function getMenuMainAttributeAttribute($menu_main) {
        return json_decode($menu_main);
    }

}
