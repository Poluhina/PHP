<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; }
        .gallery { 
            display: flex; 
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 10px; 
        }
        .gallery img { 
            width: 200px; 
            height: auto; 
            border-radius: 5px; 
            flex-basis: calc(33.333% - 10px); 
        }
    </style>
</head>
<body>

<h2>Галерея изображений</h2>

<div class="gallery">
    <?php
    $dir = 'image/';
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            echo "<img src='$dir$file' alt='Картинка'>";
        }
    }
    ?>
</div>

</body>
</html>


