<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    //
    public function filter(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->belongsTo('Corp\Filter','filter_alias','alias');
    }
}
