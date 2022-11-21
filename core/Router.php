<?php

class Router{
    
    private $get = [];
    private $post = [];

    public static function create($file)
    {   
        $router = new static;
        require $file;
        return $router;
    }

    public function get($alias, $uri)
    {
        $this->get[$alias] = $uri;
    }

    public function post($alias, $uri)
    {
        $this->post[$alias] = $uri;
    }

    public function getError( $errorNumber)
    {
        
        switch ($errorNumber) {
            case 400:
                $this->callController("PageController", "Error400");
                break;
            
            case 404:
                $this->callController("PageController", "Error404");
                break;
        }
    }

    public function direct()
    {
        $uri = trim(
            parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
        $method = 'get';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') $method = 'post';
        
        if (! array_key_exists($uri, $this->$method)){
            return (
                $this->getError(404)
            );    
        }
        
        return (
            $this->callController(...explode('@', $this->$method[$uri]))
        );
    }

    public function callController($controller, $action)
    {
        if (! class_exists($controller)){
            return (
                $this->getError(404)
            );  
        }

        $controller = new $controller;
        if (! method_exists($controller, $action)){
            return (
                $this->getError(404)
            );
        }
        
        return $controller->$action();
    }
}