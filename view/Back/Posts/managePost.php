<?php $title = "Gérer les articles" ?>

<?php $bigTitle = "Gérer les articles" ?>

<?php $tiny = "" ?>

<?php ob_start(); ?>

	<div>

		<div class="container">

			<div class="container-button">
		        <div class="buttons">
		          <a class="button createArticle" href="index.php?postaction=create">
		            <strong>Créer un Article</strong>
		          </a>
		        </div>
		     </div>

			<table class="table is-bordered">
			  <thead>
			    <tr>
			      <th>Title</th>
			      <th>Actions</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach($managePosts as $manage) { ?>
			  	<tr id="tr<?= $manage->getId(); ?>">
			      <th><a href="index.php?postaction=update&id=<?= $manage->getId(); ?>"><?= $manage->getTitle(); ?></a></th>
			      <td>
			      	<div class="container-actions">
				      	<a class="is-small modifier" href="index.php?postaction=update&id=<?= $manage->getId(); ?>">
				            Modifier
				        </a>
				      	<a class="is-small blogJS deleteArticle" id="<?= $manage->getId(); ?>" href="index.php?postaction=destroy&amp;id=<?= $manage->getId(); ?>">
				            Supprimer
				        </a>
			    	</div>
			      </td>
			    </tr>
			    <?php } ?>
			     </tbody>
			</table>

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
							    	<a class="pagination-link" aria-label="Goto page 2" href="index.php?postaction=managearticles&paginate=<?= $i ?>"><?= $i ?></a>
							    </li>
							 
						<?php } 
					} ?>

				</ul>
			</div>

		</div>

	</div>

	

<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>