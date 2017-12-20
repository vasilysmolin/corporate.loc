<?php

namespace Corp\Http\Controllers;

use Corp\Article;
use Corp\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->except('_token','comment_post_ID','comment_parent');
        $data['article_id'] = $request->input('comment_post_ID');
        $data['parent_id'] = $request->input('comment_parent');

        // валидация данных
        $validator = Validator::make($data,[

            'article_id' => 'integer|required',
            'parent_id' => 'integer|required',
            'text' => 'string|required'

        ]);

        $validator->sometimes(['name','email'],'required|max:255',function($input){

            return !Auth::check();

        });

        if($validator->fails()){

            return response()
                ->json(['error'=>$validator->errors()->all()]);

        }
        // получаем авторизованного пользователя
        $user = Auth::user();
        // получаем новую модель комментария
        $comment = new Comment($data);

        // если есть заполненная переменная юзер
        if($user){
            // в поле комментария юзер id = user id
            $comment->user_id = $user->id;
        }

        // в переменную пост получаем модель артикл и находим id из пост запроса
        $post = Article::find($data['article_id']);

        // в модель пост, метод коммент сохраняем новую модель с данными
        $post->comments()->save($comment);

        //получаем юзера если он есть
        $comment->load('user');
        $data['id'] = $comment->id;
        $data['email'] = (!empty($data['email'])) ? $data['email'] : $comment->user->email;
        $data['name'] = (!empty($data['name'])) ? $data['name'] : $comment->user->name;
        $data['text'] = (!empty($data['text'])) ? $data['text'] : $comment->user->text;
        $data['hash'] = md5($data['email']);

        $view_comment = view(env('THEME').'.content_one_comment')->with('data', $data)->render();

        // вернуть ответ в метод ajax для js
//        return Response::json(['success'=>TRUE,'comment'=>$view_comment,'data'=> $data]);

        return response()
            ->json(['success'=>TRUE,'comment'=>$view_comment,'data'=> $data]);


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
