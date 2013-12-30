<?php

namespace view\components;
use opp\view\AbstractView;

class LoginForm extends AbstractView {

    protected function outputHTML() {
?>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                            "controller" => "login",
                                                            "action" => "login"
                                                        ));?>" method="POST">
        <p>
            Korisničko ime:
            <input type="text" name="userName" />
        </p>
        <p>
            Password:
            <input type="password" name="pass" />
        </p>
        <p>
            <input type="submit" value="Prijavi me!" />
        </p>
    </form>
<?php
    }
    
}