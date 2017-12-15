<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Repositories\MenusRepository;
use Menu;

class SiteController extends Controller
{
    // репозитории
    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;

    // мета данные
    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $template;

    // переменные для сайдбара

    protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;
    protected $bar = 'no';

    //главный массив в который пушим переменные и добавляем в шаблон
    protected $vars = array();


    public function __construct (MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    protected function renderOutput(){

        //мета данные
        $this->vars = array_add($this->vars,'keywords',$this->keywords);
        $this->vars = array_add($this->vars,'meta_desc',$this->meta_desc);
        $this->vars = array_add($this->vars,'title',$this->title);

        //формируем меню вместе с плагином меню
        $menu = $this->getMenu();
        $navigation = view(env('THEME').'.navigation')->with('menu',$menu)->render();
        $this->vars = array_add($this->vars,'navigation',$navigation);

        //формируем сайдбар
        if($this->contentRightBar){
            $rightBar = view(env('THEME').'.rightBar')->with('content_rightBar', $this->contentRightBar)->render();
            $this->vars = array_add($this->vars,'rightBar',$rightBar);
        }
        //паметр для сайдбара no left или right
        $this->vars = array_add($this->vars,'bar',$this->bar);

        //формируем футер
        $footer = view(env('THEME').'.footer')->render();
        $this->vars = array_add($this->vars,'footer',$footer);

        //передаём переменные в шаблон
        return view($this->template)->with($this->vars);
    }
    //функция получения меню
    protected function getMenu(){
        $menu = $this->m_rep->get();
        //используем плагин
        $mBilder = Menu::make('MyNav',function ($m) use ($menu){
            //получаем дочерние и родительские пункты меню
            foreach ($menu as $item){
                if($item->parent == 0){
                    $m->add($item->title,$item->path)->id($item->id);
                }
                else{
                    if($m->find($item->parent)){
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }


        });

        return $mBilder;

    }
}
