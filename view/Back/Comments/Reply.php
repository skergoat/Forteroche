
<?php use Model\Post\PostsManager; ?>

<?php $title = "Reply" ?>

<?php $bigTitle = "Tous les commentaires" ?>


<?php $tiny = "" ?>

<?php ob_start(); ?>

	<div class="container-page-updateAdmin">

		<div class="container-all-comments">

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

			<section class="section-all">

				<h3 class="title is-4">Commentaires par Articles</h3>

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
							    	<a class="pagination-link" aria-label="Goto page 2" href="index.php?comaction=reply&paginate=<?= $i ?>"><?= $i ?></a>
							    </li>
							 
						<?php } 
					} ?>
				</ul>
				</div>

				<div id="message-moderate">
				<?php if(isset($commentResponse) && $commentResponse == 0) { ?>

			    	<article class="message is-warning message-reply">	
					  <div class="message-body">
					    <p>Aucun commentaire</p>
					  </div>
					</article>
				
				<?php } else { ?>
				</div>

					<div class="container-table-responsive">

						<table class="table table-all is-bordered">
						  <thead>
						    <tr>
						      <th>Post</th>
						      <th>Author</th>
						      <th>Mail</th>
						      <th>Lu</th>
						      <th>Signalé</th>
						      <th>Répondu</th>
						      <th>Actions</th>
						      <th>Date</th>
						    </tr>
						  </thead>
						  <tbody>

						<?php foreach($commentList as $tableComment) { ?>

						  	<tr id="tr<?= $tableComment->getId() ?>" class="rowTable">
						      <td><a href="index.php?postaction=post&amp;id=<?= $tableComment->getpost_id(); ?>" class="modifier"><strong><?php $post = new PostsManager; $returnTitle = $post->showPost($tableComment->getPost_id()); echo $returnTitle->getTitle(); ?></strong></a></td>
						      <td><strong><?= $tableComment->getAuthor(); ?></strong></td>
						      <td><?= $tableComment->getMail(); ?></td>
						      <td id="Lu<?= $tableComment->getID(); ?>"><?php if($tableComment->getRidden() == 1) { ?><span style="color:blue;">oui</span><?php } else { ?><span style="color:green;">non</span><?php } ?>
						  	  </td>
						      <td id="Verifie<?= $tableComment->getID(); ?>"><?php if($tableComment->getReported() == 1) { ?><span style="color:red;">oui</span><?php } else { ?><span style="color:green;">non</span><?php } ?>
						  	  </td>
						  	  <td>
						  	  	<?php if($tableComment->getReplied() == 1) { ?><strong><span style="color:red;">oui</span></strong><?php } else { ?><strong><span style="color:green;">non</span></strong><?php } ?>
						  	  </td>
						      <td>
						      	<?php if($tableComment->getRidden() == 1 && $tableComment->getReported() == 0) { ?>
						      	<a href="index.php?postaction=post&amp;id=<?= $tableComment->getpost_id(); ?>" id="share<?= $tableComment->getID(); ?>">
							      	<span class="icon has-text-success">
									 <i class="fas fa-share-square" title="répondre"></i>
									</span>
								</a>
								<?php } else { ?>
								<a class="commentButton validate" title="valider" id="validate<?= $tableComment->getID(); ?>" href="index.php?comaction=moderate&amp;id=<?= $tableComment->getID(); ?>&amp;action=validate&amp;page=moderate">
						    		<span class="icon has-text-success" id="<?= $tableComment->getID(); ?>">
									  <i class="fas fa-check-square check-icon" id="check<?= $tableComment->getID(); ?>"></i>
									</span>
									<span class="<?= $tableComment->getPost_id(); ?>"></span>
						    	</a>
								<?php } ?>
						      	<a class="delete commentButton destroy" title="supprimer" id="destroy<?= $tableComment->getID(); ?>" href="index.php?comaction=delete&amp;id=<?= $tableComment->getID(); ?>&amp;page=moderate"><span id="<?= $tableComment->getID(); ?>"></span></a>
						      </td>
						      <td><?= $tableComment->getDate_comment(); ?></td>
						    </tr>
						   
						<?php } } ?>

						</tbody>

					</table>

				</div>

			</section>	

		</div>

	</div>

	<?php if(isset( $_GET['paginate'])) { ?>

	<span class="pagination-info" id="table<?= $_GET['paginate'] ?>"><?= $_GET['paginate'] ?></span>
	<span class="pagination-name" id="tableRow<?= $_GET['paginate'] ?>">table</span>

	<?php } else { ?>

	<span class="pagination-info">notFull</span>
	<span class="pagination-name">table</span>

	<?php } ?>

	<div class="pagination pagination-bottom" role="navigation" aria-label="pagination">
		<ul class="pagination-list">

			<?php

			for($i = 1 ; $i <= $nbdePages ; $i++){

				if($i == $pageActuelle){ ?>

					<li>
				      <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?= $i ?></a>
				    </li>

				<?php } else { ?>

					    <li>
					    	<a class="pagination-link" aria-label="Goto page 2" href="index.php?comaction=reply&paginate=<?= $i ?>"><?= $i ?></a>
					    </li>
					 
				<?php } 
			} ?>

		</ul>
	</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>
