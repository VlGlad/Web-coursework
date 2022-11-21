<?php

class WeightController
{
    private $weight_table = "weight_points";
    private $user_name;
    private $weight_points;
    private $user_weight;
    private $user_date;

    private function initNames($args = NULL){
        if (isset($_SESSION['user_id'])){
            $user_name = App::get('database')->getRowsWhere(Users::$users_table, ['id' => $_SESSION['user_id']]);
            $this->user_name = $user_name[0]->login;
            $this->weight_points = App::get('database')->getRowsWhere($this->weight_table, ['user_id' => $_SESSION['user_id']], 'order by date');
            $this->user_weight = array_map(function($item){return $item->weight;}, $this->weight_points);
            $this->user_date = array_map(function($item){return $item->date;}, $this->weight_points);
            return;
        }
    }

    public function getNames($args = NULL)
    {
        $weight_points = App::get('database')->getRowsWhere($this->weight_table, ['user_id' => $_SESSION['user_id']], 'order by date');
        echo json_encode($weight_points);
    }

    public function index($args = NULL){   
        $this->initNames();
        require "app/views/index.view.php";
    }

    public function edit($args = NULL)
    {
        $this->initNames();
        require "app/views/edit.view.php";
    }

    public function addPoint($args = NULL){
        $weights = [
            'user_id' => $_SESSION['user_id'],
            'weight' => $_POST["weight"],
            'date' => $_POST["date"]
        ];
        $user = App::get("database")->insert($this->weight_table, $weights);
    }

    public function delete($args = NULL)
    {
        App::get('database')->delete($this->weight_table, ["weight_id" => $_POST["button_id"]]);
    }
}