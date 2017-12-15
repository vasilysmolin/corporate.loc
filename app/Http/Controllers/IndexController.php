<?php

namespace Corp\Http\Controllers;


use Illuminate\Http\Request;
use Corp\Repositories\SlidersRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;

use Config;

class IndexController extends SiteController
{
    // передаем репозитории
    public function __construct (SlidersRepository $s_rep, PortfoliosRepository $p_rep, ArticlesRepository $a_rep)
    {

        // вот этот момент не понял
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        // зачем здесь указывать тоже не понял
        $this->s_rep = $s_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->bar = 'right';
        $this->template = env('THEME').'.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // переопределяем мета данные
        $this->keywords = 'Главная страница';
        $this->meta_desc = 'Главная страница';
        $this->title = 'Главная страница';


        // формируем портфолио
        $portfolios = $this->getPortfolio();
        $content = view(env('THEME').'.content')->with('portfolios',$portfolios)->render();
        $this->vars= array_add($this->vars,'content',$content);


        // формируем слайдер
        $sliderItems = $this->getSliders();
        $sliders = view(env('THEME').'.slider')->with('sliders',$sliderItems)->render();
        $this->vars = array_add($this->vars,'sliders',$sliders);

        // формируем статьи
        $articles = $this->getArticles();
        $this->contentRightBar = view(env('THEME').'.indexBar')->with('articles', $articles)->render();



        // отдаём на рендер гланосу котроллеру
        return $this->renderOutput();
    }
    // получаем статьи для правго сайдбара гланой страницы
    protected function getArticles(){

        $articles = $this->a_rep->get(['title','created_at','img','alias'],Config::get('settings.home_art_count'));

        return $articles;
    }

    // получаем портфолио для гланой страницы
    protected function getPortfolio(){

        $portfolio = $this->p_rep->get('*',Config::get('settings.home_port_count'));

        return $portfolio;
    }
    // получаем слайдеры из базы данных
    public function getSliders(){
        $sliders = $this->s_rep->get();
        //если слайдер пустой возвращаем ошибку
        if($sliders->isEmpty()){
            return FALSE;
        }

        //функция хелпер делает трансформацию каждого эллемента модели
        $sliders->transform(function ($item,$key){
            $item->img = Config::get('settings.slider_path').'/'. $item->img;
            return $item;
        });

        return $sliders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
