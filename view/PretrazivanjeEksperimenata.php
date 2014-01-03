<?php

namespace view;
use opp\view\AbstractView;

class PretrazivanjeEksperimenata extends AbstractView {
    private $errorMessage;
    /**
     * Napravite analogno pretrazivanju radova (izaberite obrazac po vasem izboru) -> za privatne varijable napravite SEtter (OBAVEZNO)
     */
	 
    protected function outputHTML() {	
?>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                    "controller" => "pretrazivanje",
                                                    "action" => "pretraziEksperimente"
                                                ));?>" method="POST" >												
											
        <p>
            Unesite prezime autora:
            <input type="text" name="autor" />
        </p>
        <p>
            Unesite naziv eksperimenta:
            <input type="text" name="naziv" />
        </p>
        <p>
            Unesite naziv parametra:
            <input type="text" name="parametar" />
        </p>
		<p>
            Unesite iznos rezultata:
            <input type="text" name="iznosrez" />
        </p>
		<p>
            Unesite naziv mjerne jedinice rezultata:
            <input type="text" name="jedinicarez" />
        </p>		
		<p>
            Unesite vrijeme početka:
            <input type="date" name="vrijeme_pocetka" />
        </p>
		<p>
            Unesite vrijeme završetka:
            <input type="date" name="vrijeme_zavrsetka" />
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