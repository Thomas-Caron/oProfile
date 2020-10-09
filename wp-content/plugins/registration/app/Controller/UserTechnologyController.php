<?php

namespace oProfile\Plugin\Registration\Controller;

class UserTechnologyController extends CoreController
{
    public function display()
    {
        $this->render('user-technology');
    }

    public function update()
    {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
    }
}
