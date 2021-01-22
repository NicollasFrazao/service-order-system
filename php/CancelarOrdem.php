<?php
	setcookie("OS[OrdemRecente][etapaOrdem]", "", time()-3600, "/");
	setcookie("OS[OrdemRecente][codigoCliente]", "", time()-3600, "/");
	setcookie("OS[OrdemRecente][codigoAparelho]", "", time()-3600, "/");
	setcookie("OS[OrdemRecente][codigoOrdem]", "", time()-3600, "/");
	setcookie("OS[OrdemRecente][codigoVerificador]", "", time()-3600, "/");
	setcookie("OS[OrdemRecente][problemasAparelho]", "", time()-3600, "/");
	setcookie("OS[OrdemRecente][codigosServico]", "", time()-3600, "/");
	
	echo '1'.((isset($aviso)) ? $aviso : ';-;');
?>