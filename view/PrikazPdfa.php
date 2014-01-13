<?php

namespace view;
use opp\view\AbstractView;

class PrikazPdfa extends AbstractView {
    
    private $pdf;
    
    protected function outputHTML() {
        $this->pdf->Output();
        die();
    }
    
    public function setPdf($pdf) {
        $this->pdf = $pdf;
        return $this;
    }

}
