<?php

declare(strict_types=1);

namespace App\Http;

use App\Interfaces\IRequest;

class Router
{
    private object $request;
    private array $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    public function __call(string $name, array $args)
    {
        list($route, $method) = $args;
        
        if(!in_array(strtoupper($name), $this->supportedHttpMethods))
        {
            $this->invalidMethodHandler();
        }
        
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    private function formatRoute(string $route)
    {
        $result = rtrim($route, '/');
        if ($result === '')
        {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler()
    {
        require __DIR__."/../views/405.php";
    }

    private function defaultRequestHandler()
    {   
        require __DIR__."/../views/404.php";
    }

    public function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        
        if(isset($methodDictionary[$formatedRoute])){
            $method = $methodDictionary[$formatedRoute];
        }else{
            $method = null;
        }
        
        if(is_null($method))
        {
            $this->defaultRequestHandler();
            return;
        }
        
        echo call_user_func_array($method, array($this->request));
    }

    public function __destruct()
    {
        $this->resolve();
    }
}