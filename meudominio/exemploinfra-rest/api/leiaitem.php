<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../classe/pecas.php';

$database = new Database();
$db = $database->getConnection();
$item = new Computador($db);

// verifica se o parâmetro item_id foi passado
if (!isset($_GET['item_id'])) {
    http_response_code(400);
    echo json_encode(["message" => "Parâmetro item_id é necessário!"]);
    exit();
}

$item->item_id = $_GET['item_id'];  // atribui o item_id vindo da URL

// chama a função para pegar o conteúdo
$item->getPecaUnica();

// verificando se encontrou o item
if ($item->conteudo != null) {
    // cria um array com os dados
    $comp_arr = array(
        "item_id" => $item->item_id,
        "conteudo" => $item->conteudo
    );
    http_response_code(200); 
    echo json_encode($comp_arr);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Peca não encontrada!"]);
}
?>

