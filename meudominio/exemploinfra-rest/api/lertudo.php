<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET"); // Alterado para GET
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

ini_set('display_errors', 1); // Habilitar exibição de erros
error_reporting(E_ALL); // Mostrar todos os erros

include_once '../config/database.php';
include_once '../classe/pecas.php';	

$database = new Database();
$db = $database->getConnection();
$items = new Computador($db);

// Certifique-se de que o método getPecas() está retornando um PDOStatement
$stmt = $items->getPecas();

// Verifique se a consulta foi bem-sucedida
if ($stmt) {
    $itemCount = $stmt->rowCount();
    if ($itemCount > 0) {
        $computadorArr = array();
        $computadorArr["body"] = array();
        $computadorArr["itemCount"] = $itemCount;

        // Adicionando cada item à resposta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $e = array(
                "item_id" => $item_id,
                "conteudo" => $conteudo
            );
            array_push($computadorArr["body"], $e);
        }

        // Envia a resposta JSON com os dados
        echo json_encode($computadorArr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Nenhum registro encontrado!!!"));
    }
} else {
    http_response_code(500);
    echo json_encode(array("message" => "Erro na consulta ao banco de dados"));
}
?>

