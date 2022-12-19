<?php

namespace App\Classes;

use Modules\MenuSystem\Models\MenuSystem;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */

class Menus {

    protected $iconleft = '<i class="right fas fa-angle-left"></i>';

    /* BEGIN MOUNT TEMPLATE HORIZONTAL */

    public static function create_menu_horizontal() {

        $menu_a = Config('menu_horizontal.menu_a');
        $menu_b = Config('menu_horizontal.menu_b');

        $menu = new Menus();
        $html = $menu->mount_menu_horizontal($menu_a, '<i class="fas fa-wrench"></i>');
        $html .= $menu->mount_menu_horizontal($menu_b, '<i class="fas fa-envelope mr-2"></i>');

        return $html;
    }

    protected function mount_menu_horizontal($array, $icon) {

        $html = '<li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                ' . $icon . ' 
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">';

        for ($i = 0; $i < count($array); $i++) {
            $obj = (object) $array[$i];
            $html .= $this->create_html_menu_horizontal($obj->url, $obj->title, $obj->icon);
        }

        $html .= '</div></li>';
        return $html;
    }

    protected function create_html_menu_horizontal($url, $title, $icon) {
        return '<a href="' . $url . '" class="dropdown-item">                        
                    <div class="media">                        
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                ' . $icon . '
                                ' . $title . '                             
                            </h3>                            
                        </div>
                    </div>                   
                </a>';
    }

    /* END MOUNT TEMPLATE HORIZONTAL */

    /* BEGIN MOUNT TEMPLATE MAIN */

    public static function create_menu_main() {
        $html = '';//'<li class="nav-item">';
        $menu = new Menus();
        $menu_a = MenuSystem::all(['menu_main'])->toArray(); //Config('menu_main');        

        if (count($menu_a) > 0) {
            $menu_a = $menu->extract($menu_a);
            $html .= $menu->mount_menu_main_html($menu_a);
        } else {
            $html = '<li class="nav-item">';
            $html .= '<p style="color: white;">Sistema sem módulos</p>';
            $html .= '</li>';
        }
        //$html .= '</li>';
        return $html;
    }

    protected function extract($menu) {
        $array = [];
        for ($i = 0; $i < count($menu); $i++) {
            array_push($array, $menu[$i]['menu_main']);
        }
        return $array;
    }

    protected function mount_menu_main_html($array) {
        $html = '';
        $children = false;
        for ($i = 0; $i < count($array); $i++) {
             $html .= '<li class="nav-item">';
            $menu = (array) json_decode($array[$i]);

            if (isset($menu['children']) === true && count($menu['children']) > 0) {

                $children_array = $menu['children'];
                $children = [];
                for ($x = 0; $x < count($children_array); $x++) {
                    array_push($children, (array) $children_array[$x]);
                }
            }

            $html .= $this->mount_menu_main_partA($menu['title'], $menu['icon'], $children);

            if (is_array($children) === true) {
                $html .= $this->mount_menu_main_partB($children);
            }
            $html .= '</li>';
        }
        return $html;
    }

    protected function mount_menu_main_partA($title, $icon, $array = null, $url = '#') {
        $iconangleleft = $array !== null ? $this->iconleft : '';
        $html = '<a href="' . $url . '" class="nav-link">
                ' . $icon . '                
                <p>
                    ' . $title . '
                       
                    ' . $iconangleleft . '
                    <!--<span class="right badge badge-danger">New</span>
                    <span class="badge badge-info right">6</span>-->
                </p>
            </a>';
        return $html;
    }

    protected function mount_menu_main_partB($array) {

        $html = '<ul class="nav nav-treeview">';
        for ($i = 0; $i < count($array); $i++) {
            if (isset($array[$i]['children']) === true && count($array[$i]['children']) > 0) {
                $children = $array[$i]['children'];
                $iconangleleft = $this->iconleft;
            } else {
                $iconangleleft = '';
            }

            $html .= '<li class="nav-item">
                    <a href="' . $array[$i]['url'] . '" class="nav-link">
                        ' . $array[$i]['icon'] . ' 
                        <p>
                            ' . $array[$i]['title'] . '
                            ' . $iconangleleft . '
                        </p>
                    </a>';

            if (isset($array[$i]['children']) === true && count($array[$i]['children']) > 0) {
                $children_sub = $array[$i]['children'];
                $children_array = [];
                for ($x = 0; $x < count($children_sub); $x++) {
                    array_push($children_array, (array) $children_sub[$x]);
                }
                $html .= $this->mount_menu_main_partB($children_array);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    /* END MOUNT TEMPLATE MAIN */

    /* EXEMPLO DE COMO INCLUIR NA CONFIG MAIS ARRAYS PARA O MENU */
    /*
      $array = Config::get('menu_main.menu')[1];
      //var_dump($array['title']);

      array_push($array,
      [
      'icon' => '<i class="far fa-circle nav-icon"></i>',
      'title' => 'Usuários do sistema 2',
      'url' => '#'
      ],[
      'icon' => '<i class="far fa-circle nav-icon"></i>',
      'title' => 'Usuários do sistema 3',
      'url' => '#'
      ]);

      Config::set('menu_main.menu',$array);

      var_dump(Config::get('menu_main.menu'));
     */
}
