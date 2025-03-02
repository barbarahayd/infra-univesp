<?php
class Computador{
// Conexao
private $conn;
// Tabela
private $db_table = "computador";
// Colunas da base de dados
public $item_id;
public $conteudo;
// Conexao com a base de dados
public function __construct($db){
$this->conn = $db;
}
// Lista todas as pecas
public function getPecas(){
$sqlQuery = "SELECT item_id, conteudo FROM " . $this->db_table . "";
$stmt = $this->conn->prepare($sqlQuery);
$stmt->execute();
return $stmt;
}
// Cria uma peca
public function criaPeca(){
$sqlQuery = "INSERT INTO
". $this->db_table ."
SET
conteudo = :conteudo";
$stmt = $this->conn->prepare($sqlQuery);
// Limpa conteudo
$this->conteudo=htmlspecialchars(strip_tags($this->conteudo));
// Obtem o dado
$stmt->bindParam(":conteudo", $this->conteudo);
if($stmt->execute()){
return true;
}
return false;
}
// Atualiza a base de dados
public function getPecaUnica(){$sqlQuery = "SELECT
item_id,
conteudo
FROM
". $this->db_table ."
WHERE
item_id = ?
LIMIT 0,1";
$stmt = $this->conn->prepare($sqlQuery);
$stmt->bindParam(1, $this->item_id);
$stmt->execute();
$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
$this->conteudo = $dataRow['conteudo'];
}
// Atualiza apenas baseado no item_id
public function updatePeca(){
$sqlQuery = "UPDATE
". $this->db_table ."
SET
conteudo = :conteudo
WHERE
item_id = :item_id";
$stmt = $this->conn->prepare($sqlQuery);
$this->conteudo=htmlspecialchars(strip_tags($this->conteudo));
$this->item_id=htmlspecialchars(strip_tags($this->item_id));
// Obtem os dados
$stmt->bindParam(":conteudo", $this->conteudo);
$stmt->bindParam(":item_id", $this->item_id);
if($stmt->execute()){
return true;
}
return false;
}
// Apaga uma peca
function deletePeca(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE item_id = ?";
$stmt = $this->conn->prepare($sqlQuery);
$this->item_id=htmlspecialchars(strip_tags($this->item_id));
$stmt->bindParam(1, $this->item_id);if($stmt->execute()){
return true;
}
return false;
}
}
?>
