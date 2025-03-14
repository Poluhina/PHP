<?php
/**
 * Загружает все результаты тестов из файла `results.json` и отображает их в виде таблицы.
 * Если данных нет, выводится сообщение об отсутствии результатов.
 */

$resultsFile = 'results.json';

// Проверяем, существует ли файл и загружаем данные из него. Если файл не найден, создаем пустой массив.
$results = file_exists($resultsFile) ? json_decode(file_get_contents($resultsFile), true) : [];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица всех результатов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Таблица всех результатов</h1>
    <?php if (empty($results)): ?>
        <p>Пока нет результатов.</p>
    <?php else: ?>
        <table border="1">
            <!-- Заголовки таблицы -->
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Правильных ответов</th>
                    <th>Всего вопросов</th>
                    <th>Процент правильных ответов</th>
                </tr>
            </thead>
            <!-- Тело таблицы, где выводятся данные для каждого пользователя -->
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <!-- Выводим имя пользователя (предотвращаем XSS уязвимости с помощью htmlspecialchars) -->
                        <td><?php echo htmlspecialchars($result['name']); ?></td>
                        <td><?php echo $result['correct']; ?></td>
                        <td><?php echo $result['total']; ?></td>
                        <td><?php echo $result['percent']; ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Ссылка на страницу теста для повторного прохождения -->
    <br>
    <a href="test.php">Пройти тест снова</a>
</body>
</html>

