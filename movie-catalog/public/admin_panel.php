<?php
/**
 * Админ-панель для управления пользователями.
 * Только пользователи с ролью "admin" имеют доступ.
 * 
 * Позволяет создать нового администратора и просмотреть список всех пользователей.
 *
 * 
 * @package MovieCatalog\AdminPanel
 */

session_start();

// Проверка авторизации и роли пользователя
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "movie_catalog");

// Проверка соединения с базой данных
if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

/**
 * @var string $message Сообщение об ошибке или успехе
 */
$message = '';

// Обработка формы создания нового администратора
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /**
     * @var string $new_username Новый логин администратора
     * @var string $new_password Хешированный пароль администратора
     */
    $new_username = trim($_POST['new_username']);
    $new_password = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT);

    // Проверка, существует ли уже такой пользователь
    $check = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $new_username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Пользователь с таким именем уже существует.";
    } else {
        // Добавление нового администратора
        $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
        $stmt->bind_param("ss", $new_username, $new_password);
        if ($stmt->execute()) {
            $message = "Новый администратор успешно добавлен.";
        } else {
            $message = "Ошибка при добавлении администратора.";
        }
        $stmt->close();
    }
    $check->close();
}

// Получение списка всех пользователей
/**
 * @var mysqli_result|false $users_result Результат запроса на выборку пользователей
 */
$users_result = $mysqli->query("SELECT id, username, role FROM users ORDER BY id");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="/movie-catalog/public/styles/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Каталог фильмов</a></li>
                <li><a href="admin_panel.php">Админ-панель</a></li>
                <li><a href="logout.php">Выйти</a></li>
            </ul>
        </nav>
    </header>

    <h1>Админ-панель</h1>

    <?php if ($message): ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <section>
        <h2>Добавить нового администратора</h2>
        <form method="POST" action="">
            <label>
                Логин:<br>
                <input type="text" name="new_username" required>
            </label><br><br>
            <label>
                Пароль:<br>
                <input type="password" name="new_password" required>
            </label><br><br>
            <button type="submit">Создать администратора</button>
        </form>
    </section>

    <section>
        <h2>Список пользователей</h2>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Роль</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $users_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= $user['role'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</body>
</html>

<?php
// Закрытие соединения с базой данных
$mysqli->close();
?>

