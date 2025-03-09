<?php 

declare(strict_types=1);

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

function calculateTotalAmount(array $transactions) : float {
   $total = 0;
   foreach ($transactions as $transaction) {
      $total += $transaction['amount'];
   }
   return $total;
}

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

function daysSinceTransaction(string $date): int {
   $transactionDate = strtotime($date);
   $today = time();
   return (int)(($today - $transactionDate) / 86400);
}

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Дата</th><th>Сумма</th><th>Описание</th><th>Магазин</th><th>Дней с момента</th></tr>";
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

echo "<p>Общая сумма: " . calculateTotalAmount($transactions) . "</p>";

?>