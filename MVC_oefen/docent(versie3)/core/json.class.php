<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

/**
 * Deze class is bedoeld voor de response op API-requests.
 */
class Json{
    /** 
     * De data (een array) die als JSON-string in de response moet komen. 
     */
    private $data;
    
    /** 
     * De constructor
     * - stel de status in als ok (kan overschreven worden)
     */
    public function __construct(){
        $this->setStatus(200, 'ok');
    }
    
    /** 
     * Stop een status in de response-data (code en message)
     */
    public function setStatus($code, $message){
        $this->add('status', ['code' => $code, 'message' => $message]);
    }
    
    /**
     * Voeg gegevens toe aan de response-data.
     */
    public function add($key, $value){
        $this->data[$key] = $value;
    }
    
    /** 
     * Het weergeven van de response als json. 
     * - mogelijk zijn hier meer headers wenselijk (zoals CORS)
     */
    public function render()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }
}
