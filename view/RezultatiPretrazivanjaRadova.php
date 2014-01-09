<?php

namespace view;
use opp\view\AbstractView;

class RezultatiPretrazivanjaRadova extends AbstractView {
    
    private $var;
    
    public function getVar() {
        return $this->var;
    }

    public function setVar($var) {
        $this->var = $var;
    }
        
    protected function outputHTML() {
        /**
         * implementiraj
         */
		//echo "gejjj <br>"; print_r($this->var);
		echo '<table class="table table-bordered table-hover">
			<tr>
				<td><b>Ime i prezime autora</b></td>				
				<td><b>Naslov</b></td>
				<td><b>Sažetak</b></td>
				<td><b>Ključne riječi</b></td>
				<td><b>Časopis</b></td>
				<td><b>Skup</b></td>
                                <td><b>Link</b></td>
                                <td><b>Link</b></td>
                                
				
			</tr>';
		for ($i = 0; $i < count($this->var['id']); $i++)
		{
			echo '<tr>';
			echo "<td>{$this->var['imeautor'][$i]}</td>";			
			echo "<td>{$this->var['naslov'][$i]}</td>";
			echo "<td>{$this->var['sazetak'][$i]}</td>";
			echo "<td>{$this->var['kljucnerijeci'][$i]}</td>";
			echo "<td>{$this->var['casopis'][$i]}</td>"; /* podaci o skupu ili časopisu */
                        echo "<td>{$this->var['skup'][$i]}</td>";
			/* linkovi za dodavanje u portfelj*/
			
                        
                        if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K' )) {
                        
                            $portfelj = new \model\DBPortfelj();
                            if (!$portfelj->postojiZapis($_SESSION['auth'], null, $this->var['id'][$i])) {
                            echo "<td><a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "dodajRadUPortfelj"
                            )) . "?id=" . $this->var['id'][$i] . "\"> Dodaj u portfelj </a></td>";
                            }
                        
                        echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "predloziKorekciju"
                            )) . "?id=" . $this->var['id'][$i] . "&var=R". "\"> Predloži korekciju </a></td>";
                        }
                       
                        echo '</tr>';
		}
		echo '</table>';                 
                
                ?> <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a> <?php
                
                
    }
}

                


