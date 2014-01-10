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
											
        <div class="form-group">
            <label for="prezime"><b>Prezime autora</b></label>
            <input type="text" class="form-control"prezime" name="autor" placeholder="Upišite prezime autora" />
		</div>
		<br>
  
		<div class="form-group">
            <label for="naslov"><b>Naziv eksperimenta</b></label>
            <input type="text" class="form-control" id="naslov" name="naziv" placeholder="Upišite naziv" />
		</div>
		<br>

		<div class="form-group">
            <label for="vrijemep"><b>Vrijeme početka</b></label>
            <input type="datetime-local" class="form-control" id="vrijemep" name="vrijemepocetka" placeholder="Odaberite početak eksperimenta" />
		</div>
		<br>
                
                <div class="form-group">
            <label for="vrijemez"><b>Vrijeme završetka</b></label>
            <input type="datetime-local" class="form-control" id="vrijemez" name="vrijemezavrsetka" placeholder="Odaberite završetak eksperimenta" />
		</div>
		<br>
                
                <div class="form-group">
            <label for="ide"><b>Skraćeni naziv razvojne okoline</b></label>
            <input type="text" class="form-control" id="ide" name="nazivide" placeholder="Upišite skraćeni naziv IDE" />
		</div>
		<br>
                
                <div class="form-group">
            <label for="alat"><b>Skraćeni naziv alata</b></label>
            <input type="text" class="form-control" id="alat" name="nazivalat" placeholder="Upišite skraćeni naziv alata" />
		</div>
		<br>
                
                <div class="form-group">
            <label for="platforma"><b>Skraćeni naziv platforme</b></label>
            <input type="text" class="form-control" id="platforma" name="nazivplatforma" placeholder="Upišite skraćeni naziv platfrome" />
		</div>
		<br>
                
                <div class="form-group">
            <label for="iznosr"><b>Iznos rezultata eksperimenta</b></label>
            <input type="number" step = "any" class="form-control" id="iznosr" name="iznosrezultata" placeholder="Upišite skraćeni naziv platfrome" />
		</div>
		<br>
                
                <div class="form-group">
            <label for="mjernar"><b>Mjerna jedinica rezultata</b></label>
            <input type="text" class="form-control" id="mjernaj" name="mjjedinicarezultata" placeholder="Upišite mjernu jedinicu rezultata" />
		</div>
		<br>
                
                 <div class="form-group">
            <label for="mjernar"><b>Mjerna jedinica rezultata</b></label>
            <input type="text" class="form-control" id="mjernaj" name="ispitniprimjer" placeholder="Upišite ispitni primjer rezultata" />
		</div>
		<br>
                


        <p>
            <b>Napomena:</b> Ukoliko zelite pretragu vršiti po više parametara, odvojite ih sa znakom zarez (,)!
        </p>
        <input type="submit" class="btn btn-default" name="submit" value="Traži" />
		<br><br><br>
    </form>

    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>
	
    
	<a href="<?php echo \route\Route::get('d2')->generate(array(
																"controller" => "korisnik"
																));?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
<?php
    }
	
	public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}