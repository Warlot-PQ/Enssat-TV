<?php
	include_once("ini.class.php");
	
	$videos=new ini();
	$videos->m_fichier("videos.ini");
	$nbVideos=$videos->nbGroup();
	
	$photos=new ini();
	$photos->m_fichier("photos.ini");
	
	$debut = $nbVideos;
	$fin = 7;
		
if (isset($_GET['saison'])) {
	if ($_GET['saison'] == 1) {
		$debut = 7;
		$fin = 0;
	}
}
	for($i = $debut; $i > $fin; $i-=1) {
		$videos->m_groupe($i);
		$videos->m_item('photos');
		$albums = array();
		$albums = explode(',', $videos->valeur);
?>
<div class="bloc">
	<div>
		<h3 style="display:inline;"><a href="index.php?e=<?php echo $i; ?>"><?php $videos->m_item('titre'); echo $videos->valeur; ?></a></h3>
		<span style="float:right;"><?php $videos->m_item('date'); echo $videos->valeur; ?></span>
	</div>
	<div class="bloc">
		<?php $videos->m_item('description'); echo $videos->valeur; ?>
	</div>
	<?php $videos->m_item('photos'); if($videos->valeur!='') { ?>
	<div class="bloc">
		<?php
			foreach ($photos->fichier_ini as $valPhoto) {
				if(in_array($valPhoto['id'], $albums)) {
		?>
		<i class="icon-camera icon-white"></i> <a href="gallery.php?g=<?php echo $valPhoto['id']; ?>"><?php echo $valPhoto['nom']; ?></a>&nbsp;&nbsp;&nbsp;
		<?php
				}
			}
		?>
	</div>
	<?php } ?>
</div>
<?php
	}
?>
