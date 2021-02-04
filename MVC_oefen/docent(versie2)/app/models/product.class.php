<?php

namespace app\models;

use core\Model;
use PDO;

class Product extends Model {
    
    /** de bijbehorende database-tabel */
    const TABLENAME = 'producten';

    /** relatie-properties */
    private $stijl;     // de 1-op-veel-relatie met stijlen, object van de class Stijl
    private $brouwer;   // de 1-op-veel-relatie met brouwers, object van de class Brouwer
    private $smaken;    // de veel-op-veel-relatie met smaken, array van objecten van de class Smaak
    
    public function __construct(){
        parent::__construct();
    }
    
    /** setter voor de id */
    
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
            $this->stijl = new Stijl();

            $this->stijl->setId($this->id_stijl);

            $this->stijl->load($success);
        }
        return $this->stijl;
    }
    
    public function getBrouwer()
    {
        if (!isset($this->brouwer))
        {
            $this->brouwer = new Brouwer();

            $this->brouwer->setId($this->id_brouwer);

            $this->brouwer->load($success);
        }
        return $this->brouwer;
    }
    
    public function getSmaken()
    {
        if (!isset($this->smaken))
        {
            $this->smaken = Smaak::indexByProduct($this->id);
        }
        return $this->smaken;
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
        
        $statement->bindValue(':id_product', $this->id, PDO::PARAM_INT);
        if (isset($smaak))
        {
            $statement->bindValue(':id_smaak', $smaak->id, PDO::PARAM_INT);
        }
        
        $statement->execute();
    }

}
