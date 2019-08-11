
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
    <title><?= $title ?></title>
    <link rel="icon" href="public/img/admin.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css"> 
    <link rel="stylesheet" type="text/css" href="public/css/Front/style.css">  
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>

  <body>

    <!-- modal reader -->

    <div class="container-text-reader">
    
      <div>

        <div class="container-button-reader">
          <div class="container-close">
            <a id="close-reader">
              <i class="far fa-window-close"></i>
            </a>
          </div>
        </div>

        <div class="container-page-reader">

          <?= $variable ?>

        </div>

      </div>

    </div>

    <div class="container-general">

      <!-- modal search -->

      <div class="container-container-search">

        <div class="container-button-search">
          <div class="container-close">
            <a id="search-close">
              <i class="far fa-window-close"></i>
            </a>
          </div>
        </div>

        <div class="container-search"> 
            <input class="input is-rounded input-search" id="search-value" type="email" >
            <a href="#" class="button" id="search-link">
              <i class="fas fa-search"></i>
            </a>
        </div>

      </div>

      <?php if(isset($_SESSION['admin'])) { ?>

      <div class="nav-admin">
        <a href="index.php?postaction=managearticles">
          Accéder à l'admin
        </a>
      </div>

      <?php } ?>

      <header>
        <a href="index.php">
          <div class="image-test">

            <div class="space-between">
              <h3 class="title logo">JEAN FORTEROCHE
              <span class="container-logo">
                <img src="public/img/plume.png" alt="plume"/>
              </span></h3>
            </div>
         
          </div>
        </a>
      </header>

      <div class="hero is-large"><!-- #F0AA39 -->
        <div class="hero-head" style="">

          <div class="buttons" style="display:flex;justify-content: flex-end;margin-bottom:0px;">

             <a id="search-open" class="search-button">
              <i class="fas fa-search" style="color:white;"></i>
            </a>

            <span class="navbar-burger burger" data-target="navbarMenuHeroB" style="margin-left:0px;margin-left:15px;">

              <span></span>
              <span></span>
              <span></span>
            </span>

          </div>
            <div class="container" id="containerNav">
              <div id="navbarMenuHeroB" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="index.php">
                      Accueil
                    </a>
                    <a class="navbar-item" href="index.php?websiteaction=biographie">
                      Biographie
                    </a>
                    <a class="navbar-item" href="index.php?websiteaction=publications">
                      Publications
                    </a>
                    <a class="navbar-item" href="index.php?websiteaction=contact">
                      Contact
                    </a>
                    <?php if(!isset($_SESSION['admin'])) { ?>
                    <a class="navbar-item" href="index.php?adminaction=admin">
                      Connexion
                    </a>
                    <?php } else { ?>
                    <a class="navbar-item" href="index.php?adminaction=logout">
                      Déconnexion
                    </a>
                    <?php } ?>
                    <a class="navbar-item" id="open-search">
                      <i class="fas fa-search"></i>
                    </a>
                    
                    <span class="navbar-item">
                      <a class="button is-info is-inverted" href="https://skergoat.com" target="_blank">
                        <!-- <span class="icon">
                          <i class="fab fa-github"></i>
                        </span> -->
                        <span>Site Web</span>
                      </a>
                    </span>

                </div>    
              </div>
            </div>

        </div>
      </div>

      <div class="div-responsive">
        <ul class="nav-responsive">
          <li>
            <a class="navbar-item" href="index.php">Accueil</a>
          </li>
          <li>
            <a class="navbar-item" href="index.php?websiteaction=biographie">Biographie</a>
          </li>
          <li>
            <a class="navbar-item" href="index.php?websiteaction=publications">Publications</a>
          </li>
          <li>
            <a class="navbar-item" href="index.php?websiteaction=contact">Contact</a>
          </li>
          <?php if(!isset($_SESSION['admin'])) { ?>
          <li>
            <a class="navbar-item" href="index.php?adminaction=admin">Connexion</a>
          </li>
          <?php } else { ?>
          <li>
            <a class="navbar-item" href="index.php?adminaction=logout">Déconnexion</a>
          </li>
          <?php } ?>

          <li>
            <a class="button is-info is-inverted github" href="https://github.com/ApsaraWebDev/projet_4.git">
              <span class="icon">
                <i class="fab fa-github"></i>
              </span>
              <span>GitHub</span>
            </a>
          </li>
        </ul>
      </div> 

      <?= $content ?>
<!--  -->
      <footer class="footer">
        <div class="content has-text-centered">
          <p>
            <strong>© 2019 </strong><a href="index.php">Jean Forteroche</a>
          </p>
        </div>
      </footer>

  </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!--     <script src="public/js/jquery.js"></script>  -->
    <script src="public/js/Admin.js"></script>
    <script src="public/js/Comment.js"></script>
    <script src="public/js/Thema.js"></script>
    <script src="public/js/Blog.js"></script>
    <script src="public/js/Reply.js"></script>
    <script src="public/js/Search.js"></script>
    <script src="public/js/Navbar.js"></script>
    <script src="public/js/reader.js"></script>
    <script src="public/js/sendMail.js"></script>

  </body>
</html>
