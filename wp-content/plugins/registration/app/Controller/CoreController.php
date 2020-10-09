<?php

namespace oProfile\Plugin\Registration\Controller;

abstract class CoreController
{
    /**
     * Router
     *
     * @var Router
     */
    private $router;

    /**
     * Constructor
     *
     * @param Router $router Router
     */
    public function __construct($router)
    {
        $this->router = $router;
    }

    /**
     * Redirect
     *
     * @param string $url
     */
    protected function redirect($url)
    {
        wp_redirect($url);
        exit;
    }

    /**
     * Redirect to route
     *
     * @param string $routeName
     */
    protected function redirectToRoute($routeName)
    {
        $url = $this->router->generate($routeName);

        $this->redirect($url);
    }

    /**
     * Render the view
     *
     * @param string $viewName      View name
     * @param array  $viewVariables View variables
     */
    protected function render($viewName, $viewVariables = [])
    {
        extract($viewVariables);

        $router = $this->router;

        require plugin_dir_path(OPROFILE_PLUGIN_REGISTRATION_FILE) . 'views/' . $viewName . '.php';
    }
}
