<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\ArticlesRepository;
use Illuminate\Http\Request;

class ArticlesController extends AdminController
{




    public function __construct (ArticlesRepository $a_rep)
    {

        parent::__construct();
//       todo досмотреть урок по правам 30
//       if(Gate::denies('VIEW_ADMIN_ARTICLES')){
//           return redirect()->route('adminIndex');
//       }
        $this->a_rep = $a_rep;
//
//
        $this->template = env('THEME').'.admin.articles';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->title = 'Менеджер статей';

        //добавляем контент

        $articles = $this->getArticles();
        $this->content = view(env('THEME').'.admin.articles_content')->with('articles',$articles)->render();



        return $this->renderOutput();
    }
    public function getArticles()
    {
        return $this->a_rep->get();
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
