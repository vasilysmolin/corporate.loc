<?php

namespace Corp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles(){
        // Первый: модель. Второй: поле текущей модели. Третий: поле можели фильтр по которой идет связь
        return $this->hasMany('Corp\Article');
    }

    public function roles(){
        // Первый: модель. Второй: через какую таблицу
        return $this->belongsToMany('Corp\Role','role_user');
    }

    //string or array
    public function canDo($permission, $require = FALSE){
        if(is_array($permission)){
            dump($permission);
        }else{
            foreach($this->roles as $role){
                foreach( $role->permissions as $perm){
                    if(str_is($permission,$perm->name)){
                        return TRUE;
                    }
                }
            }
        }
    }



}
