<?php

use Unialfa\DatabaseConnection;

require_once 'vendor/autoload.php';

$host = "mysqlunialfa";
$port = "3307";
$username = "root";
$password = "root";
$dbname = "pedidos";

$db = new DatabaseConnection($host, $port, $username, $password, $dbname);

$query = "SELECT * FROM pedido WHERE p.movimentacao= 0";
$pedidosPendentes = $db->query($query);

foreach ($pedidosPendentes->fetchAll(PDO::FETCH_OBJ) as $pedidosPendente) {
    $query = "UPDATE pedido SET movimentacao = 1 WHERE id = $pedidosPendente->id";
    $db->query($query);


file_put_contents(
    'log.log', 
    print_r([
        "idpedido" => $pedidosPendente->id,
        "mensagem"  => "Atualizado com sucesso"
], true),
FILE_APPEND
);
}

$db->closeConnection();