<?php


namespace m2i\framework;


class Dispatcher
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var string
     */
    private $nameSpace;

    /**
     * Dispatcher constructor.
     * @param Router $router
     * @param string $nameSpace
     */
    public function __construct(Router $router, $nameSpace = "")
    {
        $this->router = $router;
        $this->nameSpace = $nameSpace;
    }


    public function run()
    {
        $className = $this->nameSpace . $this->router->getControllerName();
        $controllerInstance = new $className();

        if (is_subclass_of($controllerInstance, "AbstractController")) {
            $controllerInstance->setView("layout");
        }

        call_user_func_array(
            [$controllerInstance, $this->router->getActionName()],
            $this->router->getActionParameters()
        );
    }
}