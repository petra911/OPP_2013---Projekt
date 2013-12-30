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
            <p>Korisničko ime:
            <input type="text" name="userName" />
            </p>
            <p>Ime:
            <input type="text" name="ime" />
            </p>
            <p>Prezime:
            <input type="text" name="prez" />
            </p>
            <p>Datum rođenja (dd-mm-yyyy):
            <input type="text" name="datum" />
            </p>
            <p>Email:
            <input type="text" name="mail" />
            </p>
            <p>Password:
            <input type="password" name="pass" />
            </p>
            <p>
            <input type="submit" value="Zabilježi me!" />
            </p>
    </form>
<?php
    }
    
}