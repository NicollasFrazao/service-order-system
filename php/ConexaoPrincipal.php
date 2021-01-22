<?php
	$host = 'localhost';
	$user = '***REMOVED***';
	$pass = '***REMOVED***';
	$banco = 'app_db';

	$conexaoPrincipal = new Conexao();
	$conexaoPrincipal -> AbrirConexao($host, $user, $pass, $banco);
?>