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
        private $row;

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
            $link= mysqli_connect('localhost','root','root','testdb');

            $query="SELECT * FROM objects WHERE id = $this->id";
            $res = mysqli_query($link,$query);
            $this->row = mysqli_fetch_assoc($res);
            if(!$this->row){
                echo "create";
                $query="INSERT INTO objects VALUES($this->id,'none',0)";
                mysqli_query($link,$query);
            }else{
                $this->name = $this->row['name'];
                $this->status = $this->row['status'];
            }
            mysqli_close($link);
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
            if($this->row['name']!==$this->name||$this->row['status']!==$this->status){
                $link= mysqli_connect('localhost','root','root',"testdb");
                $query ="UPDATE objects SET name='{$this->name}', status={$this->status}  WHERE id=$this->id";
                mysqli_query($link,$query);
                mysqli_close($link);
            }

        }
    }
?>