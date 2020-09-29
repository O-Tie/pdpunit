<?php

/**** ArrayIterator ****/
$arr = ["Moscow", "Munich", "Beijing", "Roma", "Barcelona", "London"];

// Создаем ArrayIterator и передаем ему массив
$iter = new ArrayIterator($arr);

// Цикл для обработки объекта
foreach ($iter as $key => $value) {
    echo $key . ":  " . $value . "<br>";
}

echo '<hr>';

/**** ArrayRecursiveIterator ****/
$arr = [
    ["sitepoint", "phpmaster"],
    ["buildmobile", "rubysource"],
    ["designfestival", "cloudspring"],
    "not an array"
];

$iter = new RecursiveArrayIterator($arr);


// Цикл по объекту
// Нужно создать экземпляр RecursiveIteratorIterator
foreach (new RecursiveIteratorIterator($iter) as $key => $value) {
    echo $key . ":  " . $value . "
";
}

echo '<hr>';

/**** DirectoryIterator ****/

// Создаем новый объект DirectoryIterator
$dir = new DirectoryIterator('./app');

// Цикл по содержанию директории
foreach ($dir as $item) {
    echo $item . "<br>";
}
