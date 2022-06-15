<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" sizes="196x196" href="img/favicon.png">
  <title>Exemplo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

</script>

</head>
<body class="bg-dark" style="color:white">

<div class="container col-md-6">
    <form enctype="multipart/form-data" method="post" action="add_action.php">
        <br>
        <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" onchange="preview()">
        <input type="submit" class="btn btn-primary mt-3" value="Enviar">
    </form>
    <br>
    <img id="frame" src="" class="img-fluid" />

    <?php
    echo "<br>É preciso que o usuário que executa o web server (". exec('whoami') .") seja o dono do diretório onde as imagens serão armazenadas.";
    echo " Para isso, execute os comandos abaixo:";
    echo "<br><i>&nbsp;&nbsp;sudo chown ". exec('whoami') ." [diretório]";
    echo "<br>&nbsp;&nbsp;sudo chmod 775 -R [diretório]</i>";
    echo "<br>Onde <i>[diretório]</i> é o diretório onde as imagens ficarão armazenadas.";
    echo "<br><br>Além disso, fique atento para alterar o caminha para esse diretório no código-fonte, quando necessário.";
    ?>

</div>



</body>
</html>  