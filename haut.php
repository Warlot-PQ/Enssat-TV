<!DOCTYPE html>
<html>
<head>
	<title>ENSSAT TV</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	
	<script type="text/javascript" src="jquery-2.0.3.min.js"></script>
	
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />
</head>
<body>
<div class="container">
	<nav class="pull-right">
		<div id="nav" class="btn-group">
			<a class="btn btn-inverse" href="index.php"><i class="icon-home icon-white"></i> Accueil</a>
			<a class="btn btn-inverse" href="archives.php"><i class="icon-film icon-white"></i> Archives</a>
			<a class="btn btn-inverse" href="equipe.php"><i class="icon-th-list icon-white"></i> L'équipe</a>
			<a class="btn btn-inverse" href="demandereportage.php"><i class="icon-search icon-white"></i> Demande de reportage</a>
			<a class="btn btn-inverse" href="rejoigneznous.php"><i class="icon-ok icon-white"></i> Rejoignez-nous</a>
		</div>
	</nav>
	<header>
		<h1>ENSSAT TV</h1>
		<?php
			require("ini.class.php");	
			//DEBUT COMPTEUR VISITEUR
			if (!isset($_COOKIE['ip'])) //Si pas de cookie IP
			{
				if (file_exists("compteur.ini"))
				{
					$item = "visiteurs";
					$heure = date("H") + 1;
					
					$compteur = new ini();
					$compteur->m_fichier("compteur.ini");
					
					$compteur->m_groupe(date("d/m/Y"));
					$compteur->m_item($item);
					if ($compteur->valeur != NULL) //Si la valeur éxiste (donc si on a déjà un groupe - date du jour)
					{
						//incrémente le nombre visiteur total
						$compteur->m_put($compteur->valeur+=1);
						//sauvegarde des modif
						$compteur->save();
					}
					else
					{//Aucun groupe n'éxiste (pas de visiteur pour aujourd'hui)
						$chemin = "compteur.ini";
						$texte = "\n[".date("d/m/Y")."]\n".$item."=1";
						$handle = fopen($chemin, "a+");
						fwrite($handle, $texte);
						fclose($handle);
					}
					//Envoi d'un cookie IP
					setcookie('ip', $_SERVER['REMOTE_ADDR'], time()+24*3600);
				}	
			}
			//FIN COMPTEUR VISITEUR
		?>
	</header>
