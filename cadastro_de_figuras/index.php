<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" sizes="196x196" href="img/favicon.png">
  <title>Exemplo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="custom.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


</head>
<body class="bg-dark">

<div class="sticky-top bg-dark p-3">
	<a href="add_form.php" class="btn btn-primary btn-rounded" ><span class='bi-plus'></span>Adicionar</a>
</div>

<div class="container">
	<?php
	include("banco_dados_conexao.php");
	try {
		include("banco_dados_conexao.php");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sth = $dbh->prepare("select * from figura order by criado_em");
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		?><div class="d-flex flex-wrap bg-dark"><?php
		foreach($result as $row) {
			?>
			<div class='card text-dark bg-light m-2' style='max-width: 18rem;'>
			<div class='card-header'>
    		<div class='float-start'><?php echo $row["criado_em"];?></div>
    		<div class='float-end'><a href="excluir.php?id=<?php echo $row["id"];?>"><span class='bi-trash'></span></a></div>
			</div>
			<div class='card-body'>
			<img src='figuras/<?php echo $row["nome_arquivo"];?>' class='img-thumbnail' alt='<?php echo $row["criado_em"];?>' width='304' height='236'> 
			</div>
			</div>
			<?php
		}
		?></div><?php
		
		$dbh = null;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/><br><a href='painel.php'>voltar</a>";
		die();
	}
	?>
</div> 

</body>
</html>
