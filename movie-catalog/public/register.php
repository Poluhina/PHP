<?php
/**
 * Страница регистрации нового пользователя.
 * Обрабатывает форму регистрации, проверяет уникальность логина и email,
 * хеширует пароль и сохраняет данные в базу.
 */

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "movie_catalog");
if ($mysqli->connect_errno) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $email && $password) {
        // Хеширование пароля
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Подготовленное выражение для проверки уникальности логина и email
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Пользователь с таким логином или email уже существует!";
        } else {
            // Подготовленное выражение для сохранения нового пользователя в базу
            $stmt = $mysqli->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $email);
            $stmt->execute();

            // Перенаправление на страницу входа после успешной регистрации
            header('Location: login.php');
            exit;
        }
        $stmt->close();
    } else {
        $error = "Пожалуйста, заполните все поля!";
    }
}
?>

