<?php 
	//INSERIR
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		/*Receber informações do usuario*/
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$matricula = $_POST["matricula"];

		/*validar informações do usuario*/
		if ($nome !="" and $email !="" and $matricula !="" ) {
			$validação = 1;
		}else{
			$validação = 0;
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inserir um aluno</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<h1>Inserir um aluno</h1>
			<form action="inserir.php" method="post">
				Nome: <input type="text" name="nome"><br><br>
				Email: <input type="text" name="email"><br><br>
				Matricula: <input type="text" name="matricula"><br><br>
				<input type="submit" name="enviar"><br><br>
			</form>	
	</section>
	<h3><a href="Menu.html">Voltar</a></h3>
</body>
</html>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		/*verificar validação*/
		if ($validação == 0) {
			die("<br>Erro! Preencha os campos corretamente!");
		}

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

		/*realizar inserção com verificação*/

		//comando que insere o valor
		$sql = "INSERT INTO alunos (nome,email,matricula) VALUES ('$nome','$email','$matricula')";

		//inserindo e vericando
		if (mysqli_query($conn,$sql)) {
			echo "<br>Aluno inserido com sucesso!";
		}else{
			die("<br>Falha na criação da linha<br><br>" . $sql . "<br><br>" . mysqli_error($conn));
		}
	}
?>