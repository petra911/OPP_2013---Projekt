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
                
		echo '<table class="table">';
		for ($i = 0; $i < count($this->var['id']); $i++)
		{
			echo '<tr>';
			echo "<td>{$this->var['imeautor'][$i]}</td>";
			echo "<td>{$this->var['prezimeautor'][$i]}</td>";
			echo "<td>{$this->var['naslov'][$i]}</td>";
			echo "<td>{$this->var['sazetak'][$i]}</td>";
			echo "<td>{$this->var['kljucnerijeci'][$i]}</td>";
			echo "<td>{$this->var['casopis'][$i]}</td>"; /* podaci o skupu ili časopisu */
                        echo "<td>{$this->var['skup'][$i]}</td>";
			/* linkovi za dodavanje u portfelj*/
			
                        echo "<td><a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "dodajEksperimentUPortfelj"
                            )) . "?id=" . $this->var['id'][$i] . "\"> Dodaj u portfelj </a></td>";
                       
                        echo '</tr>';
		}
		echo '</table>';  
        
                
                
                
    }
}
