<?php
	if (!isset($_COOKIE['OS']['OrdemRecente']['codigoAparelho']) || !isset($_COOKIE['OS']['OrdemRecente']['etapaOrdem']))
	{
		exit;
	}
	
	$proximo = $_POST['etapaOrdem'] + 1;
	
	if ($_POST['etapaOrdem'] == $_COOKIE['OS']['OrdemRecente']['etapaOrdem'])
	{
		//$_SESSION['OS']['OrdemRecente']['etapaOrdem'] = $_SESSION['OS']['OrdemRecente']['etapaOrdem'] + 1;
		setcookie("OS[OrdemRecente][etapaOrdem]", $_COOKIE['OS']['OrdemRecente']['etapaOrdem'] + 1, time() + (86400 * 1), "/"); // 86400 = 1 day
	}
			
	echo '1;-;Cadastrado do aparelho realizado com sucesso!;-;'.$proximo;
?>