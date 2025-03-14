<?php
/**
 * Загружает результаты тестов из файла `results.json` и отображает их в виде таблицы.
 * Если файл не существует или в нем нет данных, показывается сообщение об отсутствии результатов.
 */

$resultsFile = 'results.json';

// Если файл существует, загружаем его содержимое. Если нет, создаем пустой массив.
$results = file_exists($resultsFile) ? json_decode(file_get_contents($resultsFile), true) : [];

// Проверяем, есть ли ошибки при декодировании JSON
// Если ошибка есть, выводим сообщение об ошибке и прерываем выполнение скрипта.
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Ошибка в JSON: " . json_last_error_msg());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица результатов</title>
</head>
<body>
    <h1>Результаты тестов</h1>

    <!-- Проверяем, есть ли результаты в массиве -->
    <?php if (!empty($results)) : ?>
        <!-- Если результаты есть, отображаем их в таблице -->
        <table border="1">
            <tr>
                <th>Имя</th>
                <th>Правильные ответы</th>
                <th>Всего вопросов</th>
                <th>Процент</th>
            </tr>

            <!-- Перебираем все результаты и выводим их в строках таблицы -->
            <?php foreach ($results as $result) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($result['name']); ?></td>
                    <td><?php echo $result['correct']; ?></td>
                    <td><?php echo $result['total']; ?></td>
                    <td><?php echo $result['percent']; ?>%</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <!-- Если результатов нет, выводим соответствующее сообщение -->
        <p>Результатов пока нет.</p>
    <?php endif; ?>
    
    <!-- Кнопка для возврата на главную страницу -->
    <a href="index.php"><button>На главную</button></a>
</body>
</html>




