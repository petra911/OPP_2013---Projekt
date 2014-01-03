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

            <p>Unesite imena i prezimena autora odvojena sa ';':
                <br/>
                <input type="text" name="autori" />
            </p>
            <p>Unesite naslov:
                <br/>
                <input type="text" name="naslov" />
            </p>
            <p>Unesite sažetak rada:
                <br/>
                <textarea name="sazetak" rows="5" cols="100"></textarea>
            </p>
            <p>Unesite ključne riječi odvojene sa ';':
                <br/>
                <input type="text" name="tag" />
            </p>
            <p>
                Postavite pdf znanstvenog rada:
                <input type="file" name="datoteka" />                
            </p>
            <p>Ako nemate dostupan pdf, upišite link na znanstveni rad:
                <br/>
                <input type="text" name="url" />
            </p>
            <p>Izaberite znanstveni skup:
            <select name="skup">
                <option value=""></option>
                <?php
                if(count($this->skupovi)) {
                    foreach ($this->skupovi as $v) {
                        echo "<option value=\"" . $v->getPrimaryKey() ."\">" . $v->naziv . "</option>";
                    }
                }
                ?>
            </select>
            </p>
            <p>Izaberite časopis:
                <select name="casopis">
                    <option value=""></option>
                <?php
                if(count($this->casopisi)) {
                    foreach ($this->casopisi as $v) {
                        echo "<option value=\"" . $v->getPrimaryKey() ."\">" . $v->naziv . "</option>";
                    }
                }
                ?>
                </select>
            </p>
            <p>Ukoliko rad nije objavljen niti u jednom od gore navedenih časopisa/skupova, upišite osnovne informacije o časopisu/radu:
                <textarea name="tekst" rows="5" cols="100"></textarea>
            </p>
            <p>
                <input type="submit" value="Predloži" />
            </p>
        </form>
        </p>

        <p>
            <a href="<?php echo \route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            ));?>">Vrati se u Portfelj</a>
        </p>

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
