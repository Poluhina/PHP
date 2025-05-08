<?php
/**
 * Скрипт выхода пользователя из системы.
 * Уничтожает текущую сессию и перенаправляет на страницу входа.
 *
 *
 * @category Authentication
 * @package  MovieCatalogApp
 */

// Инициализация сессии
session_start();

// Уничтожение всех данных сессии
session_destroy();

// Перенаправление на страницу входа
header('Location: login.php');
exit;
?>
