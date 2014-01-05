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
				<label for="korisničkoIme">Korisničko ime</label>
				<input type="text" class="form-control" id="korisničkoIme" placeholder="Upišite korisničko ime" name="userName" />
			</div>
			
			<br>
            
			<div class="form-group">
				<label for="ime1">Ime</label>
				<input type="text" class="form-control" id="ime1" placeholder="Upišite ime" name="ime" />
			</div>
            
            <br>			
			
			<div class="form-group">
				<label for="prezime">Prezime</label>
				<input type="text" class="form-control" id="prezime" placeholder="Upišite prezime" name="prez" />
			</div>
			
            <br>			
			
			<div class="form-group">
				<label for="datumRod">Datum rođenja</label>
				<input type="text" class="form-control" id="datumRod" placeholder="Oblik dd-mm-yyyy" name="datum" />
			</div>
			
            <br>			
			
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="text" class="form-control" id="email" placeholder="Upišite e-mail" name="mail" />
			</div>
			
            <br>			
			
			<div class="form-group">
				<label for="šifra">Šifra</label>
				<input type="password" class="form-control" id="šifra" placeholder="Upišite šifru" name="pass" />
			</div>
            
            <br>			
			
            <input type="submit" class="btn btn-default" value="Zabilježi me!" />

    </form>
<?php
    }
    
}