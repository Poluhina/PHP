<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   
<?php

$dayOfWeek = date("1");

if ($dayOfWeek == "Понедельник" || $dayOfWeek == "Среда" || $dayOfWeek == "Пятница") {
   $johnSchedule = "8:00-12:00";
} else {
   $johnSchedule = "Нерабоций день";
}

if ($dayOfWeek == "Вторник" || $dayOfWeek == "Четверг" || $dayOfWeek == "Суббота") {
   $janeSchedule = "12:00-16:00";
} else {
   $janeSchedule = "Нерабоций день";
}

echo "<table border='1'>";
echo "<tr><th>№</th><th>Фамилия Имя</th><th>График работы</th></tr>";
echo "<tr><th>1</td><td>John Styles</td><td>$johnSchedule</td></tr>";
echo "<tr><th>2</td><td>Jane Doe</td><td>$janeSchedule</td></tr>";
echo "</table>";

?>
</body>
</html>