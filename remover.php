<?php 
	//REMOVER
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		//Receber informações do usuario
		$id = $_POST["id"];

		//validar informações do usuario
		if ($id != "") {
			$validacão = 1;
		}else{
			$validacão = 0;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Remover um aluno</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<h1>Remover um aluno</h1>
			<form action="remover.php" method="post">
				Digite o id do aluno: <input type="text" name="id"><br><br>
				<input type="submit" name="enviar"><br><br>
			</form>	
	</section>
	<h3><a href="Menu.html">Voltar</a></h3>
</body>
</html>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		//verificar validação
		if ($validacão == 0) {
			die("<br>Erro! Preencha os campos corretamente!");
		}

		//realizar conexão com o banco
		$servidor = "localhost";
		$baseDados = "dawfaeterj";
		$username = "root" ;
		$senha = "" ;

		$conn = mysqli_connect($servidor,$username,$senha,$baseDados);

		//verificar conexão
		if (!$conn) {
			die("<br>Falha na conexão!".$conn->connect-error );
		}

		/*verificar se o id pesquisado está dentro do banco*/

		//pesquisando dentro do banco o id 
		$query = "SELECT id FROM alunos WHERE id='$id'";
		$result_query = mysqli_query( $conn,$query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
 	
 		//verificando se o aluno foi achado
		if (!mysqli_fetch_array( $result_query )) {
			die("<br>Aluno nao encontrado!!");
		}


		//realizar remoção
		$sql = "DELETE FROM alunos WHERE id='$id' ";

		if (mysqli_query($conn,$sql)) {
			echo "<br>Aluno removido com sucesso!";
		}else{
			die("<br>Falha na remoção do aluno<br><br>" . $sql . "<br><br>" . mysqli_error($conn));
		}
	}
?>