

<?php 

if($countThema == "1" || $countThema == "3") {

	if(isset($indexTitles)) { ?>

  <?php foreach($before as $beforeTitle) { ?>			<!-- titres befores -->

		<p class="menu-label">	
			<a class="showClick" id="label-link<?= $beforeTitle->getId(); ?>"><?= $beforeTitle->getTheme_label(); ?>
				<span id="index.php?postaction=getindex&amp;id=<?= $beforeTitle->getId() ; ?>&amp;id_post=<?= $singleMessage->getId(); ?>"></span>
			</a>
		</p>

  <?php } 

  	   foreach($indexTitles as $indexChapters) { ?>		<!-- subtitles -->

		<ul class="menu-list">
	    	<li><a href="index.php?postaction=post&amp;id=<?= $indexChapters->getId(); ?>"><?= $indexChapters->getTitle(); ?></a></li>
		</ul>

  <?php }

  foreach($after as $afterTitle) { ?>					<!-- titres after -->

		<p class="menu-label">	
			<a class="showClick" id="label-link<?= $afterTitle->getId(); ?>"><?= $afterTitle->getTheme_label(); ?>
				<span id="index.php?postaction=getindex&amp;id=<?= $afterTitle->getId() ; ?>&amp;id_post=<?= $singleMessage->getId(); ?>"></span>
			</a>
		</p>

 <?php }

	} else {
?>

<?php foreach($index as $titleThemas) { ?>				<!-- themas -->

	<p class="menu-label">	
		<a class="showClick" id="label-link<?= $titleThemas->getId(); ?>"><?= $titleThemas->getTheme_label(); ?>
			<span id="index.php?postaction=getindex&amp;id=<?= $titleThemas->getId(); ?>&amp;id_post=<?= $singleMessage->getId(); ?>"></span>
		</a>
	</p>

<?php } } } 

if($countThema == "1") { ?>

<p class="menu-label">
	<a>Autres</a>
</p>

<?php } ?>

<?php foreach($postWithoutThema as $withoutThema) { ?>

		<ul class="menu-list">
		<li><a href="index.php?postaction=post&amp;id=<?= $withoutThema->getId(); ?>"><?= $withoutThema->getTitle(); ?></a></li>
	</ul>

<?php } 

?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!--     <script src="public/js/jquery.js"></script>  -->
<script src="public/js/Blog.js"></script>
