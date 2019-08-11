<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurer votre mot de passe</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">   
    <link rel="stylesheet" type="text/css" href="public/css/Back/style.css">
    
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

  </head>
  <body>

    <div class="hero-head">
      <nav class="navbar  nav-admin">
        <div class="container-fluid container-nav-admin">
          <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
              JEAN FORTEROCHE
            </a>  
          </div>
        </div>
      </nav>
    </div>

    <section class="hero is-link">
      <div class="hero-body">
          <div class="container">
            <h1 class="title">
              Reinitialiser Mot de Passe
            </h1>
          </div>
      </div>
    </section><br/><br/>

	<div class="container-recover">
	
		<h3 class="title is-4">Restaurer votre mot de passe</h3>

		<div class="notification is-success notification-success"></div>
		<div class="notification is-danger notification-failed"></div>

		<form action="index.php?adminaction=recoverandchangepass&id=<?= $passRecovered->getID() ?>" method="post" class="formulaire" id="recoverPassword">

			<div class="field">
			  <label class="label">Nouveau mot de passe</label>
			  <div class="control">
			    <input class="input second" type="password" name="recoveredPass" id="recoveredPass" required>
			  </div>
			  <p class="help password is-danger"></p>
			</div>

			<div class="field">
			  <label class="label">Confirmer mot de passe</label>
			  <div class="control">
			    <input class="input first" type="password" name="confirmRecoveredPass" id="confirmRecoveredPass" required>
			  </div>
			</div>

			<div class="field is-grouped">
			  <div class="control">
			    <button class="button is-primary">Submit</button>
			  </div>
			</div>

		</form>

	</div>

    <footer class="footer">
      <div class="content has-text-centered">
        <p>
          <strong>Design</strong> by <a href="https://www.skergoat.com" target="_blank">Stéphane Kergoat</a> 
        </p>
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!--     <script src="public/js/jquery.js"></script>  -->
    <script src="public/js/Admin.js"></script>
    <script src="public/js/Comment.js"></script>
    <script src="public/js/Thema.js"></script>
    <script src="public/js/Blog.js"></script>
    <script src="public/js/Reply.js"></script>
    <script src="public/js/Navbar.js"></script>

  </body>
</html>