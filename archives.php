<?php
	include("haut.php");
	//require("ini.class.php");
	
	$videos=new ini();
	$videos->m_fichier("videos.ini");
	$nbVideos=$videos->nbGroup();
	
	$photos=new ini();
	$photos->m_fichier("photos.ini");
?>
<div class="row">
	<div class="span12">
		<h2>Archives</h2>
		<?php
			for($i=$nbVideos;$i>0;$i--) {
				$videos->m_groupe($i);
				$videos->m_item('photos');
				$albums = array();
				$albums = explode(',', $videos->valeur);
		?>
		<div class="bloc">
			<h3><a href="index.php?e=<?php echo $i; ?>"><?php $videos->m_item('titre'); echo $videos->valeur; ?></a></h3>
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
	</div>
</div>
<?php include("bas.php"); ?>
