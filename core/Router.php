<?php
namespace core;
use PHPUnit\Runner\Exception;

/**
 * Description of router
 *
 * @author Alexandr
 */
class Router
{

    public function __construct()
    {
        try {
            $urlParams = explode('/', ($_SERVER['REQUEST_URI']));
            if (!empty($urlParams[1])) {
                $pageController = 'controller\\' . $urlParams[1] . 'Controller';
            } else {
                $pageController = 'controller\mainpageController';
            }

            $controller = new $pageController;
        } catch(Exception $e) {
            $errorMessage = $e->getMessage();
            require '/view/error.php';
            exit();
        }

    }

}
