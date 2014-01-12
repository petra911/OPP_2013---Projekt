<?php

namespace view;
use opp\view\AbstractView;

class AzuriranjeKorisnika extends AbstractView {
    private $errorMessage;
    private $korisnik;
    
    
    protected function outputHTML() {
?>
    <p>
        Korisnički podaci su navedeni u obrascu. Nakon što unesete željene promjene kliknite na Spremi!
    </p>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ovlastenaOsobaCtl",
                                                                "action" => "updateUser"
                                                            ));?>" method="POST">
		<div class="form-group">
			<label for="imee"><b>Ime</b></label>
			<input type="text" class="form-control" id="imee" placeholder="Upišite ime" name="ime" value="<?php echo __($this->korisnik->ime);?>"/>
		</div>
		<br>
		
        <div class="form-group">
			<label for="prezz"><b>Prezime</b></label>
			<input type="text" class="form-control" id="prezz" placeholder="Upišite prezime" name="prez" value="<?php echo __($this->korisnik->prezime);?>"/>
		</div>
		<br>
		
        <div class="form-group">
			<label for="email"><b>Email</b></label>
			<input type="text" class="form-control" id="email" placeholder="Upišite e-mail" name="mail" value="<?php echo __($this->korisnik->mail);?>"/>
		</div>
		<br>
		
		<div class="form-group">
			<label for="datumRod"><b>Datum rođenja</b></label>
			<input type="text" class="form-control" id="datumRod" placeholder="Format: YYYY-MM-DD" name="datum" value="<?php echo __($this->korisnik->datumRod);?>"/>
		</div>
		<br>
		
		<div class="form-group">
			<label for="korIme"><b>Korisničko ime</b></label>
			<input type="text" class="form-control" id="korIme" placeholder="Upišite korisničko ime" name="username" value="<?php echo __($this->korisnik->username);?>"/>
		</div>
		<br>
		
		<div class="form-group">
			<label for="passs"><b>Šifra</b></label>
			<input type="password" class="form-control" id="passs" placeholder="Upišite šifru" name="pass" />
		</div>
		<br>

		<div class="form-group">
			<label for="validnostt"><b>Validnost</b></label>
			<input type="text" class="form-control" id="validnostt" placeholder="Upišite validnost: 0 ili 1" name="validnost" value="<?php echo __($this->korisnik->validnost);?>"/>
		</div>
		<br>
		
		<div class="form-group">
			<label for="rokk"><b>Rok uplate</b></label>
			<input type="text" class="form-control" id="rokk" placeholder="Format: datum<broj> ili dan<broj>" name="rok" value="<?php echo __($this->korisnik->rokUplate);?>"/>
		</div>		
		<br>

		<div class="form-group">
			<label for="iznoss"><b>Iznos uplate</b></label>
			<input type="text" class="form-control" id="iznoss" placeholder="Upišite iznos uplate" name="iznos" value="<?php echo __($this->korisnik->uplata);?>"/>
		</div>		
		<br>

		<div class="form-group">
			<label for="vrstaa"><b>Vrsta korisnika</b></label>
			<input type="text" class="form-control" id="vrstaa" placeholder="Moguće vrijednosti: K, E ili O" name="vrsta" value="<?php echo __($this->korisnik->vrsta);?>"/>
		</div>		
		<br>
		
        <p>
			<b>Želim izbrisati ovog korisnika &nbsp;</b>
			<input type="checkbox" name="checked" value="true" />
        </p>

		
		
			<input type ="hidden" name ="id" value="<?php echo __($this->korisnik->idKorisnika);?>" />

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

    public function setKorisnik($korisnik) {
        $this->korisnik = $korisnik;
        return $this;
    }

}