<?php

namespace view;
use opp\view\AbstractView;

class PrikazPdf extends AbstractView {
    private $html;
    
    /**
     * prikazuje pdf koji je na posluzitelju
     */
    protected function outputHTML() {
        $pov = strpos($this->html, "pdf/");
        $f = substr($this->html, $pov + 4);

        
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename={$f}");
        @readfile($this->html);
        die();
    }
    
    public function setHtml($html) {
        $this->html = $html;
        return $this;
    }

}