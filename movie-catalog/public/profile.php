<?php
/**
 * Страница профиля авторизованного пользователя.
 * Отображает информацию о текущем пользователе из базы данных.
 *
 * @category Profile
 * @package  MovieCatalogApp
 * @author   
 */

// Включение отображения всех ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Запуск сессии
session_start();

// Проверка авторизации пользователя
if (!isset($_SESSION['user_id'])) {
    // Перенаправление на страницу входа, если пользователь не авторизован
    header('Location: login.php');
    exit;
}

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "movie_catalog");

// Проверка подключения
if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Получение ID пользователя из сессии
$user_id = (int) $_SESSION['user_id'];

// Выполнение запроса на получение информации о пользователе
$result = $mysqli->query("SELECT * FROM users WHERE id = $user_id");

if (!$result || $result->num_rows === 0) {
    die("Пользователь не найден.");
}

// Извлечение данных пользователя
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
</head>
<body>
    <h1>Профиль</h1>
    <p><strong>Имя пользователя:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><a href="index.php">На главную</a> | <a href="logout.php">Выйти</a></p>
</body>
</html>


