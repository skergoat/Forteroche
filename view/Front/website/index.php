<?php 

	// implement controller to show replies 

	use Controller\RepliesController;

	require_once('Controller/RepliesController.php');

	$newReply = new RepliesController; 

?>

<?php $title = "Jean Forteroche - Blog" ?>

<?php $tiny = "" ?>

<?php $bigTitle = "Accueil" ?>

<?php ob_start(); ?>

	<section class="container-container-title">

		<div class="container is-fluid sections test3">

			<h3 class="title is-1 title-homepage">Billets simples pour l'Alaska</h3>
			<h3 class="subtitle is-4 subtitle-homepage">découvrez les derniers chapitres</h3>

		</div>

	</section>

	<div class="container is-fluid container-index container-index-page">

		<div class="layout-index">

	  		<div class="column is-three-quarters sections test1" id="main">

				<div class="pagination" role="navigation" aria-label="pagination" >
					<ul class="pagination-list">

					<?php

					for($i = 1 ; $i <= $nbdePages ; $i++){

						if($i == $pageActuelle){ ?>

							<li>
						      <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?= $i ?></a>
						    </li>

						<?php } else { ?>

							    <li>
							    	<a class="pagination-link" aria-label="Goto page 2" href="index.php?paginate=<?= $i ?>"><?= $i ?></a>
							    </li>
							 
						<?php } 
					} ?>
				</ul>
				</div>

				<div>

					<?php foreach($messages as $message) { ?>

					<div>

						<div class="card card-index">

						  <a href="index.php?postaction=post&amp;id=<?= $message->getId(); ?>">

						  <div class="card-image">
						    <!-- <figure class="image is-4by3 picture-index" style="background: url(<?= $message->getPicture_url(); ?>);background-size:cover;"> -->
						    <figure class="image is-4by3 picture-index">
						      <?php if($message->getPicture_url() == NULL) { ?>
						      	<img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
						      	<?php } else { ?>
						      	<img src="<?= $message->getPicture_url(); ?>" alt="<?= $message->getPicture_url(); ?>"> 
						      	<?php } ?>
						    </figure>
						  </div>

						  <div class="card-content card-content-homepage">

						    <div class="media">
						      <div class="media-content">
						        <p class="title is-4 title-card-homepage"><?= $message->getTitle(); ?></p>
						      </div>
						    </div>

						    <div class="content content-extract">
						    	<?php $test = strip_tags($message->getContent()); ?>
						    	<p><?= substr($test, 0, 140); ?> [...] </p>
						    	<span class="readMore" title="lire la suite">Lire la suite</span>
						    </div>

						  </div>

						  </a>

						</div>

					</div>

					<?php } ?>

				</div>

					<div class="pagination" role="navigation" aria-label="pagination">
						<ul class="pagination-list">

							<?php

							for($i = 1 ; $i <= $nbdePages ; $i++){

								if($i == $pageActuelle){ ?>

									<li>
								      <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?= $i ?></a>
								    </li>

								<?php } else { ?>

									    <li>
									    	<a class="pagination-link" aria-label="Goto page 2" href="index.php?paginate=<?= $i ?>"><?= $i ?></a>
									    </li>
									 
								<?php } 
							} ?>
						</ul>
					</div>

			</div>

			<div class="test2-post test2-index"> 

				<aside id="menuTry" class="meny-try-index">

					<p class="title is-6 title-index title-index-post"><a href="index.php">Sommaire du Roman</a></p>

					<div class="container-list-index" id="menuIndex">

					<?php require('getIndex.php'); ?>

					</div>

				</aside>

			</div>

		</div>

	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/Front/layout.php'); ?>