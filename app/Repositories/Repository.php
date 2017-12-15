<?php

    namespace Corp\Repositories;

    use Config;

    abstract class Repository{

        protected $model = FALSE;
        // обращения к базе данных для всех моделей
        public function get($select = '*', $take = FALSE, $pagination = FALSE, $where = FALSE){
            // выборка определенных полей и кол-ва из базы данных
            $builder = $this->model->select($select);

            // кол-во полей
            if($take){
                $builder ->take($take);
            }

            // для страниц отдельной категории
            if($where){
                $builder->where($where[0],$where[1] );
            }

            // пагинация должна всегда возвращаться sql запросом
            if($pagination) {
                return $this->check($builder->paginate(Config::get('settings.paginate')));
            }


            return $this->check($builder->get());
        }

        // обработка JSON формата
        protected function check($result){
            if ($result->isEmpty()){
                return FALSE;
            }
            $result->transform(function ($item,$key){
                if(is_string($item->img) && is_object(json_decode($item->img)) && (json_last_error() == JSON_ERROR_NONE)){
                    $item->img = json_decode($item->img);
                }
                return $item;
            });
            return $result;
        }
    }


