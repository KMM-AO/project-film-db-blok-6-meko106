<?php

namespace app\models;

use core\Model;
use PDO;

class Stijl extends Model {

    /** de bijbehorende database-tabel */
    const TABLENAME = 'stijlen';

    public function __construct()
    {
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
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

