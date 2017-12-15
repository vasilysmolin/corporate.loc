<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function user(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->belongsTo('Corp\User', 'user_id', 'id');
    }
    public function article(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->belongsTo('Corp\Article', 'article_id', 'id');
    }


}
