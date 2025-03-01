<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../classe/pecas.php';
$database = new Database();
$db = $database->getConnection();
$items = new Computador($db);
$stmt = $items->getPecas();
$itemCount = $stmt->rowCount();
echo json_encode($itemCount);
if($itemCount > 0){
$computadorArr = array();
$computadorArr["body"] = array();
$computadorArr["itemCount"] = $itemCount;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);
$e = array(
"item_id" => $item_id,
"conteudo" => $conteudo
);
array_push($computadorArr["body"], $e);
}
echo json_encode($computadorArr);
}else{
http_response_code(404);
echo json_encode(
array("memssagem" => "Nenhum registro encontrado!!!")
);
}
?>
