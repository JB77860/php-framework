<?php

namespace m2i\project\controllers;


class DefaultController extends AbstractController
{
    public function defaultAction()
    {
        echo "default";
    }

    public function loginAction()
    {
        echo "login";
    }

    public function helloAction($name)
    {

        $this->render("home/default", ["name" => $name]);
    }
}