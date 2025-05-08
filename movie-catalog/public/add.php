<?php
/**
 * Файл add.php — обрабатывает добавление нового фильма в базу данных movie_catalog.
 * 
 * 
 * @package MovieCatalog
 */

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "movie_catalog");

// Проверка соединения с базой данных
if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Если форма была отправлена методом POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /**
     * @var string $title       Название фильма
     * @var string $description Описание фильма
     * @var string $genre       Жанр фильма
     */
    $title = $_POST['title'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];

    /**
     * SQL-запрос на вставку нового фильма
     * 
     * @var string $query
     */
    $query = "INSERT INTO movies (title, description, genre) VALUES (?, ?, ?)";

    /**
     * Подготовка SQL-запроса
     * 
     * @var mysqli_stmt|false $stmt
     */
    $stmt = $mysqli->prepare($query);

    // Обработка ошибки подготовки запроса
    if ($stmt === false) {
        die('Ошибка подготовки запроса: ' . $mysqli->error);
    }

    // Привязка параметров к запросу
    $stmt->bind_param("sss", $title, $description, $genre);

    // Выполнение запроса и вывод результата
    if ($stmt->execute()) {
        echo "Фильм успешно добавлен!";
    } else {
        echo "Ошибка при добавлении фильма: " . $stmt->error;
    }

    // Закрытие подготовленного выражения
    $stmt->close();
}

// Закрытие соединения с базой данных
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить фильм</title>
</head>
<body>
    <h1>Добавить фильм</h1>

    <!-- Форма для добавления нового фильма -->
    <form action="add.php" method="POST">
        <label for="title">Название фильма:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Описание фильма:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="genre">Жанр:</label><br>
        <input type="text" id="genre" name="genre" required><br><br>

        <button type="submit">Добавить фильм</button>
    </form>
</body>
</html>



