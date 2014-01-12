<?php

namespace view;
use opp\view\AbstractView;

class PromjenaModela extends AbstractView {
    protected function outputHTML() {
?>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
																	"controller" => "korisnik",
																	"action" => "promijeniModel"
																	));?>" method="POST">
        
        <div class="form-group-textarea">
            <label for="mobla"><b>Vaša molba</b></label>
            <textarea rows="5" class="form-control" cols ="100" name="tekst" placeholder="Upišite Vašu molbu"></textarea>
        </div>
        <br>
        
        <p>
            <input type="hidden" name="id" value="<?php echo $_SESSION['auth'];?>" />
        </p>
        
        <input type="submit" class="btn btn-default" value="Prijavi me" />      
    </form>

    <br><br>

    <a href="<?php echo \route\Route::get('d2')->generate(array(
																"controller" => "korisnik"
																));?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se u portfelj" height="50" />
    </a>
    
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<?php
    }
}
