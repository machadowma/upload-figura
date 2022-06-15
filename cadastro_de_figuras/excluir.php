<?php

if(!empty($_GET["id"])){
  $uploaddir = '/var/www/html/cadastro_de_figuras/figuras/';
  try {

    include("banco_dados_conexao.php");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare("select * from figura where id = ?");
    $stmt->bindParam(1, $id);
    $id=$_GET["id"];
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    unlink($uploaddir.$result[0]["nome_arquivo"]);
    
    $stmt = $dbh->prepare("delete from figura where id = ?;");
    $stmt->bindParam(1, $id);
    $id=$_GET["id"];
    $stmt->execute();
      
    header("Location: index.php");

  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
?>