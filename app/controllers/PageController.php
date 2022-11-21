<?php

class PageController{

    public function about( $args = NULL)
    {
        if (isset($_SESSION['user_id'])){
            $user_name = App::get('database')->getRowsWhere(Users::$users_table, ['id' => $_SESSION['user_id']]);
            $user_name = $user_name[0]->login;
        }
        require "app/views/about.view.php";
    }
    public function error400( $args = NULL)
    {
        require "app/views/400.view.php";
    }
    public function error404( $args = NULL)
    {
        require "app/views/404.view.php";
    }
}