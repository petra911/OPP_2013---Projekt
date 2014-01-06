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
		echo '<table class = "table">';
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
                        
			echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "dodajEksperimentUPortfelj"
                            )) . "?id=" . $this->var['id'] . "\"> Dodaj u portfelj </a></td>";
                    
              
                       echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "ocijeni"
                            )) . "?id=" . $this->var['id'] . "\"> Ocijeni </a></td>";
			
                        echo '</tr>';
		}
		echo '</table>';
                
                ?> <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a> <?php
                
                
    }    
    
}