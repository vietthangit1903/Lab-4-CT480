<?php

namespace App\Controllers;

use League\Plates\Engine;

class BaseController{
    /**
     * URL chuyen huong mac dinh khi duong dan khon hop le
     *
     * @var string
     */
    public $redirect = '/home';

    /**
     * View engine
     * 
     * @var League\Plates\Engine;
     */
    public $view;

    public function __construct()
    {
        $this -> init();

        if(!$this->authorize()){
            redirect ($this->redirect);
        }
    }
    
    /**
     * Ham khoi tao controller
     * 
     * @return void
     */
    public function init(){
        $this->view = new Engine(config('view.path'));
    }

    /**
     * Phuong thuc kiem tra moi khi controller duoc goi
     * 
     * @return void
     */
    public function authorize(){
        return true;
    }

    public function render($view, $data = []){
        echo $this->view->render($view, $data);
    }
}
