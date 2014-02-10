<?php
	include("haut.php");
	$cryptinstall="captcha/cryptographp.fct.php";
	include $cryptinstall; 
?>
<div id="contenu">
<div class="row">
	<div class="span12">
		<h2>Rejoignez-nous</h2>
		<div class="bloc">
			<p style="text-align:justify;">
				L'Enssat TV a besoin de vous. Nous recherchons des personnes motivés pour nous aider à faire vivre le club et à couvrir les nombreux événements concernant les Enssatiens et les Enssatiennes. 
				Aucune compétence n'est requise, venez comme vous êtes.
			</p>
			<p>
				N'hésitez pas plus longtemps, nous vous attendons.
			</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="span12">
		<div class="bloc">
		<h3>We Need You !</h3>
			<div class="bloc">
				<div class="row" style="margin-bottom:0;text-align:center;">
					<form id="DRmonForm" name="DRmonForm" method="POST" onsubmit="return verifForm(<?PHP echo SID; ?>);" action="index.php">
						<div style="display:inline-block;text-align:left;">
							<p>
								Nom :
							</p><p>
								<input id="RECRUTnom" name="RECRUTnom" type=text />
							</p><p>
								Prénom :
							</p><p>
								<input id="RECRUTprenom" name="RECRUTprenom" type=text />
							</p><p>
								Filière :
							</p><p>
								<table cellspacing=0 cellpadding=5 style="text-align:center;">
									<tr>
										<td width=30><input class=RECRUTfiliere name=RECRUTfiliere type=radio value="EII" /></td>
										<td><input class=RECRUTfiliere name=RECRUTfiliere type=radio value="LSI" /></td>
										<td><input class=RECRUTfiliere name=RECRUTfiliere type=radio value="Optro" /></td>
										<td><input class=RECRUTfiliere name=RECRUTfiliere type=radio value="IMR" /></td>
										<td><input class=RECRUTfiliere name=RECRUTfiliere type=radio value="Autre" /></td>
									</tr>
									<tr>
										<td>EII</td>
										<td>LSI</td>
										<td>Optro</td>
										<td>IMR</td>
										<td>Autre</td>
									</tr>
								</table>
								<span id="spanRECRUTfiliere">
									Précisez :
									<input id="RECRUTfiliereautre" name="RECRUTfiliereautre" type=text style="width:150px;" />
								</span>
							<p>
								Mail :
							</p><p>
								<input id="RECRUTmail" name="RECRUTmail" type=text />
							</p>
						</div>
						<div style="display:inline-block;text-align:left;margin-left:170px;vertical-align:top;">
							<p>
								Motivations :
							</p><p>
								<textarea id="RECRUTmotiv" name="RECRUTmotiv" rows="5" cols="0" style="resize:none;"></textarea>
							</p>
							<p>
								Compétences :
							</p><p>
								<table cellspacing=0 cellpadding=5 style="text-align:center;">
									<tr>
										<td width=30><input class=RECRUTskill name=RECRUTskill type=radio value="Montage" /></td>
										<td><input class=RECRUTskill name=RECRUTskill type=radio value="Photographie" /></td>
										<td><input class=RECRUTskill name=RECRUTskill type=radio value="Autre" /></td>
									</tr><tr>
										<td>Montage</td>
										<td>Photographie</td>
										<td>Autre</td>
									</tr><tr>
										<td colspan=4><input class=RECRUTskill name=RECRUTskill type=radio value="motivation" checked /></td>
									</tr><tr>
										<td colspan=4>Ma motivation</td>
									</tr>
								</table>
								<span id="spanRECRUTskill" style="text-align:center;">
									Précisez :
									<input id="RECRUTskillautre" name="RECRUTskillautre" type=text style="width:150px;" />
								</span>
							<p>		
								<?php dsp_crypt(0,1); ?>
								Recopiez le code:<br>
								<input type="text" name="code"><br>
								<span id="check" style="text-align:center;color:red;"></span>
							</p><p style="margin-top:20px;">
								<input class="btn btn-primary" name="btnSubmit" type="submit" value="Enregistrer" />
							</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$( document ).ready(function() 
{
	$("#spanRECRUTfiliere").hide();
	$(".RECRUTfiliere").click(function() {
		var radio = document.getElementsByName("RECRUTfiliere");
		if (radio[4].checked)
			$("#spanRECRUTfiliere").show();
		else
			$("#spanRECRUTfiliere").hide();
	});
	$("#spanRECRUTskill").hide();
	$(".RECRUTskill").click(function() {
		var radio = document.getElementsByName("RECRUTskill");
		if (radio[2].checked)
			$("#spanRECRUTskill").show();
		else
			$("#spanRECRUTskill").hide();
	});
});

function is_mail(mail)
{
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

	return(reg.test(mail));
}

function verifForm(sid) 
{
	// je récupère les valeurs
	var mail = $('#RECRUTmail').val();
	if (mail == "" || !is_mail(mail))
	{
		alert("Mail saisie incorrect !");
		return false;
	}
	var Nom = $('#RECRUTnom').val();
	var Prenom = $('#RECRUTprenom').val();
	var filiere = document.getElementsByName("RECRUTfiliere");
	if (!filiere[0].checked && !filiere[1].checked && 
	!filiere[2].checked && 
	!filiere[3].checked && 
	!filiere[4].checked)//si aucune filière coché
	{
		alert("Veuillez cocher la case correspondant à votre filière");
		return false;
	}
	else if(filiere[4].checked && $('#RECRUTfiliereautre').val() == "")
	{
		alert("Vous avez spécifié \'Autre\' dans filière, veuillez préciser");
		return false;
	}
	var motivation = $('#RECRUTmotiv').val();
	var competence = document.getElementsByName("RECRUTskill");
	if (competence[2].checked && $('#RECRUTskillautre').val() == "")
	{
		alert("Vous avez spécifié \'Autre\' dans compétences, veuillez préciser");
		return false;
	}
	
	if (Nom == "" || Prenom ==  ""|| motivation ==  "")
	{
		alert("Vérifiez les champs Nom, Prénom et motivations");
		return false;
	}
	//Si tout est ok on check le captcha
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
			document.getElementById("check").innerHTML = xmlhttp.responseText;
			document.images.cryptogram.src='captcha/cryptographp.php?cfg=0&'+Math.round(Math.random(0)*1000)+1;
			var valeur = $('#check').text();
			if (valeur == "Captcha correct")
			{
				 document.forms["DRmonForm"].submit();
			}
		}
		else
		{
			$('#check').html('<img src="../loading.png" />');
		}
	}
	xmlhttp.open("POST","captcha/verifier.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("sid="+sid+"&code="+DRmonForm.elements['code'].value);
	
	return false;
}
</script>
<?php include("bas.php"); ?>
