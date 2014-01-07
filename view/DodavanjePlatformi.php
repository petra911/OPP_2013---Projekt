<?php

namespace view;
use opp\view\AbstractView;

class DodavanjePlatformi extends AbstractView {
    private $errorMessage;
    
    protected function outputHTML() {
        
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
?>
<form action="<?php    echo  \route\Route::get('d3')->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "dodajPlatformu"
    ));?>" method="POST">
    <p>
        <input type="text" name="xd" />
    </p>
<input type="submit" value="Dodaj" />
</form>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}