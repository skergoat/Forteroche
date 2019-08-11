<?php $title = "Modérer un commentaire" ?>

<?php $bigTitle = "Modérer un commentaire" ?>

<?php $tiny = "" ?>

<?php ob_start(); ?>

	<div class="container-page-updateAdmin">

		<div class="container-update-admin">

			<section class="container-menu-admin container-menu-moderate">

		        <div class="tabs is-toggle is-toggle-rounded">
		          <ul>
				    <li>
					  <a href="https://www.skergoat.com/projet_4/index.php?comaction=moderate&action=moderate">
			            <strong>Les Nouveaux</strong>
			          </a>
				    </li>
				    <li>
				      <a href="https://www.skergoat.com/projet_4/index.php?comaction=moderate&action=reported">
			            <strong>Les Signalés</strong>
			          </a>
				    </li>
				    <li>
				      <a href="https://www.skergoat.com/projet_4/index.php?comaction=reply">
			            <strong>La totalité</strong>
			          </a>
				    </li>
				  </ul>
				</div>

			</section><br/><br/>

			<section>

				<h3 class="title is-4">Commentaires Signalés</h3>

				<div class="pagination pagination-top" role="navigation" aria-label="pagination">
					<ul class="pagination-list">

				<?php

					for($i = 1 ; $i <= $nbdePages ; $i++){

						if($i == $pageActuelle){ ?>

							<li>
						      <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?= $i ?></a>
						    </li>

						<?php } else { ?>

							    <li>
							    	<a class="pagination-link" aria-label="Goto page 2" href="index.php?comaction=moderate&action=reported&paginate=<?= $i ?>"><?= $i ?></a>
							    </li>
							 
						<?php } 
					} ?>
				</ul>
				</div>

			    <div id="message-reported">
			    <?php if($nbReportedComments == 0) { ?>

					<article class="message is-danger message-reported">
					  <div class="message-body">
					    <p>Aucun commentaire signalé</p>
					  </div>
					</article>

				<?php } else { ?>
				</div>

					<?php foreach($showNewComments as $comment) { ?>

					<article class="message is-danger containerButton reported" id="message<?= $comment->getID(); ?>">
					  <div class="message-header">
					    <p><?= $comment->getAuthor(); ?></p>
					    <div class="buttons" id="buttons<?= $comment->getID(); ?>">
					    	<span class="icon has-text-light">
							  <a href="index.php?postaction=post&amp;id=<?= $comment->getPost_id(); ?>"><i class="fas fa-share-square" title="répondre"></i></a>
							</span>	
					    	<a class="commentButton validate" title="valider" id="validate<?= $comment->getID(); ?>" href="index.php?comaction=moderate&amp;id=<?= $comment->getID(); ?>&amp;action=validate&amp;page=reported">
					    		<span class="icon has-text-success" id="<?= $comment->getID(); ?>">
								  <i class="fas fa-check-square"></i>
								</span>
					    	</a>	
					    	<a class="delete commentButton destroy" title="supprimer" id="destroy<?= $comment->getID(); ?>" href="index.php?comaction=delete&amp;id=<?= $comment->getID(); ?>&amp;page=reported"><span id="<?= $comment->getID(); ?>"></span></a>
						</div>
					  </div>
					  <div class="message-body">
					    <p class="content-comment"><?= $comment->getContent(); ?></p><br/>
					    <p>Date : <strong><?= $comment->getDate_comment(); ?></strong> <br/></p>
					  </div>
					</article>

					<?php } ?>

				<?php } ?>
				
			</section>

		</div>

	</div>

	<?php if(isset( $_GET['paginate'])) { ?>

	<span class="pagination-info" id="paginations<?= $_GET['paginate'] ?>"><?= $_GET['paginate'] ?></span>
	<span class="pagination-name" id="report<?= $_GET['paginate'] ?>">reported</span>

	<?php } else { ?>

	<span class="pagination-info">empty</span>
	<span class="pagination-name">reported</span>

	<?php } ?>

	<div class="pagination" role="navigation" aria-label="pagination" style="margin-bottom: 100px;">
		<ul class="pagination-list">

	<?php

		for($i = 1 ; $i <= $nbdePages ; $i++){

			if($i == $pageActuelle){ ?>

				<li>
			      <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?= $i ?></a>
			    </li>

			<?php } else { ?>

				    <li>
				    	<a class="pagination-link" aria-label="Goto page 2" href="index.php?comaction=moderate&action=reported&paginate=<?= $i ?>"><?= $i ?></a>
				    </li>
				 
			<?php } 
		} ?>
	</ul>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>