<?php

namespace oProfile;

class Router
{
    private const QUERY_VAR = 'routename';

    /**
     * Route list
     *
     * @var array
     */
    private $routes = [];

    public function __construct()
    {
        $this->configure();
    }

    /**
     * Add route
     *
     * @param string  $name     Route name
     * @param string  $method   HTTP method
     * @param pattern $pattern  URL pattern
     * @param array   $callback Route target
     *
     */
    public function addRoute(
        $name,
        $method,
        $pattern,
        $callback
    )
    {
        $this->routes[$name] = [
            'method'   => $method,
            'pattern'  => $pattern,
            'callback' => $callback
        ];
    }

    /**
     * Generate URL
     *
     * @param string $routeName Route name
     *
     * @return string URL
     */
    public function generate($routeName)
    {
        $url = null;

        if (array_key_exists($routeName, $this->routes)) {
            $route = $this->routes[$routeName];

            $url = get_bloginfo('url') . '/' . $route['pattern'];
        }

        return $url;
    }

    /**
     * Add rewrite rules
     */
    public function addRewriteRules()
    {
        if (! empty($this->routes)) {
            foreach ($this->routes as $routeName => $route) {
                add_rewrite_rule(
                    '^' . $route['pattern'] . '$',
                    'index.php?' . self::QUERY_VAR . '=' . $routeName,
                    'top'
                );
            }
        }
    }

    /**
     * Match route
     *
     * @return array Matched route
     */
    public function match()
    {
        $route = null;

        $routeName = get_query_var(self::QUERY_VAR);

        if (
            array_key_exists($routeName, $this->routes) &&
            $this->routes[$routeName]['method'] === $_SERVER['REQUEST_METHOD']
        ) {

            $route = $this->routes[$routeName];
        }

        return $route;
    }

    /**
     * Set WordPress actions and filters
     */
    private function configure()
    {
        add_filter(
            'query_vars',
            [
                $this,
                'configureQueryVars'
            ]
        );
    }

    /**
     * Configure WordPress query vars
     *
     * @param array $queryVars Query vars
     *
     * @return array Updated query vars
     */
    public function configureQueryVars($queryVars)
    {
        $queryVars[] = self::QUERY_VAR;

        return $queryVars;
    }
}
