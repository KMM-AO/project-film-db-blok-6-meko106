<?php

namespace app\models;

use PDO;

class Product extends Model {
    
    /** relatie-properties */
    private $stijl;     // de 1-op-veel-relatie met stijlen, object van de class Stijl
    private $brouwer;   // de 1-op-veel-relatie met brouwers, object van de class Brouwer
    private $smaken;    // de veel-op-veel-relatie met smaken, array van objecten van de class Smaak
    
    const TABLENAME = 'producten';

    public function __construct()
    {
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct();
    }
    
    /** getters */
    
    public function getId()
    {
        return $this->getDataField('id');
    }
    
    public function getNaam()
    {
        return $this->getDataField('naam');
    }

    public function getBeschrijving()
    {
        return $this->getDataField('beschrijving');
    }
    
    public function getIdStijl()
    {
        return $this->getDataField('id_stijl');
    }
    
    public function getIdBrouwer()
    {
        return $this->getDataField('id_brouwer');
    }

    /** setters */
    
    public function setId($value)
    {
        $this->setDataField('id', $value);
    }
    
    /** 
     * relaties
     * 
     * Relaties zijn in deze code lazy loaded,
     * d.w.z. ze worden pas uit de database opgehaald als ze opgevraagd worden.
     * 
     * Belangrijk is, dat relaties slechts 1x per request uit de database gehaald worden.
     * Dat wordt geregeld door de relatie op te slaan in een property. 
     * Als de property nog niet bestaat, wordt hij gemaakt en uit de database opgehaald.
     *  
    */
    public function getStijl()
    {
        if (!isset($this->stijl))
        {
            $id_stijl = $this->getIdStijl();
        
            $this->stijl = new Stijl();

            $this->stijl->setId($id_stijl);

            $this->stijl->load($success);
            /** 
             * let op: kan zijn dat success false is, 
             * maar onze database-definitie (er is een foreign key constraint) verhindert dat. 
             */
        }
        return $this->stijl;
    }
    
    public function getBrouwer()
    {
        if (!isset($this->brouwer))
        {
            $id_brouwer = $this->getIdBrouwer();
        
            $this->brouwer = new Brouwer();

            $this->brouwer->setId($id_brouwer);

            $this->brouwer->load($success);
            /** 
             * let op: kan zijn dat success false is, 
             * maar onze database-definitie (er is een foreign key constraint) verhindert dat. 
             */
        }
        return $this->brouwer;
    }
    
    public function getSmaken()
    {
        if (!isset($this->smaken))
        {
            $this->smaken = Smaak::indexByProduct($this->getId());
        }
        return $this->smaken;
    }

    /** database-acties */
    
    /** deze method kan in principe ook generiek gemaakt worden (net als Model::delete()) */
    public function load(&$success)
    {
        $query = 
        '
            SELECT *
            FROM producten
            WHERE id = :id
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false);
        if ($success)
        {
            $this->setData($data);
        }
    }
    
    /**
     * verwijderen van veel-op-veel-relatie
     * 
     * Deze method verwijdert ... 
     * - ofwel alle relaties met smaken (indien zonder param aangeroepen)
     * - ofwel een specifieke relatie (indien met param aangeroepen)
     * 
     * Er wordt niet gecontroleerd of het verwijderen succesvol is.
     */
    public function detachSmaak(Smaak $smaak = NULL)
    {
        /** verwijder alle relaties met smaken ... */
        $query = '
            DELETE
            FROM product_smaak
            WHERE id_product = :id_product
        ';
        /** ... of alleen ��n relatie met een bepaalde smaak. */
        if (isset ($smaak))
        {
            $query .= ' AND id_smaak = :id_smaak';
        }
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':id_product', $this->getId(), PDO::PARAM_INT);
        if (isset($smaak))
        {
            $statement->bindValue(':id_smaak', $smaak->getId(), PDO::PARAM_INT);
        }
        
        $statement->execute();
    }
  
    /**
     * specifieke json-requests
     */
    
    /** de utf8-encodering heb ik hier weggehaald, en verplaatst naar de data-setter in Model */
    public function json_show()
    {
        /** haal de productgegevens op */
        $data = $this->getData();

        /** voeg de stijl toe */
        $data['stijl'] = $this->getStijl()->GetData();

        /** voeg de brouwer toe */
        $data['brouwer'] = $this->getBrouwer()->GetData();
        
        /** voeg de smaken toe */
        $data['smaken'] = [];
        
        foreach ($this->getSmaken() as $smaak)
        {
            $data['smaken'][] = $smaak->getData();
        }

        return json_encode($data);
    }
    
}
