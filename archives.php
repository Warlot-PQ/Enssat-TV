<?php include("haut.php"); ?>
<script type="text/javascript">
	var saison = 2;
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
		if (id_clicked == "saison1") {
			saison = 1;
			$("#saison2").css("background", "none repeat scroll 0% 0% rgba(255, 255, 255, 0.1)");
		} else {
			saison = 2;
			$("#saison1").css("background", "none repeat scroll 0% 0% rgba(255, 255, 255, 0.1)");
		}
		xmlhttp.open("GET", "archives-saison.php?saison=" + saison, true);
		xmlhttp.send();
	}
	function ChangeColor(id_clicked, value)
	{
		if (id_clicked != "saison" + saison) {
			if (value == "yes") {
				$("#"+id_clicked).css("background", "none repeat scroll 0% 0% rgba(255, 255, 255, 0.5)");
			} else {
				$("#"+id_clicked).css("background", "none repeat scroll 0% 0% rgba(255, 255, 255, 0.1)");
			}
		}
	}
</script>
<div class="row">
	<div class="span12">
		<h2>Archives</h2>
		<div class="row">
			<div class="span12" style="text-align:center;">
				<div class="bloc" id="saison1" style="float:left;" onClick="Chargement_Equipe(this.id);" onMouseOver="ChangeColor(this.id, 'yes');" onMouseOut="ChangeColor(this.id, 'no');">
					Saison 1
				</div>
				<div class="bloc" id="saison2" style="margin-left:20px;float:left;background: none repeat scroll 0% 0% rgba(255, 255, 255, 0.5);" onClick="Chargement_Equipe(this.id);" onMouseOver="ChangeColor(this.id, 'yes');"  onMouseOut="ChangeColor(this.id, 'no');">
					Saison 2
				</div>
			</div>
		</div>
		<div id="saison">
			<?php
				include("archives-saison.php");
			?>
		</div>
	</div>
</div>
<?php include("bas.php"); ?>
