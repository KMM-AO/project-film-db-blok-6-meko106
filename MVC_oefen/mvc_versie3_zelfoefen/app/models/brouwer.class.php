<?php

namespace app\models;

use core\Model;
use PDO;

class Brouwer extends Model {
    
    /** de bijbehorende database-tabel */
    const TABLENAME = 'brouwers';

    public function __construct()
    {
        /**
         * Roep de parent-constructor aan met één optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct();
    }

    /** setter voor de id */
    
    public function setId($value)
    {
        $this->setDataField('id', $value);
    }

}

