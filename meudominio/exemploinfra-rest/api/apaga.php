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
$db = $database->getConnection();$item = new Computador($db);
$data = json_decode(file_get_contents("php://input"));
$item->item_id = $data->item_id;
if($item->deletePeca()){
echo json_encode("Peca apagada da base de dados!!!");
} else{
echo json_encode("Nao e possivel apagar a peca da base de dados!!!");
}
?>
