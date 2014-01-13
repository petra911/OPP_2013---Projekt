<?php

namespace view;
use opp\view\AbstractView;

class MijenjanjeBrisanjeZnanstvenogEksperimenta extends AbstractView {
    private $errorMessage;
    private $eksperiment;
    
    
    protected function outputHTML() {
?>
    <p>
        Podaci o javnom eksperimentu su navedeni u obrascu. Nakon što unesete željene promjene kliknite na Spremi!
    </p>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ekspertnaOsobaCtl",
                                                                "action" => "updateEksperiment"
                                                            ));?>" method="POST">
		
       <div class="form-group">
				<label for="eksp"><b>Naziv eksperimenta:</b></label>
				<input type="text" class="form-control" id="eksp" placeholder="Upišite naziv eksperimenta" name="naziv" value=" <?php echo __($this->eksperiment->naziv);?>"/>
			</div>
			<br />
			
			<div class="form-group">
				<label for="poč"><b>Vrijeme početka:</b></label>
				<input type="text" class="form-control" id="poč" placeholder="Format dd.mm.yyyy. hh:mm" name="vrijemePocetka" value=" <?php echo __($this->eksperiment->naziv);?>"/>
			</div>
			<br />
			
			<div class="form-group">
				<label for="end"><b>Vrijeme završetka:</b></label>
				<input type="text" class="form-control" id="end" placeholder="Format dd.mm.yyyy. hh:mm" name="vrijemeZavrsetka" value=" <?php echo __($this->eksperiment->naziv);?>"/>
			</div>
			<br />
            <div class="form-group">
			<label for="izbor"><b>Izaberite platformu:</b></label>
            <select name="platforma" class="form-control" id="izbor">
                <option value=""></option>
                <?php if(count($this->platforme)) {
                  foreach($this->platforme as $v) {
                     echo "<option value=\"" . $v->idPlatforme . "\">" . $v->skraceniNaziv . "</option>";
                }
                }?>
            </select>
            </div>
			<br />
			
			<div class="form-group">
				<label for="par"><b>Parametri:</b></label>
				<input type="text" class="form-control" id="author" placeholder="Format naziv-ispitniSlucaj;naziv-ispitniSlucaj..." name="parametri" />
			</div>
			<br />
			
			<div class="form-group">
				<label for="rez"><b>Rezultat:</b></label>
				<input type="text" class="form-control" id="author" placeholder="Format: naziv-iznos-mjernaJedinica;naziv-iznos-mjernaJedinica..." name="rezultati" />
			</div>
			<br />
            
			<div class="form-group">
				<label for="dodaj"><b>Dodati eksperiment pomoću tekstualne datoteke:</b></label>
				<input type="file" class="form-control" id="author" placeholder="Upišite naziv mjerne jedinice rezultata" name="datoteka" />
			</div>
			<br />
		
		
		
        <p>
			<b>Želim izbrisati ovaj eksperiment &nbsp;</b>
			<input type="checkbox" name="checked" value="true" />
        </p>

		
		
			<input type ="hidden" name ="id" value="<?php echo __($this->eksperiment->idEksperimenta);?>" />

		<br>
        
		<input type="submit" class="btn btn-primary" value="Spremi!" />
    </form>
    
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>
	
	<br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function setEksperiment($eksperiment) {
        $this->eksperiment = $eksperiment;
        return $this;
    }

}