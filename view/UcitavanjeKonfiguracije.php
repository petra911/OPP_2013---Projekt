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
		<br>
		<input type="file" class="btn btn-default" name="datoteka" />
		<br>
		<input type="submit" class="btn btn-primary" value="Šalji" />
		
		<br>
    </form>

    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>

    <p>
        <a href="<?php echo \route\Route::get('d3')->generate(array(
            "controller" => "ovlastenaOsobaCtl",
            "action" => "ponistiNeplatise"
        ));?>"><br><br><br><button type="button" class="btn btn-primary">Poništavanje neplatiša!</button></a>
    </p>
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
}