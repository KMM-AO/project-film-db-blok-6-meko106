<?php





class Route{

    public $RequestUri;
    public $RequestMethod;
    public $RequestController;
    public $ControllerMethod;


    public function __construct($RequestUri,$RequestMethod,$RequestController,$ControllerMethod){
        $this->RequestUri=$RequestUri;
        $this->RequestMethod=$RequestMethod;
        $this->RequestController=$RequestController;
        $this->ControllerMethod=$ControllerMethod;
    }



    public function matchTheCurrentRequest(Request $reqeust){
        return ;

    }

    public function matchTheMethod(Reqeust $request){
        $succes=($request->getMethod==$this->RequestMethod);
        return $succes;
    }

    public function matchTheUri(Request $request){
        
    }










}