<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function articles(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->hasMany('Corp\Article');
    }
}
