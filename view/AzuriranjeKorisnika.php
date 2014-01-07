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
			<label for="ime"><b>Ime</b></label>
			<input type="text" class="form-control" id="ime" name="ime" value="<?php echo __($this->korisnik->ime);?>" />
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Prezime</b></label>
			<input type="text" class="form-control" id="prez" name="prez" value="<?php echo __($this->korisnik->prezime);?>" />
		</div>
        <br>
		
		<div class="form-group">
			<label for="mail"><b>Email</b></label>
			<input type="text" class="form-control" id="mail" name="mail" value="<?php echo __($this->korisnik->mail);?>" />
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Datum rođenja</b></label>
			<input type="text" class="form-control" id="datum" name="datum" value="<?php echo __($this->korisnik->datumRod);?>" />&nbsp;Format: YYYY-MM-DD
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Korisničko ime</b></label>
			<input type="text" class="form-control" id="username" name="username" value="<?php echo __($this->korisnik->username);?>" />
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Password</b></label>
			<input type="password" class="form-control" id="pass" name="pass" />
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Validnost</b></label>
			<input type="text" class="form-control" id="validnost" name="validnost" value="<?php echo __($this->korisnik->validnost);?>" />&nbsp;Vrijednosti: 0 ili 1
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Rok uplate</b></label>
			<input type="text" class="form-control" id="rok" name="rok" value="<?php echo __($this->korisnik->rokUplate);?>"/>&nbsp;Format: datum&lt;broj&gt; ili dan&lt;broj&gt;
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Iznos uplate</b></label>
			<input type="text" class="form-control" id="iznos" name="iznos" value="<?php echo __($this->korisnik->uplata);?>" />
		</div>
        <br>
		
		<div class="form-group">
			<label for="prez"><b>Vrsta korisnika</b></label>
			<input type="text" class="form-control" id="vrsta" name="vrsta" value="<?php echo __($this->korisnik->vrsta);?>"/>&nbsp;Moguće vrijednosti: K, E ili O
		</div>
        <br>
		
        <p>
            Želim izbrisati ovog korisnika: &nbsp;
            <input type="checkbox" name="checked" value="true" />
			<br>
			<input type ="hidden" class="form-control" name ="id" value="<?php echo __($this->korisnik->idKorisnika);?>" />
			<br>
            <input type="submit" class="btn btn-default" value="Spremi!" />
		</p>
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
