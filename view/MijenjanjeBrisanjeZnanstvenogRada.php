<?php

namespace view;
use opp\view\AbstractView;

class MijenjanjeBrisanjeZnanstvenogRada extends AbstractView {
    private $errorMessage;
    private $rad;
    
    
    protected function outputHTML() {
?>
    <p>
        Podaci o radu su navedeni u obrascu. Nakon što unesete željene promjene kliknite na Spremi!
    </p>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ekspertnaOsobaCtl",
                                                                "action" => "updateZnanstveniRad"
                                                            ));?>" method="POST">
		 <p>
        <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ekspertnaOsobaCtl",
                                                                "action" => "dodajJavniRad"
                                                            ));?>" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="ime_prezime"><b>Ime i prezime autora:</b></label> 
                <input type="text" class="form-control" name="autori" placeholder="Upišite ime prezime;" />
        </div>
        <br />
        
        <div class="form-group">
            <label for="naslov"><b>Naslov:</b></label> 
                <input type="text" class="form-control" name="naslov" placeholder="Upišite naslov" value="<?php echo __($this->rad->naslov);?>" />
        </div>
        <br />
        
        <div class="form-group-textarea">
            <label for="sazetak"><b>Sažetak rada:</b></label> 
                <textarea name="sazetak" class="form-control" rows="5" cols="100" placeholder="Upišite sažetak rada"><?php echo __($this->rad->sazetak);?>"</textarea>
       	</div>
        <br />
        
        <div class="form-group">
            <label for="kr"><b>Ključne riječi:</b></label> 
                <input type="text" class="form-control" name="tag" placeholder="Upišite ključne riječi odvojene sa ;" /> 
        </div>
        <br />
        
        <div class="form-group">
            <label for="pdf"><b>Pdf znanstvenog rada:</b></label> 
            <input type="file" class="form-control" name="datoteka" /> 
        </div>
        <br />
        
        <div class="form-group-link">
            <label for="link"><b>Link na znanstveni rad:</b></label>
                <input type="text" class="form-control" name="url"  placeholder="Upišite link na znanstveni rad ako nemate file" />
        </div>
        <br />
        
        <div class="form-group">
            <label for="skup"><b>Izaberite znanstveni skup:</b></label>
            <select name="skup" class="form-control">
                <option value=""></option>
                <?php
                if(count($this->skupovi)) {
                    foreach ($this->skupovi as $v) {
                        echo "<option value=\"" . $v->getPrimaryKey() ."\">" . $v->naziv . "</option>";
                    }
                }
                ?>
            </select>
       </div>
       <br />
       
       <div class="form-group">
            <label for="rad"><b>Izaberite časopis:</b></label>
                <select name="rad" class="form-control">
                    <option value=""></option>
                <?php
                if(count($this->radi)) {
                    foreach ($this->radi as $v) {
                        echo "<option value=\"" . $v->getPrimaryKey() ."\">" . $v->naziv . "</option>";
                    }
                }
                ?>
                </select>
		</div>
        <br />
        
		<input type="submit" class="btn btn-primary" value="Spremi!" />
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

    public function setRad($rad) {
        $this->rad = $rad;
        return $this;
    }

}