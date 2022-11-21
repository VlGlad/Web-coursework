<?php

class Users{
    static public $users_table = "users_login_data";

    public function signIn($args = NULL)
    {
        $answer = [
            "login" => false,
        ];

        $login = $_POST["login"];
        $password = $_POST["password"];

        if (!$login or !$password){
            echo json_encode($answer);
            die;
        }
        
        $user = App::get("database")->getRowsWhere(self::$users_table, ['login' => $login]);
        $user_count = count($user);
        if (!$user_count){
            echo json_encode($answer);
            die;
        }
        
        if (password_verify($password, $user[0]->password)){
            if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)){

                $new_password = [
                    'id' => $user[0]->id,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];

                try {
                    App::get('database')->updatePassword(self::$users_table, $new_password);   
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            $answer['login'] = true;
            $_SESSION['user_id'] = $user[0]->id;
        }
        echo json_encode($answer);
        
    }

    public function signUp($args = NULL)
    {
        $answer = [
            "register" => false,
        ];

        $login = $_POST["login"];
        $password = $_POST["password"];
        $password_check = $_POST["password_check"];

        if ($login == ''){
            echo json_encode($answer);
            die;
        }

        if (!preg_match('/^[a-zA-Z0-9-._]{3,15}$/', $login)){
            echo json_encode($answer);
            die;
        }

        if (strlen($password) < 3 or strlen($password) > 256){
            echo json_encode($answer);
            die;
        }

        if ($password != $password_check){
            echo json_encode($answer);
            die;
        }

        $user_data = [
            'login' => $_POST['login'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ];

        try {
            App::get('database')->insert(self::$users_table, $user_data);   
        } catch (\Throwable $th) {
            //throw $th;
        }

        $answer['register'] = true;
        echo json_encode($answer);
    }

    public function logOut($args = NULL)
    {
        if (isset($_SESSION['user_id'])){
            unset($_SESSION['user_id']);
        }
        header("Location: /");
    }
}