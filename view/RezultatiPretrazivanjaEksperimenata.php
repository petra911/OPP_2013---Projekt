<?php

namespace view;
use opp\view\AbstractView;

class RezultatiPretrazivanjaEksperimenata extends AbstractView {
    
    private $var;
    
    public function setVar($var)
    {
        $this->var = $var;
        return $this;
    }    
        
    protected function outputHTML() {
        /**
         * implementiraj;
         */		 
		echo '<table border = "1" width = 100%>';
		for ($i = 0; $i < count($this->var); $i++)
		{
			echo '<tr>';
			echo "<td>{$this->var['imeautor'][$i]}</td>";
			echo "<td>{$this->var['prezimeautor'][$i]}</td>";
			echo "<td>{$this->var['naziv'][$i]}</td>";
			echo "<td>{$this->var['pocetak'][$i]}</td>";
			echo "<td>{$this->var['zavrsetak'][$i]}</td>";
			echo "<td>{$this->var['nazivparam'][$i]}</td>";
			echo "<td>{$this->var['iznosrezultata'][$i]}</td>";
			echo "<td>{$this->var['jedinicarezultata'][$i]}</td>";			
					
			/* linkovi za dodavanje u portfelj i ocjenjivanje*/                 
                        
			echo "<a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "dodajEksperimentUPortfelj"
                            )) . "?id=" . $this->var['id'] . "\"> Dodaj u portfelj </a>";
                    
              
                       echo "<a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "ocijeni"
                            )) . "?id=" . $this->var['id'] . "\"> Ocijeni </a>";
			
                        echo '</tr>';
		}
		echo '</table>';		 
    }    
    
}