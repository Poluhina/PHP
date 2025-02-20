# Лабораторная работа №1: 
# Установка и первая программа на PHP
Цель работы
Целью данной лабораторной работы является установка и настройка среды разработки для работы с языком программирования PHP, а также создание первой программы на PHP.
# Шаг 1: Установка PHP
Перешла на официальный сайт PHP и скачала актуальную версию PHP для Windows.
Затем сохранила изменения.
С помощью команды  php -v проверила установку PHP.
# Шаг 2: Написание первой PHP-программы

```php

<?php

echo "Привет, мир!";

echo "Hello, World with echo!";
print "Hello, World with print!";

$days = 288;
$message = "Все возвращаются на работу!";

echo $days . " " . $message . "<br>";
echo "День {$days}, {$message} <br>";

?>
```
После запуска программа выдала результат "Привет, мир!".
# Шаг 3: Вывод данных в PHP
В файл "index.php" добавила код:
```php
    <?php
   echo "Hello, World with echo!";
   print "Hello, World with print!";
   >?

```
# Шаг 4: Работа с переменными и выводом

В файл "index.php" добавила следующий код:
```php
<?php
$days = 288;
$message = "Все возвращаются на работу!";

// Вывод с использованием конкатенации
echo $days . " дней. " . $message . "<br>";

// Вывод с использованием двойных кавычек
echo "$days дней. $message<br>";

// Использование HTML-тега для перевода строки
echo $days . " дней.<br>" . $message;
?>
```
# Контройльные вопросы
1.Какие способы установки PHP существуют?

Один из способов установки  PHP это перейти на офицальнный сайт  PHP и скачать актуальн PHP версию

