<?php

class TestController extends controller { 

    public function test(){
        $this->view->setTemplate('zelftest');
        $this->view->render();
    }
}

?>