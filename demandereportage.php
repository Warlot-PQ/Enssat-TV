<?php
	include("haut.php");
	require("ini.class.php");
?>
<div id="contenu">
<div class="row">
	<div class="span12">
		<h2>Demande de reportage</h2>
		<div class="bloc">
			<p>
				Si vous souhaitez que nous réalisions un reportage, présentions un événement ou autre, n'hésitez pas à nous contacter via le formulaire ci-dessous.
			</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="span12">
		<div class="bloc">
		<h3>Enregistrement de votre demande</h3>
			<div class="bloc">
				<div class="row" style="margin-bottom:0;text-align:center;">
					<form id="DRmonForm" name="DRmonForm" method="POST" onsubmit="return verifForm();" action="index.php">
						<div style="display:inline-block;text-align:left;">
							<p>
								Sujet
							</p><p>
								<input id="DRsujet" name="DRsujet" type=text />
							</p><p>
								Date de l'événement (facultatif)
							</p><p>
								<input id="DRdate" name="DRdate" type=text />
							</p><p>
								Description
							</p><p>
								<textarea id="DRdescription" name="DRdescription" rows="5" cols="0" style="resize:none;"></textarea>
							</p>
						</div>
						<div style="display:inline-block;text-align:left;margin-left:170px;vertical-align:top;">
							<p>
								Mail de contact (facultatif)
							</p><p>
								<input id="DRmail" name="DRmail" type=text />
							</p><p>
								Commentaire (facultatif)
							</p><p>
								<textarea id="DRcommentaire" name="DRcommentaire" rows="5" cols="0" style="resize:none;"></textarea>
							</p><p>
								<input class="btn btn-primary" type="submit" value="Enregistrer" />
							</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

<script type="text/javascript">

function is_mail(mail){
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

	return(reg.test(mail));
}

function verifForm() 
{
	// je récupère les valeurs
	var mail = $('#DRmail').val();
	if (mail != "" && !is_mail(mail))
	{
		alert("Mail saisie incorrect !");
		return false;
	}
	var sujet = $('#DRsujet').val();
	var description = $('#DRdescription').val();
	var commentaire = $('#DRcommentaire').val();
	if (sujet == "" || description ==  "")//sujet et descrption - champs obligatoire
	{
		alert("Champs incomplet");
		return false;
	}
	return true;
}
</script>
<?php include("bas.php"); ?>
