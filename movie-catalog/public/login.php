<?php
/**
 * Страница входа в систему.
 * Обрабатывает POST-запрос формы входа, проверяет учетные данные,
 * устанавливает сессию и перенаправляет пользователя в зависимости от его роли.
 *
 * @package  MovieCatalogApp
 * @category Authentication
 */

session_start();

/**
 * Подключение к базе данных
 *
 * @var mysqli $mysqli
 */
$mysqli = new mysqli("localhost", "root", "", "movie_catalog");

if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

$error = '';

/**
 * Обработка отправки формы
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /** @var string $username */
    $username = trim($_POST['username'] ?? '');

    /** @var string $password */
    $password = trim($_POST['password'] ?? '');

    // Поиск пользователя в базе данных
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Проверка наличия пользователя
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Проверка пароля
        if (password_verify($password, $user['password'])) {
            // Установка сессии
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Перенаправление по роли
            if ($user['role'] === 'admin') {
                header('Location: admin_panel.php');
            } else {
                header('Location: index.php');
            }
            exit;
        } else {
            $error = "Неверный пароль!";
        }
    } else {
        $error = "Пользователь не найден!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
    <h1>Вход</h1>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>
            Логин:<br>
            <input type="text" name="username" required>
        </label><br><br>

        <label>
            Пароль:<br>
            <input type="password" name="password" required>
        </label><br><br>

        <button type="submit">Войти</button>
    </form>

    <p><a href="register.php">Нет аккаунта? Зарегистрироваться</a></p>
</body>
</html>

<?php
/** Закрытие подключения */
$mysqli->close();
?>


