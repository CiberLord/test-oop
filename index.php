<?php 

    /**
     * @author Yuldash cybergod1123@gmail.com
     */

    /**
     * Item - простой демонстрационный класс для работы с данными
     */
    class Item{

        /**
         * @var integer id  идентификатор обьекта
         * @var string $name  имя обьекта
         * @var integer $status статус обьекта
         * @var bool $changed  чекбокс
         */
        private  $id;
        private $name;
        private $status;
        private $changed;

        /**
         * конструктор класса
         * задает знаяения id и вызывает метод init()
         * @param integer $id - идентификатор обьекта
         */
        function __construct(int $id)
        {   
            $this->id=$id;
            $this->init();
        }

        /**
         * функция для работы с бд
         * Получает данные name и status с таблицы objects и заполняет соотвествую поля обьекта
         */
        private function init(){
            $this->name = "vasya";
            $this->status = 3456;
        }

        /**
         * magic method
         * @param mixed $prop - свойсвто которое нужно получить
         * @return mixed значение свойства
         */
        public function __get($prop){
            return $this->$prop;
        }

        /**
         * magic method для изменения полей обьекта, можно изменять все поля кроме $id
         * 
         * @param string $prop - свойство которое нужно изменить
         * @param mixed $val - новое значение свойтсва
         */
        public function __set(string $prop,$val){
            switch($prop){
                case "name":{
                    if(is_string($val)) $this->name=$val;
                    break;
                }
                case "status":{
                    if(is_integer($val)) $this->status=$val;
                    break;
                }  
                case "changed":{
                    if(is_bool($val)) $this->changed=$val;
                    break;
                }   
            }
        }

        /**
         *  метод для сохранения значений $name} и $status в случае если они если они были изменены
         */
        public function save(){
            //пока ничего не делает
        }
    }

    
?>