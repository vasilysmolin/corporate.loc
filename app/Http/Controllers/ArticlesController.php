<?php

namespace Corp\Http\Controllers;

use Corp\Category;
use Corp\Article;
use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;


class ArticlesController extends SiteController
{
    //
    // передаем репозитории
    public function __construct (CommentsRepository $c_rep,  PortfoliosRepository $p_rep, ArticlesRepository $a_rep)
    {

        // вот этот момент не понял
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        // зачем здесь указывать тоже не понял
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;
        $this->bar = 'right';
        $this->template = env('THEME').'.articles';
    }

    public function index($cat_alias = FALSE)
    {

        // переопределяем мета данные
        $this->keywords = 'Cтраница блога';
        $this->meta_desc = 'Cтраница блога';
        $this->title = 'Cтраница блога';

        //формируем сайдбар
        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=> $comments,'portfolios'=>$portfolios]);



        // формируем статьи
        $articles = $this->getArticles($cat_alias);
        $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
        $this->vars= array_add($this->vars,'content',$content);


        // отдаём на рендер гланосу котроллеру
        return $this->renderOutput();
    }



        // кол-во коментариеd
        public function getComments($take){

            $comments = $this->c_rep->get('*',$take);
            if($comments){
                // Делаем жадную загрузку связанных таблиц из базы данных
                $comments->load('user','article');
            }

            return $comments;

        }

        // кол-во портфолио
        public function getPortfolios($take){

            $portfolios = $this->p_rep->get('*',$take);
            return $portfolios;

        }

        // получаем статьи для страницы блог
        public function getArticles($alias = FALSE){


            $where = FALSE;
            if($alias){
                $id = Category::select('id')->where('alias',$alias)->first()->id;
                $where = ['category_id', $id  ];
            }


        $articles = $this->a_rep->get('*', FALSE, TRUE, $where);
        if($articles){
            // Делаем жадную загрузку связанных таблиц из базы данных
            $articles->load('user','category','comments');
        }

        return $articles;
    }

    public function show($alias = FALSE){

        //формируем подробную статью
        $article = $this->a_rep->one($alias,['comments' => TRUE]);

        if($article){
            $article->img = json_decode($article->img);
        }
//        dd($article->comments->groupBy('parent_id'));

        $content = view(env('THEME').'.article_content')->with('article', $article)->render();
        $this->vars= array_add($this->vars,'content',$content);

        //формируем сайдбар
        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=> $comments,'portfolios'=>$portfolios]);

        // отдаём на рендер гланосу котроллеру
        return $this->renderOutput();
    }











}
