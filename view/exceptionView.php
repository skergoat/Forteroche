<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <script id="facebook-jssdk" async="" src="//connect.facebook.net/fr_FR/sdk.js"></script>
    <link rel="canonical" href="https:www.skergoat.com/projet_4/index.php">
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="accueil" />
    <meta property="og:description" content="site de Jean forteroche" />
    <meta property="og:url" content="https://www.skergoat.com/projet_4/index.php" />
    <meta property="og:image" content="https://www.skergoat.com/projet_4/public/img/admin.png" />
    <meta property="og:site_name" content="Jean Forteroche" />
    <title>Error</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.skergoat.com/projet_4/public/css/Back/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body class="exception-body">

  	<div class="hero-head hero is-danger">
      <nav class="navbar  nav-admin">
        <div class="container-fluid container-nav-admin">
          <div class="navbar-brand">
            <a class="navbar-item" href="/projet_4/index.php">
              JEAN FORTEROCHE
            </a>  
          </div>
        </div>
      </nav>
    </div>

	<div class="hero is-danger">
		<div class="hero-body">
		    <div class="container">
		      <h1 class="title">
		       	Erreur 
		      </h1>
		    </div>
		</div>
	</div><br/><br/>

	<div class="container-error">
		<div class="container">
			
			<div class="message is-danger">
				<div class="message-body">
			   		<p><?= $errorMessage ?></p><br/>
			  	</div>
			</div>

		</div>
	</div><br/><br/>

  <footer class="footer exception-footer">
    <div class="content has-text-centered">
      <p>
        <strong>© 2019 </strong><a href="index.php">Jean Forteroche</a>
      </p>
    </div>
  </footer>

</body>
</html>