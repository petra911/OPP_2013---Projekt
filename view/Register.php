<?php

namespace view;
use opp\view\AbstractView;
use view\components\RegisterForm;

class Register extends AbstractView {
    
    /**
     *
     * @var string 
     */
    private $errorMessage;
    
    protected function outputHTML() {
?>
	<hr>
    <?php echo new RegisterForm(); ?>
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>
    
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="./assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
    
<?php
    }
    
    /**
     * 
     * @param string $errorMessage
     * @return \templates\Register
     */
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}