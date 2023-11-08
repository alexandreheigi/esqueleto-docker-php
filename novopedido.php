<?php

use Unialfa\DatabaseConnection;

require_once 'vendor/autoload.php';

$host = "mysqlunialfa";
$port = "3307";
$username = "root";
$password = "root";
$dbname = "pedidos";

$db = new DatabaseConnection($host, $port, $username, $password, $dbname);

$query = "INSERT INTO `pedido` (`id`, `nome`, `valor`) VALUES (NULL, 'Mac', 6000.98)";
$result = $db->query($query);

echo "<pre>";
echo "<h1>Pedido adicionado com sucesso.</h1>";
echo "</pre>";

$db->closeConnection();