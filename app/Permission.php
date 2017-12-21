<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public function roles(){
        // Первый: модель. Второй: через какую таблицу
        return $this->belongsToMany('Corp\Role','permission_user');
    }
}
