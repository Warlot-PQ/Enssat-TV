<?php
	include("haut.php");
	require("ini.class.php");

	$videos=new ini();
	$videos->m_fichier("videos.ini");
	$nbVideos=$videos->nbGroup();
	if(isset($_GET["e"])) {
		$edition = stripslashes($_GET["e"]);
	}
	else {
		$edition = $nbVideos;
	}
?>
<div id="contenu">
<div class="row">
	<div class="span12">
	<?php
		$videos->m_groupe($edition);
		$videos->m_item('photos');
		$albums = array();
		$albums = explode(',', $videos->valeur);
	?>
		<h2 class="pull-left"><?php $videos->m_item('titre'); echo $videos->valeur; ?></h2>
		<div style="margin-top:20px;" class="btn-group pull-right">
			<a id="previous-video" class="btn btn-inverse" <?php if($edition!=1) { ?>href="?e=<?php echo $edition-1; ?>"<?php } else {?> href="#" disabled<?php } ?>><i class="icon-chevron-left icon-white"></i></a>
			<a id="next-video" class="btn btn-inverse" <?php if($edition!=$nbVideos) { ?>href="?e=<?php echo $edition+1; ?>"<?php } else {?> href="#" disabled<?php } ?>><i class="icon-chevron-right icon-white"></i></a>
		</div>
		<input id="resolution-button" type="button" style="margin-top:20px;margin-right:5px;font-weight:bold;" class="btn btn-inverse pull-right" value="HD" onclick="switchResolution();"/>
		<iframe id="iframe-video" width="940" height="530" src="<?php $videos->m_item('url'); echo $videos->valeur; ?>" frameborder="0" allowfullscreen></iframe>
		<div class="bloc">
			<?php $videos->m_item('description'); echo $videos->valeur; ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="span8">
		<?php $videos->m_item('photos'); if($videos->valeur!='') { ?><h2>Photos</h2><?php } ?>
		<?php
		$photos=new ini();
		$photos->m_fichier("photos.ini");
		foreach ($photos->fichier_ini as $valPhoto) {
			if(in_array($valPhoto['id'], $albums)) {
				if($valPhoto['nbPhotos']==0) {
		?>
				<span class="folder-muted"><img src="img/folder-muted.png" alt="folder-icon" /><br/><?php echo $valPhoto['nom']; ?></span>
		<?php
				}
				else {
		?>
				<a href="gallery.php?g=<?php echo $valPhoto['id']; ?>" class="folder"><img src="img/folder.png" alt="folder-icon" /><br/><?php echo $valPhoto['nom']; ?></a>
		<?php
				}
			}
		}
		?>
	</div>
	<div class="span4">
		<div class="bloc">
			<h5>Newsletter</h5>
			<form id="monForm" method="POST" action="newsletter.php">
				<div class="input-prepend">
					<p>
						<span class="add-on text-black">@</span>
						<input type="text" id="mail" name="mail" placeholder="Votre email"/>
					</p>
				</div>
				<p><button id="souscrire" class="btn btn-primary" type="submit" value="Je m'abonne"/>Je m'abonne <i class="icon-white icon-ok-sign"></i></button></p>
			</form>
			<div id="infoMail" class="alert alert-success hide">Merci de vous être abonné !</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
iframeSrc = document.getElementById('iframe-video').src;

function is_mail(mail){
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

	return(reg.test(mail));
}

$(document).ready(function() {
    // lorsque je soumets le formulaire
    $('#monForm').on('submit', function() {

        // je récupère les valeurs
        var mail = $('#mail').val();

        // je vérifie une première fois pour ne pas lancer la requête HTTP
        // si je sais que mon PHP renverra une erreur
        if(mail != '' && is_mail(mail)) {
            // appel Ajax
            $.ajax({
                url: $(this).attr('action'), // le nom du fichier indiqué dans le formulaire
                type: $(this).attr('method'), // la méthode indiquée dans le formulaire (get ou post)
                data: $(this).serialize() // je sérialise les données, ici les $_POST
            });
            $("#souscrire").attr("class", "btn btn-success");
            $("#souscrire").attr("disabled", true);
            $("#infoMail").slideDown(500).delay(2000).slideUp(500);
        }
        return false; // j'empêche le navigateur de soumettre lui-même le formulaire
    });
});

function switchResolution() {
	if(document.getElementById('iframe-video').src == iframeSrc) {
		document.getElementById('resolution-button').value = "SD";
		document.getElementById('iframe-video').src = iframeSrc + "&q=sd";
	} else {
		document.getElementById('resolution-button').value = "HD";
		document.getElementById('iframe-video').src = iframeSrc;
	}
}
</script>
<?php include("bas.php"); ?>
