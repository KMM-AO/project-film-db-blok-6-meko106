<?php

namespace app\models;

use core\Model;
use PDO;

class Brouwer extends Model {
    
    /** de bijbehorende database-tabel */
    const TABLENAME = 'brouwers';

    public function __construct(){

        parent::__construct();
    }

    /** setter voor de id */
    
    public function setId($value){
        $this->setDataField('id', $value);
    }
    
}

