<?php

namespace view;
use opp\view\AbstractView;

class Main extends AbstractView {
    
    /**
     *
     * @var string
     */
    private $title;
    
    /**
     *
     * @var string
     */
    private $body;
    
    /**
     *
     * @var string 
     */
    private $script;
	 
	 /**
     *
     * @var array 
     */
    private $polje;
	
	 /**
     * @return string html sadrzaj
     */
    protected function outputHTML() {
        ?>
        <!DOCTYPE html>
        <html>

            <head>
                <title><?php echo $this->title; ?></title>
                <meta charset="utf-8">
                <link href="../assets/css/bootstrap.css" rel="stylesheet">
                <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
                <link href="../assets/css/style.css" rel="stylesheet">
                <link href="../assets/css/menu.css" rel="stylesheet">
				
				<link href="./assets/css/bootstrap.css" rel="stylesheet">
                <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">
                <link href="./assets/css/style.css" rel="stylesheet">
                <link href="./assets/css/menu.css" rel="stylesheet">
				
				<link href="assets/css/bootstrap.css" rel="stylesheet">
                <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
                <link href="assets/css/style.css" rel="stylesheet">
                <link href="assets/css/menu.css" rel="stylesheet">
                <?php if (null !== $this->script) {
                    echo $this->script;
                }
                ?>
            </head>

            <body>
			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			  <div class="container">
			    <div class="navbar-header">
				  <span class="navbar-brand"><?php echo $this->title; ?></span>
				</div>
				<div class="navbar-collapse collapse">
				  <div class="navbar-right form-inline" role="form">
					<div class="form-group"> 
					  <?php if(\model\DBKorisnik::isLoggedIn()) 
						; else echo
						"<a href=\"" . \route\Route::get('d2')->generate(array(
																					"controller" => "login",
																					"action" => "display"
																					)) . "\">Sign In</a>"
					  ;?>
					</div>
					<div class="form-group"> 
					  <?php if(\model\DBKorisnik::isLoggedIn()) echo
						"<a href=\"" . \route\Route::get('d3')->generate(array(
																					"controller" => "korisnik",
																					"action" => "logout"
																					)) . "\">Odjavi se</a>"
						; else echo
						"<a href=\"" . \route\Route::get('d2')->generate(array(
																					"controller" => "register",
																					"action" => "display"
																					)) . "\">Sign Up</a>"
					  ;?>
					</div>
				  </div><!--/.navbar-collapse -->
			    </div>
			  </div>
			</div>	
			
			</br>
			</br>
			</br>
			</br>
			</br>
			
			<div class = "container-narrow">
              <?php echo $this->body; ?>
            </div>
                
            <hr>
                
			<footer class="footer">
			  <p>&copy; The7Noobz</p>
      		</footer>
			</body>
		</html>
<?php
    }

    /**
     * 
     * @param string $title
     * 
     * @return Main
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * 
     * @param string $body
     * 
     * @return Main
     */
    public function setBody($body) {
        $this->body = $body;
        return $this;
    }
    
    /**
     * 
     * @param string $script
     * @return \templates\Main
     */
    public function setScript($script) {
        $this->script = $script;
        return $this;
    }


}