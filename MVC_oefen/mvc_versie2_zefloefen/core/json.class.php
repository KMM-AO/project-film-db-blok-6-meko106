<?php


class Json{

    private $data;

    public function __construct(){
        $this->setStatus(200, 'ok');
    }


    public function setStatus($code, $message){
        $this->add('status', ['code' => $code, 'message'=>$message]);
    }

    public function add($key, $value){
        $this->data[$key]= $value;
    }

    public function render(){
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }


}