<?php
/**
 * Страница прохождения теста "Еда и напитки".
 */

// Загружаем вопросы из файла questions.json и декодируем JSON в массив
$questions = json_decode(file_get_contents('questions.json'), true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прохождение теста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Тест "Еда и напитки"</h1>

    <!-- Форма для ввода имени и прохождения теста -->
    <form action="result.php" method="post">
        
        <!-- Поле для ввода имени пользователя -->
        <label for="name">Введите ваше имя:</label>
        <input type="text" id="name" name="name" required>
        <br><br>

        <!-- Перебирает вопросы из массива и создает разметку для каждого -->
        <?php foreach ($questions['questions'] as $index => $question): ?>
            <fieldset>
                <!-- Заголовок вопроса -->
                <legend><?php echo ($index + 1) . ". " . $question['question']; ?></legend>
                
                <!-- Если вопрос с одиночным выбором (radio) -->
                <?php if ($question['type'] === 'radio'): ?>
                    <?php foreach ($question['options'] as $option): ?>
                        <label>
                            <!-- Радиокнопка: можно выбрать только один вариант -->
                            <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo $option; ?>" required>
                            <?php echo $option; ?>
                        </label><br>
                    <?php endforeach; ?>

                <!-- Если вопрос с множественным выбором (checkbox) -->
                <?php elseif ($question['type'] === 'checkbox'): ?>
                    <?php foreach ($question['options'] as $option): ?>
                        <label>
                            <!-- Чекбоксы: можно выбрать несколько вариантов -->
                            <input type="checkbox" name="answers[<?php echo $index; ?>][]" value="<?php echo $option; ?>">
                            <?php echo $option; ?>
                        </label><br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </fieldset>
        <?php endforeach; ?>

        <!-- Кнопка отправки формы -->
        <button type="submit">Завершить тест</button>
    </form>
</body>
</html>




