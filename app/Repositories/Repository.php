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

            // для страниц отдельной категории ?
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

        public function one($alias, $attr = array()){
            $result = $this->model->where('alias', $alias)->first();
            return $result;
        }

        public function transliterate($string){
            $str = mb_strtolower($string, 'UTF-8');

            $leter_array = array(
                            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
                            "Е"=>"E","Ё"=>"YO","Ж"=>"ZH",
                            "З"=>"Z","И"=>"I","Й"=>"J","К"=>"K","Л"=>"L",
                            "М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R",
                            "С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"X",
                            "Ц"=>"C","Ч"=>"CH","Ш"=>"SH","Щ"=>"SHH","Ъ"=>"'",
                            "Ы"=>"Y","Ь"=>"'","Э"=>"E","Ю"=>"YU","Я"=>"YA",
                            "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
                            "е"=>"e","ё"=>"yo","ж"=>"zh",
                            "з"=>"z","и"=>"i","й"=>"j","к"=>"k","л"=>"l",
                            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
                            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"x",
                            "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"shh","ъ"=>"",
                            "ы"=>"y","ь"=>"'","э"=>"e","ю"=>"yu","я"=>"ya",
                            " "=>"-","—"=>"-",","=>"_","!"=>"-","@"=>"_",
                            "#"=>"-","$"=>"","%"=>"","^"=>"","&"=>"","*"=>"",
                            "("=>"",")"=>"","+"=>"","="=>"",";"=>"",":"=>"",
                            "'"=>"","~"=>"","`"=>"","?"=>"","/"=>"",
                            "["=>"","]"=>"","{"=>"","}"=>"","|"=>"",
                            "\""=>"","\\"=>"",
            );

            foreach($leter_array as $leter => $kyr){

                $kyr = explode(',',$kyr);
                $str = str_replace($kyr, $leter, $str);

            }

            $str = preg_replace(['/(\s|[^A-Za-z0-9\-])+/'], '-',$str);
            $str = trim($str,'-');
            return $str;
        }
    }


