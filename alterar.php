<?php 
//ALTERAR
if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		//Receber informações do usuario
		$id = $_POST["id"];
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$matricula = $_POST["matricula"];

		//validar informações do usuario
		if ($id != "" and $nome != "" and $email != "" and $matricula != "" ) {
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
	<title>Alterar um aluno</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<h1>Alterar um aluno</h1>
			<form action="alterar.php" method="post">
				id do aluno: <input type="text" name="id"><br><br>
				novo nome: <input type="text" name="nome"><br><br>
				novo email: <input type="text" name="email"><br><br>
				nova matricula: <input type="text" name="matricula"><br><br>
				<input type="submit" name="enviar"><br><br>
			</form>	
	</section>
	<h3><a href="Menu.html">Voltar</a></h3>
</body>
</html>
<?php 
if ($_SERVER['REQUEST_METHOD']=='POST') {
		/*verificar validação*/
		if ($validacão == 0) {
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

		/*verificar se o id procurado existe no banco*/

		//pesquisando dentro do banco o id 
		$query = "SELECT id FROM alunos WHERE id='$id'";
		$result_query = mysqli_query( $conn,$query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
 
		$remove = 0;
		//resultados encontrados
		while ($row = mysqli_fetch_array( $result_query )) {

			if ($row[id]==$id) {
				$remove = 1;
			}
		}

		//verificar se achou o id pesquisado pelo usuario 
		if ($remove == 0) {
			die("Aluno nao encontrado!!");
		}

		/*realizar inserção com verificação*/

		//comando que altera o campo
		$sql = "UPDATE alunos SET nome = '$nome',email = '$email',matricula = '$matricula' WHERE id = '$id'";

		//inserindo e vericando
		if (mysqli_query($conn,$sql)) {
			echo "<br>Dados alterados com sucesso!";
		}else{
			die("<br>Falha na alteração da linha<br><br>" . $sql . "<br><br>" . mysqli_error($conn));
		}
	}
?>