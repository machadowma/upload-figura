<?php

/*
// É preciso que o usuário de sistema que executa o upload seja o dono do diretório.
// Comandos abaixo:
//    sudo chown nomeUsuario diretorioUpload
//    sudo chmod 775 -R diretorioUpload
echo "<br><br>Usuário que deve ser o dono do diretório de upload: ";
echo exec('whoami');
*/

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

$uploaddir = '/var/www/html/cadastro_de_figuras/figuras/';
$input_name = 'fileToUpload';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES[$input_name]) ) {
  $name     = $_FILES[$input_name]['name'];
  $type     = $_FILES[$input_name]['type'];
  $tmp_name = $_FILES[$input_name]['tmp_name'];
  $error    = $_FILES[$input_name]['error'];
  $size     = $_FILES[$input_name]['size'];
 
  // Verifica se há erro com o arquivo
  switch ($error) {
    case UPLOAD_ERR_OK:
      $response = 'There is no error, the file uploaded with success.';
      break;
    case UPLOAD_ERR_INI_SIZE:
      $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
      break;
    case UPLOAD_ERR_FORM_SIZE:
      $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
      break;
    case UPLOAD_ERR_PARTIAL:
      $response = 'The uploaded file was only partially uploaded.';
      break;
    case UPLOAD_ERR_NO_FILE:
      $response = 'No file was uploaded.';
      break;
    case UPLOAD_ERR_NO_TMP_DIR:
      $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
      break;
    case UPLOAD_ERR_CANT_WRITE:
      $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
      break;
    case UPLOAD_ERR_EXTENSION:
      $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
      break;
    default:
      $response = 'Unknown upload error';
      break;
  }

  if($error !== UPLOAD_ERR_OK)
    die($response);

  // Certificar que é um upload e não um ataque de Path Traversal
  if (is_uploaded_file($tmp_name) === false) {
    die('Error on upload: Invalid file definition');
  }

  // Verificar se o arquivo é uma imagem
  $mimetype = mime_content_type($tmp_name);
  if ($mimetype!="image/jpeg" && $mimetype!="image/png") {
    die('Error on upload: Invalid file type: '.$mimetype);
    
  }

  // Renomear o arquivo com a hora atual e um número randômico
  $uploadName = $name;
  $ext = strtolower(substr($uploadName, strripos($uploadName, '.')+1));
  $filename = round(microtime(true)).mt_rand().'.'.$ext; 

  // Salvar o arquivo na pasta
  move_uploaded_file($tmp_name, $uploaddir.$filename);

  // Cadastrar os dados da figura no banco de dados
  try {
    include("banco_dados_conexao.php");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("insert into figura (nome_arquivo) values (?);");
    $stmt->bindParam(1, $nome_arquivo);
    $nome_arquivo=$filename;
    if($stmt->execute()) {
      header("Location: index.php");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}


?>