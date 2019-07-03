<?php


namespace m2i\framework;


class Router
{
    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $controllerName = "DefaultController";

    /**
     * @var string
     */
    private $actionName = "defaultAction";

    /**
     * @var array
     */
    private $actionParameters = [];

    /**
     * Router constructor.
     * @param string $route
     */
    public function __construct($route)
    {
        $this->route = $route;

        $urlParts = explode("/", $route);

        if (count($urlParts) > 0 && !empty(trim($urlParts[0]))) {
            $this->controllerName = $this->pascalize(array_shift($urlParts)) . "Controller";
        }

        if (count($urlParts) > 0 && !empty(trim($urlParts[0]))) {
            $this->actionName = $this->camelize(array_shift($urlParts)) . "Action";
        }

        if (count($urlParts) > 0 && !empty(trim($urlParts[0]))) {
            $this->actionParameters = $urlParts;
        }
    }

    private function pascalize($str)
    {
        // Il faut échapper le underscore
        $pattern = "#(\_|-| )?([a-zA-Z0-9])+#";
        return preg_replace_callback(
            $pattern,
            function ($matches) {
                $matches[0] = str_replace($matches[1], "", $matches[0]);
                $matches[0] = strtoupper(substr($matches[0], 0, 1))
                    . strtolower(substr($matches[0], 1));

                return $matches[0];
            },
            $str
        );
    }

    private function camelize($str)
    {
        $temp = $this->pascalize($str);
        return strtolower(substr($temp, 0, 1))
            . substr($temp, 1);
    }


    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return array
     */
    public function getActionParameters()
    {
        return $this->actionParameters;
    }


}