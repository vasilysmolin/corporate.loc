<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    public function users(){
        // Первый: модель. Второй: через какую таблицу
        return $this->belongsToMany('Corp\User','role_user');
    }
    public function permissions(){
        // Первый: модель. Второй: через какую таблицу
        return $this->belongsToMany('Corp\Permission','permission_user');
    }
}
