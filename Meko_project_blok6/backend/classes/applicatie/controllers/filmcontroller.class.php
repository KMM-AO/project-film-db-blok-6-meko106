<?php




class FilmController extends Controller{


    public function index(){
        $this->view->setTemplate('filmsShow');
        $this->view->add('films',);
        $this->view->render();
    }


}