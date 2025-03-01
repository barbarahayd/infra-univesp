<?php
$user = "alunoinfra";
$password = "Aluno123#@";
$database = "exemploinfra";
$table = "computador";
try {
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
echo "<h2>LISTA DE COMPONENTES DE UM COMPUTADOR</h2><ol>";
foreach($db->query("SELECT conteudo FROM $table") as $row) {
echo "<li>" . $row['conteudo'] . "</li>";
}
echo "</ol>";
} catch (PDOException $e) {
print "Ocorreu um erro!: " . $e->getMessage() . "<br/>";
die();
}
