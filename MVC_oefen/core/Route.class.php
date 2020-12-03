<?php

class Route{

    

    public function matches(Request $request){
        return $this->methodMatches($request->getMethod() )
        && $this->uriMatches($request->getUri(), $this->request_parameters);
    }



    
}




?>