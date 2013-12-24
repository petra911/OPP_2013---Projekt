<?php

namespace opp\model;

interface Model extends \Serializable {
    
    public function equals(Model $model);
    
}