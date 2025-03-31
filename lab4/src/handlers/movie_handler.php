<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение данных из формы
    $title = $_POST["title"] ?? "";
    $genre = $_POST["genre"] ?? "";
    $year = $_POST["year"] ?? "";
    $rating = $_POST["rating"] ?? "";
    $actors = $_POST["actors"] ?? "";

    // Валидация
    if ($title === "" || $genre === "" || $actors === "" || !is_numeric($year) || !is_numeric($rating)) {
        echo "Ошибка: Заполните все поля корректно!";
        exit;
    }  

    // Данные для сохранения
    $movie = [
        "title" => $title,
        "genre" => $genre,
        "year" => $year,
        "rating" => $rating,
        "actors" => explode(",", $actors)  // Разделение актеров запятой в массив
    ];

    file_put_contents("../../storage/movies.txt", json_encode($movie) . PHP_EOL, FILE_APPEND);

    header("Location: ../../public/index.php");
    exit;
}
?>