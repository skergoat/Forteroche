
<!-- show thema and subtitles when clicked -->

<?php 

if($countThema == "1" || $countThema == "3") { // if all title have thema or some titles habve thema

	if(isset($indexTitles)) { ?><!-- if click on thema to get title -->

	  <?php foreach($before as $beforeTitle) { ?><!-- show thema before the one selected -->

			<p class="menu-label">	
				<a class="menuClick" id="label<?= $beforeTitle->getId(); ?>"><?= $beforeTitle->getTheme_label(); ?>
					<span id="index.php?postaction=getindex&amp;id=<?= $beforeTitle->getId() ; ?>"></span>
				</a>
			</p>

	  <?php } 

	  	foreach($indexTitles as $indexChapters) { ?><!-- show titles -->

			<ul class="menu-list">
		    	<li>
		    		<a href="index.php?postaction=post&amp;id=<?= $indexChapters->getId(); ?>"><?= $indexChapters->getTitle(); ?>
		    		</a>
		    	</li>
			</ul>

	  <?php }

	  	foreach($after as $afterTitle) { ?><!-- show thema after the one selected -->

			<p class="menu-label">	
				<a class="menuClick" id="label<?= $afterTitle->getId(); ?>"><?= $afterTitle->getTheme_label() ; ?>
					<span id="index.php?postaction=getindex&amp;id=<?= $afterTitle->getId() ; ?>"></span>
				</a>
			</p>
			
<?php } } }  ?>

<?php if($countThema == "1") { ?><!-- show "Autre" if post without themas -->

<p class="menu-label">
	<a>Autres</a>
</p>

<?php } ?>

<?php foreach($postWithoutThema as $withoutThema) { ?><!-- show only titles if no themas -->

<ul class="menu-list">
	<li>
		<a href="index.php?postaction=post&amp;id=<?= $withoutThema->getId(); ?>"><?= $withoutThema->getTitle(); ?>
		</a>
	</li>
</ul>

<?php } 

?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!--     <script src="public/js/jquery.js"></script>  -->
<script src="public/js/Blog.js"></script>

			
	
