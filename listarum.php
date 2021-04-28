<?php 
//LISTAR UM
if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		//Receber informações do usuario
		$id = $_POST["id"];

		//validar informações do usuario
		if ($id != "" ) {
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
	<title>Listar um aluno</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<h1>Listar um aluno</h1>
			<form action="listarum.php" method="post">
				id do aluno: <input type="text" name="id"><br><br>
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
		$query = "SELECT id,nome,email,matricula FROM alunos WHERE id='$id'";
		$result_query = mysqli_query( $conn,$query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
 
		//percorrendo e exibindo o array com a listagem
		$verifica = 0;
		while ($row = mysqli_fetch_array( $result_query )) {

			echo "<br>$row[id]";
			echo "<br>$row[email]";
			echo "<br>$row[nome]";
			echo "<br>$row[matricula]";
			$verifica = 1;
		}


		//verificar se achou o id pesquisado pelo usuario 
		if ($verifica == 0) {
			die("Aluno nao encontrado!!");
		}

	}
?>