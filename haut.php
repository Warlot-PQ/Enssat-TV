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
			<a class="btn btn-inverse" href="equipe.php"><i class="icon-search icon-white"></i> L'équipe</a>
			<a class="btn btn-inverse" href="demandereportage.php"><i class="icon-search icon-white"></i> Demande de reportage</a>
		</div>
	</nav>
	<header>
		<h1>ENSSAT TV</h1>
		<?php
			//DEBUT COMPTEUR VISITEUR
			if (file_exists ("./compteur.txt"))
			{
				$fichier = fopen("./compteur.txt","r");
				$numeroLigne = 0;		
				//On parcourt toutes les lignes du fichiers pour trouver la date du jours
				do
				{
					$ligne = fgets($fichier, 255);
					$date = substr($ligne, 0, 10);
					$visites = substr($ligne, 10);
					if ($numeroLigne == 0)
						$text = $ligne;
					else
						$text .= $ligne;
					feof($fichier);
					$numeroLigne++;
				}
				while ($date != date("d/m/Y") && $ligne != false);
				//Si la date n'est pas répértorié (aucun visiteur pour le jours actuel), on l'ajoute
				if ($date != date("d/m/Y"))
				{
					$visites = 0;
					$text .= date("d/m/Y")." ".$visites;
					fwrite($fichier, $text);
				}
			}
			else
			{//Si le fichier de comptage n'éxiste pas
				$fichier = fopen("./compteur.txt","w+");
				$visites = 0;
				$text = date("d/m/Y")." ".$visites;
				fwrite($fichier, $text);
			}
			fclose($fichier);
			//Si le visiteur(client) ne possède pas le cookie
			if (!isset($_COOKIE['ip']))
			{
				$visites++;
				$fichier = fopen("./compteur.txt", "w");
				$text = substr($text, 0, strlen($text) - 1).$visites;
				fwrite($fichier, $text);
				fclose($fichier);
				//On lui envoie un cookie
				setcookie('ip', $_SERVER['REMOTE_ADDR'], time()+24*3600);
			}
			//FIN COMPTEUR VISITEUR
		?>
	</header>
