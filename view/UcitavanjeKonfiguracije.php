<?php

namespace view;
use opp\view\AbstractView;

class UcitavanjeKonfiguracije extends AbstractView {
    private $errorMessage;
    
    protected function outputHTML() {
?>
    <form method="post" action="<?php echo \route\Route::get('d3')->generate(array(
                                                        "controller" => "ovlastenaOsobaCtl",
                                                        "action" => "loadConfiguration"
                                                    ));?>" enctype="multipart/form-data">
        <p><input type="file" name="datoteka" /></p>
        <p><input type="submit" value="Šalji" /></p>
    </form>

    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>

    <p>
        <a href="<?php echo \route\Route::get('d3')->generate(array(
            "controller" => "ovlastenaOsobaCtl",
            "action" => "ponistiNeplatise"
        ));?>">Poništavanje Neplatiša!</a>
    </p>

    <p>
        <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
    </p>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}