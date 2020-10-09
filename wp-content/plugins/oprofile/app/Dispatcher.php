<?php

namespace oProfile;

class Dispatcher
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

        $this->configure();
    }

    /**
     * Dispatch
     *
     * @param array $route Matched route
     */
    public function dispatch($route)
    {
        $controller = new $route['callback']['controllerName']($this->router);

        call_user_func(
            [
                $controller,
                $route['callback']['methodName']
            ]
        );
    }

    /**
     * Configure hooks
     */
    private function configure()
    {
        add_filter(
            'posts_request',
            [
                $this,
                'overrideWordPressMainQuery'
            ]
        );

        add_action(
            'template_include',
            [
                $this,
                'overrideWordPressTemplateInclude'
            ]
        );
    }

    /**
     * Override WordPress Main Query
     *
     * @param string $request WordPress request
     *
     * @return void|string
     */
    public function overrideWordPressMainQuery($request)
    {
        $route = $this->router->match();

        if (! $route) {
            return $request;
        }
    }

    /**
     * Override WordPress template include
     *
     * @param string $template WordPress template
     *
     * @return string WordPress template
     */
    public function overrideWordPressTemplateInclude($template)
    {
        $route = $this->router->match();

        if ($route) {
            $this->dispatch($route);
        } else {
            return $template;
        }
    }
}
