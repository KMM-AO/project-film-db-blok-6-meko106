<?php

require './model.class.php';
require './view.class.php';

class obj extends Model{


    public function showView2(){
        $this->view->setTime("view2Time");
        // echo $this->view->time;

    }
    


}


// obj::showView2();

$obj=new obj();
$obj->showView2();



?>