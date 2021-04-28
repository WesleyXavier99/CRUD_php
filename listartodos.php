<?php 
//LISTAR TODOS
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

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listar alunos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<h1>Listar alunos</h1>
			<form action="listartodos.php" method="post">
				<input type="submit" name="enviar"><br><br>
			</form>	
	</section>
	<h3><a href="Menu.html">Voltar</a></h3>
</body>
</html>
<?php
	// cria a instrução SQL que vai selecionar os dados
		$query = sprintf("SELECT id, nome, email, matricula FROM alunos");

		// executa a query
		$dados = mysqli_query($conn,$query) or die(mysqli_error());

		// transforma os dados em um array
		$linha = mysqli_fetch_assoc($dados);

		// calcula quantos dados retornaram
		$total = mysqli_num_rows($dados);

		// se o número de resultados for maior que zero, mostra os dados
		if($total > 0) {
			// inicia o loop que vai mostrar todos os dados
			do {
	?>
				<p><?=$linha['id']?> / <?=$linha['nome']?> / <?=$linha['email']?> / <?=$linha['matricula']?></p>
	<?php
			// finaliza o loop que vai mostrar os dados
			}while($linha = mysqli_fetch_assoc($dados));
		// fim do if
		}else{
			echo "<br>Tabela vazia!!";
		}
?>