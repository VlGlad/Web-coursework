<?php

class WeightController
{
    private $weight_table = "weight_points";
    private $disease_table = "user_diseases";
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
            $this->disease_rows = App::get('database')->getRowsWhere($this->disease_table, ['user_fr_id' => $_SESSION['user_id']], 'order by disease_date');
            return;
        }
    }

    public function getNames($args = NULL)
    {
        $weight_points = App::get('database')->getRowsWhere($this->weight_table, ['user_id' => $_POST['user_id']], 'order by date');

        $diseases = App::get('database')->getAllRows("deases");
        $diseas_rows = App::get('database')->getRowsWhere($this->disease_table, ['user_fr_id' => $_SESSION['user_id']], 'order by disease_date');

        foreach ($diseas_rows as $disease_item) {
            foreach ($diseases as $item) {
                if ($item->deases_id == $disease_item->disease_fr_id){
                    $disease_item->disease_fr_id = $item->deases_name;
                }
            }
        }

        echo json_encode([
                        'weight' =>$weight_points,
                        'disease' => $diseas_rows
                    ]);
    }

    public function index($args = NULL){   
        $this->initNames();
        $diseases = App::get('database')->getAllRows("deases");
        require "app/views/index.view.php";
    }

    public function edit($args = NULL)
    {
        $this->initNames();
        if (!$_SESSION['admin_user']){
            require "app/views/edit.view.php";
        } else {
            require "app/views/edit_admin.view.php";
        }
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
        if ($_POST['table'] == 'weight'){
            App::get('database')->delete($this->weight_table, ["weight_id" => $_POST["button_id"]]);
        } else if ($_POST['table'] == 'disease'){
            App::get('database')->delete($this->disease_table, ["user_disease_id" => $_POST["button_id"]]);
        }
    }

    public function addDisease($args = NULL)
    {
        $diseases = [
            "user_fr_id" => $_SESSION['user_id'],
            "disease_fr_id" => $_POST['id'],
            "disease_date" => $_POST['date']
        ];
        $user = App::get("database")->insert($this->disease_table, $diseases);

        echo json_encode(App::get('database')->getRowsWhere($this->disease_table, ['user_fr_id' => $_SESSION['user_id']], 'order by disease_date'));
    }

    public function update($args = NULL)
    {
        $id = array_pop($_POST);
        $table = array_pop($_POST);
        if ($table == 'weight'){
            
        } else if ($table == 'user_diseases'){
            
            $disease_fr_id = App::get('database')->getRowsWhere("deases", ["deases_name" => $_POST["diseasesSelect"]])[0]->deases_id;
            $data = [
                'disease_fr_id' => $disease_fr_id,
                'disease_date' => $_POST["date"]
            ];
            App::get('database')->update($table, $data, ['user_disease_id' => $id]);
        }
    }
}