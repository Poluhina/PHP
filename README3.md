# Лабораторная работа №3. Массивы и Функции

# Цель работы
Освоить работу с массивами в PHP, применяя различные операции: создание, добавление, удаление, сортировка и поиск. Закрепить навыки работы с функциями, включая передачу аргументов, возвращаемые значения и анонимные функции.

# Условие

# Задание 1. Работа с массивами
Разработать систему управления банковскими транзакциями с возможностью:

добавления новых транзакций;

удаления транзакций;

сортировки транзакций по дате или сумме;

поиска транзакций по описанию.

Добавила в начале файла строгую типизацию, на случай если функция должна вернуть один тип данных, а возвращает другой, то PHP выдаст ошибку.
```php
declare(strict_types=1);
```

Далее создала массив с банковскими транзакциями 
```php
$transactions = [
   [
      "id" => 1,
      "date" => '2024-01-01',
      "amount" => 100.00,
      "description" => "Покупки в магазине",
      "merchant" => "SuperMart",
   ],
   [
      "id" => 2,
      "date" => '2025-01-01',
      "amount" => 75.50,
      "description" => "Ужин с друзьями",
      "merchant" => "Local Restaurant",
   ],
];
```
```"id"``` – номер транзакции

```"date"``` – дата в формате YYYY-MM-DD

```"amount"``` – сумма транзакции

```"description"``` – описание

```"merchant"``` – название магазина

1.Функция calculateTotalAmount(array $transactions): float, которая вычисляет общую сумму всех транзакций.
```php
function calculateTotalAmount(array $transactions) : float {
   $total = 0;
   foreach ($transactions as $transaction) {
      $total += $transaction['amount'];
   }
   return $total;
}
```
```total = 0``` -переменная для суммы

```foreach ($transactions as $transaction)``` -цикл foreach пробегается по всем транзакциям

```total += $transaction['amount']``` -здесь прибавляется сумма каждой транзакции

```return $total``` -возвращает общую сумму

2.Функция findTransactionByDescription(string $descriptionPart), которая ищет транзакцию по части описания.


```php
function findTransactionByDescription(string $descriptionPart) : array {
   global $transactions;
   $result = [];
   foreach ($transactions as $transaction) {
      if (strpos($transaction['description'], $descriptionPart) !== false) {
         $result[] = $transaction;
      }
   }
   return $result;
}
```

```global $transactions```; -дает возможность использовать массив транзакций внутри фунуции

далее созается пустой массив ```$result``` куда будут добавляться подходящие транзакции

цикл foreach проходит по всем транзакциям ```foreach ($transactions as $transaction)```

3.Функция daysSinceTransaction(string $date): int, которая возвращает количество дней между датой транзакции и текущим днем
```php
function daysSinceTransaction(string $date): int {
   $transactionDate = strtotime($date);
   $today = time();
   return (int)(($today - $transactionDate) / 86400);
}
```
```strtotime($date)``` -преобразует дату в число секунд

```time()``` -возвращает текущее время в секундах

```(today - transactionDate)``` / 86400 -вычисляется разница в днях (86400 – количество секунд в сутках)

4.Этот код создает таблицу в HTML и добавляет заголовки
```php
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Дата</th><th>Сумма</th><th>Описание</th><th>Магазин</th><th>Дней с момента</th></tr>";
```

5.Таблица заполняется данными
```php
foreach ($transactions as $transaction) {
   echo "<tr>";
   echo "<td>{$transaction['id']}</td>";
   echo "<td>{$transaction['date']}</td>";
   echo "<td>{$transaction['amount']}</td>";
   echo "<td>{$transaction['description']}</td>";
   echo "<td>{$transaction['merchant']}</td>";
   echo "<td>" . daysSinceTransaction($transaction['date']) . "</td>";
   echo "</tr>";
}
echo "</table>";
```
цикл foreach проходит по всем транзакциям

```<tr>``` -выводит строку для каждой транзакции

```<td>``` -вставляет значения из массива в столбцы

в колонке "Дней с момента" вызывается функция daysSinceTransaction(), чтобы показать разницу в днях

6.Вывод суммы всех транзакций
```php
echo "<p>Общая сумма: " . calculateTotalAmount($transactions) . "</p>";
```
Этот код вызывает ```calculateTotalAmount()``` и выводит сумму

# Задание 2. Работа с файловой системой






# Контрольные вопросы

1.Что такое массивы в PHP?

Массив в PHP — это упорядоченная структура данных, которая связывает ключи и значения 

В PHP выделяют два основных типа массивов:

Индексированные массивы. Ключи — целые числа, начинающиеся с 0 и увеличивающиеся на 1 для каждого следующего элемента (обычные массивы)

Ассоциативные массивы. Ключи могут быть произвольными строками

Все массивы в PHP представляют собой структуры данных типа "ключ-значение"

2.Каким образом можно создать массив в PHP?

Индексированные массивы можно создать с помощью функции array() или использовать короткий синтаксис с квадратными скобками []

Ассоциативные массивы позволяют использовать произвольные строки или числа в качестве ключей. Их можно создать с помощью функции array() или квадратных скобок []

3.Для чего используется цикл foreach?

foreach -это цикл, который автоматически перебирает элементы массива, не требуя работы с индексами
