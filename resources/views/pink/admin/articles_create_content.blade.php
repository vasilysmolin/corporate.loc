<div id="content-page" class="content group" >
<div class="hentry group" >



    {!! Form::open(['url'=> (isset($article->id)) ? route('articles.update', ['articles'=>$article->alias]) : route('articles.store') ,'class'=>'form-horizontal', 'method'=>'POST','enctype'=>'multipart/form-data']) !!}

    <ul>
        <li class="col-md-6">
            <label for="name-contact-us">
                <span class="label">Название:</span><br/>
                <span class="sublabel">Название</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('title', isset($article->title) ? $article->title : old('title'),['class'=>'form-control ','placeholder'=>'Введите название страницы']) !!}

            </div>
        </li>

        <li class="col-md-6">
            <label for="name-contact-us">
                <span class="label">Ключевые слова:</span><br/>
                <span class="sublabel">Ключевые слова</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('keywords', isset($article->keywords) ? $article->keywords : old('keywords'),['class'=>'form-control','placeholder'=>'Введите ключевые слова']) !!}

            </div>
        </li>

        <li class="col-md-6">
            <label for="name-contact-us">
                <span class="label">Мета описания:</span><br/>
                <span class="sublabel">Мета описания</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('meta_desc', isset($article->meta_desc) ? $article->meta_desc : old('meta_desc'),['class'=>'form-control','placeholder'=>'Введите мета описания']) !!}

            </div>
        </li>

        <li class="col-md-6">
            <label for="name-contact-us">
                <span class="label">Псевдоним:</span><br/>
                <span class="sublabel">Введите псевдомим</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('alias', isset($article->alias) ? $article->alias : old('alias'),['class'=>'form-control','placeholder'=>'Введите псевдоним']) !!}

            </div>
        </li>

        <li>
            <label for="message-contact-us">
                <span class="label">Краткое краткой описание:</span><br/>
                <span class="sublabel">Введите краткой описание</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::textarea('desc', isset($article->desc) ? $article->desc : old('desc'),['id'=>'editor2','class'=>'form-control','placeholder'=>'Введите краткой описание']) !!}
            </div>
            <div class="msg-error"></div>
        </li>

        <li>
            <label for="message-contact-us">
                <span class="label">Краткое описание:</span><br/>
                <span class="sublabel">Введите описание</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::textarea('text', isset($article->text) ? $article->text : old('text'),['id'=>'editor','class'=>'form-control','placeholder'=>'Введите описание']) !!}
            </div>
            <div class="msg-error"></div>
        </li>

        @if(isset($article->img->path))
            <li class="textarea-field">
                <label>
                    <span class="label">Изображение материала:</span>
                </label>
                {!! Html::image(assets(env('THEME')).'/images/articles/'.$article->img->path ) !!}
                {!! Form::hidden('old_images', $article->img->path) !!}
            </li>

        @endif

        <li class="col-md-6">
            <label for="message-contact-us">
                <span class="label">Изображение:</span><br/>
                <span class="sublabel">Изображение описание</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::file('image',['class'=>'filestyle', 'data-buttonText'=>'Выберите изображение','data-buttonName'=> 'btn-primary','data-placeholder'=>'Файла нет']) !!}
            </div>

        </li>

        <li class="col-md-6">
            <label for="message-contact-us">
                <span class="label">Категория:</span><br/>
                <span class="sublabel">Категория описание</span><br/>

            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::select('category_id', $categories, isset($article->category_id) ? $article->category_id : '', ['class' => 'form-control']) !!}
            </div>

        </li>

        @if(isset($article->id))

            <input type="hidden" name="_method" value="PUT">

        @endif

        <li class="submit-button top-buffer col-md-6">
            {{ Form::submit('Сохранить',['class'=>'btn btn-success']) }}
        </li>

    </ul>


    {!! Form::close() !!}


    <script>
        CKEDITOR.replace('editor')
        CKEDITOR.replace('editor2')
    </script>

</div>
</div>