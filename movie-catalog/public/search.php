<?php
/**
 * Страница поиска фильмов по названию.
 * Принимает поисковый запрос от пользователя, безопасно выполняет поиск в базе данных
 * и отображает результаты.
 */

session_start();

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "movie_catalog");

if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Массив для хранения результатов поиска
$search_results = [];

// Обработка POST-запроса с поисковым запросом
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $query = trim($_POST['query'] ?? '');

    // Проверка на пустой запрос
    if (!empty($query)) {
        // Безопасный поиск с использованием подготовленных выражений
        $stmt = $mysqli->prepare("SELECT * FROM movies WHERE title LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("s", $query);
        $stmt->execute();
        $result = $stmt->get_result();

        // Сохраняем найденные фильмы в массив
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }

        $stmt->close();
    } else {
        $error = "Пожалуйста, введите запрос для поиска!";
    }
}
?>

<!-- Форма поиска -->
<form action="search.php" method="POST">
    <input type="text" name="query" placeholder="Введите название фильма" required>
    <button type="submit">Поиск</button>
</form>

<!-- Вывод результатов поиска -->
<?php if (isset($error)) { echo "<p>$error</p>"; } ?>

<?php if (!empty($search_results)) { ?>
    <h2>Результаты поиска:</h2>
    <ul>
        <?php foreach ($search_results as $movie) { ?>
            <li>
                <h3><?php echo htmlspecialchars($movie['title']); ?></h3>
                <p><?php echo htmlspecialchars($movie['description']); ?></p>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>Фильмы не найдены.</p>
<?php } ?>





