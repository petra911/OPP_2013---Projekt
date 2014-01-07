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
                <link href="../assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
                <link href="../assets/css/style.css" rel="stylesheet">
				
				<link href="./assets/css/bootstrap.css" rel="stylesheet">
                <link href="./assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">
                <link href="./assets/css/style.css" rel="stylesheet">
				
				<link href="assets/css/bootstrap.css" rel="stylesheet">
                <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
                <link href="assets/css/style.css" rel="stylesheet">
                <?php if (null !== $this->script) {
                    echo $this->script;
                }
                ?>
            </head>

            <body>
				<div class = "navbar navbar-inverse navbar-static-top">					
					<div class="container">
						<span class="navbar-brand"><?php echo $this->title; ?></span>
					</div>
				</div>
				<div class = "container-narrow">
                    <?php echo $this->body; ?>

				<hr>
				<div class="footer">
					<p>&copy; The7NoobZ</p>
				</div>
                </div>
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