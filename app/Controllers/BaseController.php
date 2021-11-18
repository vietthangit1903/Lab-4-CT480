<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use League\Plates\Engine;
use App\Traits\PaginatorTrait;
use Illuminate\Contracts\Pagination\Paginator as PaginationPaginator;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BaseController{
    use PaginatorTrait;
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

    /**
     * Http request
     * 
     * @var \App\Http\Request
     */
    public $request;

    /**
     * Return respone
     * 
     * @var \App\Http\Response
     */
    public $response;

    /**
     * Sessions
     * 
     * @var \App\Http\Session\Session
     */
    public $session;


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
        $this->request = request();
        $this->session = session();
        $this->request->setSession($this->session);
        $this->response = new Response();
        $this->view = new Engine(config('view.path'));

        Paginator::currentPageResolver(function ($pageName = 'page'){
            return $this->getCurrentPage();

        });
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
        $this->response->headers->set('Content-type', 'text/html');
        $this->response->setStatusCode(Response::HTTP_OK);
        $html =  $this->view->render($view, $data);
        $this->response->setContent($html);
        $this->response->prepare($this->request);

        return $this->response->send();
        
    }

    /**
     * Chuyen huong trang
     * 
     * @param string $route
     * @param integer $statusCode
     * @param array $headers
     * 
     * @return void
     */
    public function redirect($route, $statusCode = 302, $headers = []){
        $response = new RedirectResponse($route, $statusCode, $headers);

        return $response->send();
    }

    /**
     * Chuyen huong trang
     * 
     * @param array $data
     * @param integer $statusCode
     * @param array $headers
     * 
     * @return void
     */
    public function json($data = [], $statusCode = 200, $headers = []){
        $response = new JsonResponse($data, $statusCode, $headers);
        
        return $response->send();
    }
}

