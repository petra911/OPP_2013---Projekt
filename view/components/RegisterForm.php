<?php

namespace view\components;
use opp\view\AbstractView;

class RegisterForm extends AbstractView {
    
    protected function outputHTML() {
?>
<form action="<?php echo \route\Route::get('d3')->generate(array(
    "controller" => "register",
    "action" => "register"
));?>" method="POST">
			<div class="form-group">
				<label for="korisničkoIme"><b>Korisničko ime</b></label>
				<input type="text" class="form-control" id="korisničkoIme" placeholder="Upišite korisničko ime" name="userName" />
			</div>
			
			<br>
            
			<div class="form-group">
				<label for="ime1"><b>Ime</label>
				<input type="text" class="form-control" id="ime1" placeholder="Upišite ime" name="ime" />
			</div>
            
            <br>			
			
			<div class="form-group">
				<label for="prezime"><b>Prezime</b></label>
				<input type="text" class="form-control" id="prezime" placeholder="Upišite prezime" name="prez" />
			</div>
			
            <br>			
			
			<div class="form-group">
				<label for="datumRod"><b>Datum rođenja</b></label>
				<input type="text" class="form-control" id="datumRod" placeholder="Oblik dd-mm-yyyy" name="datum" />
			</div>
			
            <br>			
			
			<div class="form-group">
				<label for="email"><b>E-mail</b></label>
				<input type="text" class="form-control" id="email" placeholder="Upišite e-mail" name="mail" />
			</div>
			
            <br>			
			
			<div class="form-group">
				<label for="šifra"><b>Šifra</b></label>
				<input type="password" class="form-control" id="šifra" placeholder="Upišite šifru minimalne dužine 6 znakova" name="pass" />
			</div>
            
            <br>			
			
            <input type="submit" class="btn btn-primary" value="Registriraj me!" />
			<br><br><br>
    </form>
<?php
    }
    
}