<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить фильм</title>
</head>
<body>
    <h2>Добавить новый фильм</h2>
    <form action="/handlers/movie_handler.php" method="post">
        <label for="title">Название фильма:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="genre">Жанр:</label>
        <select id="genre" name="genre">
            <option value="Драма">Драма</option>
            <option value="Комедия">Комедия</option>
            <option value="Фантастика">Фантастика</option>
            <option value="Боевик">Боевик</option>
        </select><br>

        <label for="description">Описание:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="year">Год выпуска:</label>
        <input type="number" id="year" name="year" min="1900" max="2025" required><br>

        <label for="rating">Рейтинг (0-10):</label>
        <input type="number" id="rating" name="rating" step="0.1" min="0" max="10" required><br>

        <label for="actors">Актерский состав:</label>
        <input type="text" id="actors" name="actors"><br>

        <button type="submit">Добавить фильм</button>

    </form>
</body>
</html>