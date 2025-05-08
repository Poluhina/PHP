<?php
/**
 * Главная страница каталога фильмов.
 * Доступна только авторизованным пользователям.
 *
 * @package  MovieCatalogApp
 * @category Pages
 */

session_start();

/**
 * Проверка авторизации
 */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/**
 * Подключение к базе данных
 *
 * @var mysqli $mysqli
 */
$mysqli = new mysqli("localhost", "root", "", "movie_catalog");

if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

/**
 * Получение всех фильмов
 *
 * @var string $query
 * @var mysqli_stmt $stmt
 * @var mysqli_result $result
 */
$query = "SELECT * FROM movies";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог фильмов</title>
    <link rel="stylesheet" href="/movie-catalog/public/styles/style.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="logout.php">Выйти</a></li>
            <li><a href="profile.php">Профиль</a></li>
            <li><a href="search.php">Поиск фильмов</a></li>
        </ul>
    </nav>
</header>

<h1>Каталог фильмов</h1>

<p><a href="add.php">+ Добавить фильм</a></p>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="movie">
            <div class="title"><?= htmlspecialchars($row['title']) ?></div>
            <div class="description"><?= nl2br(htmlspecialchars($row['description'])) ?></div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>Нет фильмов.</p>
<?php endif; ?>

</body>
</html>

<?php
/** Закрытие подключения и освобождение ресурсов */
$stmt->close();
$mysqli->close();
?>






