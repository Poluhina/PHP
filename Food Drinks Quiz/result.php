<?php
/**
 * Обрабатывает ответы пользователя и вычисляет результат теста.
 */

// Получает имя пользователя из формы 
$name = $_POST['name'] ?? 'Без имени';

// Приводит имя к правильному формату: первая буква заглавная, остальные строчные
$name = ucfirst(strtolower($name));

// Загружает вопросы из файла questions.json и декодируем JSON в массив
$questions = json_decode(file_get_contents('questions.json'), true);

// Счетчик правильных ответов
$correctCount = 0;

// Общее количество вопросов в тесте
$totalQuestions = count($questions['questions']);

// Проверяет были ли отправлены ответы
if (!isset($_POST['answers'])) {
    echo "Ошибка: Вы не выбрали ни одного ответа.";
    exit; 
}

// Ответы пользователя из формы
$userAnswers = $_POST['answers'];

/**
 * Перебирает все вопросы и проверяет ответы пользователя.
 */
foreach ($questions['questions'] as $index => $question) {
    $correctAnswers = $question['correctAnswers']; // Правильные ответы для текущего вопроса
    $userResponse = $userAnswers[$index] ?? []; // Ответ пользователя (или пустой массив, если нет ответа)

    // Если ответ не массив (например, у radio), преобразует в массив для сравнения
    if (!is_array($userResponse)) {
        $userResponse = [$userResponse];
    }

    // Если ответ пользователя полностью совпадает с правильным, счетчик увеличивается
    if ($userResponse == $correctAnswers) {
        $correctCount++;
    }
}

// Вычисление процента правильных ответов
$scorePercent = round(($correctCount / $totalQuestions) * 100);

// Сохранение результата в файл results.json
$resultsFile = 'results.json';
$results = file_exists($resultsFile) ? json_decode(file_get_contents($resultsFile), true) : [];
$results[] = [
    'name' => $name,
    'correct' => $correctCount,
    'total' => $totalQuestions,
    'percent' => $scorePercent,
];
file_put_contents($resultsFile, json_encode($results, JSON_PRETTY_PRINT));

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты теста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Результаты теста</h1>

    <!-- Вывод количества правильных ответов -->
    <p>Правильных ответов: <?php echo $correctCount; ?> из <?php echo $totalQuestions; ?></p>

    <!-- Вывод процента правильных ответов -->
    <p>Ваш результат: <?php echo $scorePercent; ?>%</p>

    <!-- Кнопка для просмотра всех результатов -->
    <a href="view_results.php">Посмотреть таблицу всех результатов</a>

    <br>
    <!-- Кнопка для повторного прохождения теста -->
    <a href="test.php">Пройти снова</a>
</body>
</html>








