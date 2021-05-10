<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {

		/*Receber informações do usuario*/
		$arquivo = $_POST["arquivocsv"];

  		//validando as informações
		if ($arquivo!="") {
			$validacao = 1;
		}else{
			$validacao = 0;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ler arquivo csv</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<h1>Ler arquivo csv</h1>
			<form action="lerarquivo.php" method="post">
				Digite o nome do arquivo:<input type="text" name="arquivocsv">
				<input type="submit" name="enviar"><br><br>
			</form>	
	</section>
	<h3><a href="Menu.html">Voltar</a></h3>
</body>
</html>

<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {

		/*realizar conexão com o banco*/

		//parametros para conexão com banco
		$servidor = "localhost";
		$baseDados = "dawfaeterj";
		$username = "root" ;
		$senha = "" ;

		//conectando com o banco
		$conn = mysqli_connect($servidor,$username,$senha,$baseDados);

		//verificar conexão
		if (!$conn) {
			die("<br>Falha na conexão!");
		}

		/*abrindo arquivo*/
		$handle = fopen("leitura.csv", "r");

		while ($line = fgetcsv($handle,1000,";")) {

			//obtendo os campos que serão inseridos no banco
			$nome = utf8_encode($line[0]);
			$email = utf8_encode($line[1]);
			$matricula = utf8_encode($line[2]);
			
			//inserindo valor no banco
			$result = $conn->query("INSERT INTO alunos (nome,email,matricula) VALUES ('$nome','$email','$matricula')");
		}
		
		//verificando se a inserção teve sucesso
		if ($result) {
			echo "<br>Dados inseridos com sucesso";
		}else{
			echo "<br>falha na inserção";
		}
		fclose($handle);

	}
?>