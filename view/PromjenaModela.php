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
        
        
        <p>
            <textarea rows="5" cols ="100" name="tekst" >Unesite Vašu zamolbu...</textarea>
        </p>
        <p>
            <input type="hidden" name="id" value="<?php echo $_SESSION['auth'];?>" />
        </p>
        <p>
            <input type="submit" value="Prijavi me!" />
        </p>
               
    <p>
        <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
    </p>
    </form>
<?php
    }
}
