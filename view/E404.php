<?php

namespace view;

use opp\view\AbstractView;

class E404 extends AbstractView {

    public function outputHTML() {
?>
    <p style="color:red;font-size: 300%;"><b>Greška 404</b></p>
<?php
    }


}