<?php

namespace view\components;
use opp\view\AbstractView;

class ErrorMessage extends AbstractView {
    /**
     *
     * @var string 
     */
    private $errorMessage;
    
    protected function outputHTML() {
?>
    <div>
        <?php if (null !== $this->errorMessage) {
                echo '<p class="alert alert-error">';
                echo $this->errorMessage;
                echo '</p';
        }
        ?>
    </div>
<?php
    }
    
    /**
     * 
     * @param string $errorMessage
     * @return view\components\ErrorMessage
     */
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}