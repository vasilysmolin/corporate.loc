<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','img','alias','text', 'desc','keywords','meta_desc','category_id'];
    //
    public function user(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->belongsTo('Corp\User');
    }
    public function category(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->belongsTo('Corp\Category');
    }

    public function comments(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->hasMany('Corp\Comment');
    }
}
