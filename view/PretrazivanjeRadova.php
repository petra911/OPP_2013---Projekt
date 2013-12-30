<?php

namespace view;
use opp\view\AbstractView;

class PretrazivanjeRadova extends AbstractView {
    private $errorMessage;
    
    protected function outputHTML() {
?>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                    "controller" => "pretrazivanje",
                                                    "action" => "pretraziRadove"
                                                ));?>" method="POST" >
        <p>
            Unesite prezime autora:
            <input type="text" name="autor" />
        </p>
        <p>
            Unesite riječi iz naslova:
            <input type="text" name="naslov" />
        </p>
        <p>
            Unesite ključne riječi:
            <input type="text" name="keyword" />
        </p>
        <p>
            <b>Napomena:</b> Ukoliko zelite pretragu vršiti po više parametara, odvojite ih sa znakom točka-zarez (;)!
        </p>
         
        <p>            
            <input type="submit" name="submit" value="Traži" />
        </p>
    </form>

    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>

    <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu!</a>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}
