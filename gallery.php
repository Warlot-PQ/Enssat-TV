<?php
	include("haut.php");
	require("ini.class.php");
	
	$photos=new ini();
	$g = htmlentities($_GET['g']);
	$dir = opendir("photos/$g");
	$photos->m_fichier("photos.ini");
	$photos->m_groupe($g);
?>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox();
});
</script>
<div class="bloc">
	<a class="btn btn-inverse" onclick="history.back()"><i class="icon-arrow-left icon-white"></i> Retour</a>
	<h2 class="pull-right"><?php $photos->m_item('nom'); echo $photos->valeur; ?></h2>
</div>
<div id="contenu" class="row">
	<div class="span12">
	
<?php
while ($fichier = readdir($dir)) {
	if ($fichier != "." && $fichier != ".." && $fichier != "thumbs") {
		echo "<a class=\"fancybox\" data-fancybox-group=\"gallery\" href=\"photos/$g/$fichier\"><img class=\"img-polaroid\" src=\"photos/$g/thumbs/$fichier\" alt=\"$fichier\" /></a>";
	}
}
closedir($dir);
?>

	</div>
</div>

<?php
	include("bas.php");
?>
