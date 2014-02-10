<?php include("haut.php"); ?>
<script type="text/javascript">
function Chargement_Equipe(id_clicked)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("saison").innerHTML = xmlhttp.responseText;
		}
		else
		{
			$('#saison').html('<div style="text-align:center;"><img src="loading.png" /></div>');
		}
	}
	if (id_clicked == "saison1")
		xmlhttp.open("GET","equipe-saison1.php",true);
	else
		xmlhttp.open("GET","equipe-saison2.php",true);
	xmlhttp.send();
}
function ChangeColor(id_clicked, value)
{
	if (value == "yes")
	{
		$("#"+id_clicked).css("background", "none repeat scroll 0% 0% rgba(255, 255, 255, 0.5)");
	}
	else
	{
		$("#"+id_clicked).css("background", "none repeat scroll 0% 0% rgba(255, 255, 255, 0.1)");
	}
}
</script>
<div class="row">
	<div class="span12">
		<h2>L'équipe</h2>
		<center><img width="800" height="530" src="img/equipe_2.jpg" alt="L'équipe" /></center>
		<div class="bloc">
			<p style="text-align:justify;">
				L'équipe se compose d'étudiants qui souhaitent couvrir toute l'actualité de la vie étudiante de l'ENSSAT.
				Nous vous proposerons régulièrement nos éditions avec des rubriques aussi bien sérieuses que décalées.
				Chaque édition sera accompagnée de photos qui retraceront les évènements les plus marquants.
			</p>
			<p>
				Bonne visite !
			</p>
		</div>
	</div>
</div>
<div class="row">
<div class="span12">
		<h2>Les membres de l'équipe</h2>
<div class="row">
	<div class="row">
		<div class="span12" style="text-align:center;">
			<div class="bloc" id="saison1" style="float:left;" onClick="Chargement_Equipe(this.id);" onMouseOver="ChangeColor(this.id, 'yes');" onMouseOut="ChangeColor(this.id, 'no');">
				Saison 1
			</div>
			<div class="bloc" id="saison2" style="margin-left:20px;float:left;" onClick="Chargement_Equipe(this.id);" onMouseOver="ChangeColor(this.id, 'yes');" onMouseOut="ChangeColor(this.id, 'no');">
				Saison 2
			</div>
		</div>
	</div>
	<div id="saison">
		<?php
			include("equipe-saison2.php");
		?>
	</div>
</div>
</div>
</div>
<?php include("bas.php"); ?>
