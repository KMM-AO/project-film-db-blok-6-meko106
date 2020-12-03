<?php

namespace app\models;

use \core\Database;
use PDO;

abstract class Model {
    
    /** door alle child classes gedeelde properties */ 
    
    protected $pdo;         /** de databaseconnectie */

    private $data;          /** de associatieve array met record-gegevens van het object */
    
    private $primary_name;  /** de naam van het primary-key-veld */
    
    private $primary_type;  /** het pdo-param-type van het primary-key-veld */
    
    
    /** constructor */
    public function __construct($primary_def = ['id', PDO::PARAM_INT])
    {
        $this->pdo = Database::getInstance()->getPdo();
        $this->setPrimaryName($primary_def[0]);
        $this->setPrimaryType($primary_def[1]);
    }
    
    /** getters */
   
    protected function getPrimaryName ()
    {
        return $this->primary_name;
    }
    
    protected function getPrimaryType ()
    {
        return $this->primary_type;
    }
    
    protected function getPrimaryValue()
    {
        return $this->getDataField($this->getPrimaryName());
    }
    
    public function getData()
    {
        return $this->data;    
    }

    protected function getDataField($name)
    {
        return $this->data[$name] ?? NULL;
    }
    
    /** 
     * magic getter voor demonstratie-doeleinden (gebruikt in product/show.php)
     * 
     * De magic getter (en setter) komt in actie wanneer je een property probeert te benaderen
     * die niet bestaat, of die niet beschikbaar is (bijv. omdat hij private is).
     * 
     * Je mag het gebruiken; het scheelt een hoop getters (en setters), en het komt de
     * leesbaarheid van je request-scripts ten goede. Maar wees er voorzichtig mee.
     */
    public function __get($name)
    {
        return $this->getDataField($name);
    }
    
    /** setters */
   
    protected function setPrimaryName($value)
    {
        $this->primary_name = $value;
    }
    
    protected function setPrimaryType($value)
    {
        $this->primary_type = $value;
    }
    
    protected function setData($value)
    {
        foreach ($value as &$str)
        {
            $str = utf8_encode($str);
        }
        $this->data = $value;
    }
    
    protected function setDataField($name, $value)
    {
        $this->data[$name] = $value;
    }
    
    /** generieke database-methods */
    
    public function delete(&$success)
    {
        $query =
        '
            DELETE 
            FROM ' . $this::TABLENAME . '
            WHERE ' . $this->getPrimaryName() . ' = :pk
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':pk', $this->getPrimaryValue(), $this->getPrimaryType());
        $statement->execute();
        $success = ($statement->rowCount() == 1);
    }
    
    /** static */
    
    /** 
     * De index-method (ophalen van alle records) is generiek gemaakt.
     * 
     * Let op de volgende trucs:
     * - de classnaam ($class) wordt bepaald met de functie get_called_class()
     * - de classnaam is nodig om de juiste tabelnaam te vinden, die als constante is gedefinieerd in elke class
     * - en de classnaam is nodig om nieuwe objecten te kunnen maken: new $class()
     */
    
    static public function index() 
    {
        $class = get_called_class();

        $query = 
        '
            SELECT *
            FROM ' . $class::TABLENAME . '
        ';
        $statement = Database::getInstance()->getPdo()->prepare($query);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($records as $record)
        {
            // maak een product-object met $record
            $object = new $class();
            $object->setData($record);
            $objects[] = $object;
        }
        return $objects;
    }

    /** json */
    
    /** 
     * Retourneer de data als json-string, of de waarde false als er een json-encoding-fout was. 
     */
    public function json()
    {
        return json_encode($this->getData());
    }

    static public function index_json() 
    {
        $class = get_called_class();
        $objects = $class::index();
        $jsons = [];
        foreach ($objects as $object)
        {
            $json = $object->json();
            if (!$json)
            {
                /**
                 * Blijkbaar was er een json-encoding-probleem met dit object.
                 * Je zou hem over kunnen slaan (dus op deze plek niks doen).
                 * Je kunt er ook voor kiezen om de id van het probleemgeval op te slaan in 
                 * een array en die toe te voegen aan de paramlijst van de method (&$errors).
                 */
            }
            else
            {
                /**
                 * Blijkbaar geen json-encoding-probleem.
                 * Dus gewoon toevoegen aan de te retourneren array.
                 */
                $jsons[] = $json;
            }
        }
        return '[' . join(', ', $jsons) . ']';
    }
    
}