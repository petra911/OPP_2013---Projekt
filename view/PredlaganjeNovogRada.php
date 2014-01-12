<?php

namespace view;
use opp\view\AbstractView;

class PredlaganjeNovogRada extends AbstractView {
    private $errorMessage;
    private $skupovi;
    private $casopisi;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
?>
        <p>
        <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "korisnik",
                                                                "action" => "prijedlogRada"
                                                            ));?>" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="ime_prezime"><b>Ime i prezime autora:</b></label> 
                <input type="text" class="form-control" name="autori" placeholder="Upišite ime prezime;" />
        </div>
        <br />
        
        <div class="form-group">
            <label for="naslov"><b>Naslov:</b></label> 
                <input type="text" class="form-control" name="naslov" placeholder="Upišite naslov" />
        </div>
        <br />
        
        <div class="form-group-textarea">
            <label for="sazetak"><b>Sažetak rada:</b></label> 
                <textarea name="sazetak" class="form-control" rows="5" cols="100" placeholder="Upišite sažetak rada"></textarea>
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
            <label for="casopis"><b>Izaberite časopis:</b></label>
                <select name="casopis" class="form-control">
                    <option value=""></option>
                <?php
                if(count($this->casopisi)) {
                    foreach ($this->casopisi as $v) {
                        echo "<option value=\"" . $v->getPrimaryKey() ."\">" . $v->naziv . "</option>";
                    }
                }
                ?>
                </select>
		</div>
        <br />
        
        <div class="form-group-textarea">
            <label for="info"><b>Osnovne informacije o radu:</b></label>
                <textarea name="tekst" class="form-control" rows="5" cols="100" placeholder="Ukoliko rad nije objavljen niti u jednom od gore navedenih časopisa/skupova, upišite osnovne informacije o radu"></textarea>
        </div>
        <br />
        
        <input type="submit" class="btn btn-primary" value="Predloži" />
            
        </form>
        
      	<br />
   		<br />
   		<br />

        <a href="<?php echo \route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            ));?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se u portfelj" height="50" />
		</a>
		
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function setSkupovi($skupovi) {
        $this->skupovi = $skupovi;
        return $this;
    }

    public function setCasopisi($casopisi) {
        $this->casopisi = $casopisi;
        return $this;
    }

}
