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
    <?php echo new RegisterForm(); ?>
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>
    <p>
        <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
    </p>
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