<?php
/**
 * Защищённая страница, доступная только авторизованным пользователям.
 * При отсутствии активной сессии выполняется перенаправление на страницу входа.
 *
 *
 * @category ProtectedPage
 * @package  MovieCatalogApp
 */

// Запуск сессии
session_start();

// Проверка авторизации пользователя
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Перенаправление, если пользователь не авторизован
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Защищённая страница</title>
</head>
<body>
    <h1>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Вы успешно вошли в систему.</p>
    <a href="logout.php">Выйти</a>
</body>
</html>

