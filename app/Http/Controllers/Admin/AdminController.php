<?php

namespace Corp\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Menu;


class AdminController extends Controller
{
    //
    protected $p_prep;

    protected $a_prep;

    protected $user;

    protected $template;

    protected $content = FALSE;

    protected $title;

    protected $vars = array ();

    public function __construct (){

        $this->user = Auth::user();

        if(!$this->user){
            return redirect()->route('login');
        }

    }

    public function renderOutput(){

        $this->vars = array_add($this->vars, 'title', $this->title);

        $menu = $this->getMenu();

        $navigation =  view(env('THEME').'.admin.navigation')->with('menu', $menu)->render();

        $this->vars = array_add($this->vars, 'navigation', $navigation);

        if($this->content){
            $this->vars = array_add($this->vars,'content', $this->content);
        }

        $footer = view(env('THEME').'.admin.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }


    public function getMenu(){

        return Menu::make('adminMenu', function ($menu){
            $menu->add('Статьи', array('route' => 'articles.index'));
            $menu->add('Портфолио', array('route' => 'articles.index'));
            $menu->add('Меню', array('route' => 'articles.index'));
            $menu->add('Пользователи', array('route' => 'articles.index'));
            $menu->add('Привилегии', array('route' => 'articles.index'));
        });

    }

}
