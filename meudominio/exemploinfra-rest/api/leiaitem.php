<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-
Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../classe/pecas.php';
$database = new Database();
$db = $database->getConnection();
$item = new Computador($db);
$item->item_id = isset($_GET['item_id']) ? $_GET['item_id'] : die();
$item->getPecaUnica();
if($item->conteudo != null){
// cria um array
$comp_arr = array(
"item_id" => $item->item_id,
"conteudo" => $item->conteudo
);
http_response_code(200);
echo json_encode($comp_arr);
}
else{
http_response_code(404);
echo json_encode("Peca nao encontrada!!!");
}
?>
