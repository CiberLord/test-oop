<?php

    require_once('Item.php');

    // предварительная инициализация бд и таблицы для работы с обьектом Item
    $table="objects";
    $link= mysqli_connect('localhost','root','root');
    $query="CREATE DATABASE testdb";
    $res = mysqli_query($link,$query);
    if($res==false){
        echo "такая бд уже существует <br>";
    }else{
        echo "бд создана <br>";
    }
    mysqli_select_db($link,"testdb");


    //запрос на создание  таблицы
    $query="CREATE TABLE $table
    (
        id INT NOT NULL,
        name VARCHAR(20),
        status INT)";
    $res = mysqli_query($link,$query);
    if($res==false){
        echo mysqli_error($link),"<br>";
    }else{
        echo "таблица objects успешно создана <br>";
    }
    mysqli_close($link);

    //создание экземпляра класса Item
     $item = new Item(34);

     //вывод текущих значений соотвествующих полей
     echo $item->name,"<br>";
     echo $item->status,"<br>";

     //изменения значений
     $item->name="lamp";
     $item->status=100000;

     //сохранение значений
     $item->save();

?>