@if($articles)

<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Добавленные статьи</h2>
            <div class="short-table white">


                <table style="width:100%" class="table">

                    <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Заголовк</th>
                            <th>Текст</th>
                            <th>Изображение</th>
                            <th>Категория</th>
                            <th>Псевдоним</th>
                            <th>Действие</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($articles as $k=>$article)
                        <tr>
                            <td class="align-left">{{$article->id}}</td>
                            <td class="align-left">{{ Html::link(route('articles.edit',['articles'=>$article->id]) ,$article->title,['alt'=>$article->title]) }}</td>
                            <td class="align-left">{{ str_limit($article->text,200)  }}</td>
                            <td>
                                @if(isset($article->img->mini))
                                    {!! Html::image(asset(env('THEME').'/images/articles/'.$article->img->mini)) !!}
                                @endif
                            </td>
                            <td>{{$article->category->title}}</td>
                            <td>{{$article->alias}}</td>
                            <th>

                                {{ Form::open(['url'=>route('articles.destroy',['articles'=>$article->alias]),'class'=>'form-horizontal', 'method'=>'POST']) }}

                                {{--{{ Form::hidden('_method'),'delete' }}--}}
                                {{ method_field('DELETE') }}
                                {{ Form::submit('Удалить',['class'=>'btn btn-french-5']) }}



                                {{ Form::close() }}



                            </th>
                        </tr>

                    @endforeach



                    </tbody>
                </table>
            @endif

    {{ Html::link(route('articles.create'),'Новая статья',['class'=>'btn btn-success']) }}
        </div>
    </div>
</div>