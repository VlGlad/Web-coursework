<?php require('partials/head.php');?>

<div class="container" id="graphContainer">
    <h4>Enter your weight to get the graph:</h4>

    <form action="" id="addPointForm">
        <input type="number" step="0.001" name="weight">
        <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>">
        <input type="submit" value="Добавить">
    </form>

    <div class="chartConteiner"> <!-- style="position: relative; height:50vh; width:100vh" -->
        <canvas id="myChart" width="400" height="170"></canvas>
    </div>
</div>

<?php if (isset($_SESSION['user_id'])):?>
    <div class="container" style="padding-top: 25px;">

        <form action="" name="addDiseaseForm" id="diseaseForm">
            <select name="diseasesSelect" id="selectorDisease">
                <?php foreach ($diseases as $diseas):?>
                    <option id="<?php echo $diseas->deases_id?>"><?php echo $diseas->deases_name?></option>
                <?php endforeach;?>
            </select>
            <input type="date" id="date_input" name="date" value="<?php echo date("Y-m-d"); ?>">
            <input type="submit" value="Добавить">
        </form>


        <?php foreach ($this->disease_rows as $diseas):
            $disease_row = App::get('database')->getRowsWhere('deases', ['deases_id' => $diseas->disease_fr_id])[0];?>
            <div class="diseaseRow">
                <button id=<?=$diseas->user_disease_id?> class="diseaseDelButton btn btn-danger" type="button">del</button>
                <button id=<?=$diseas->user_disease_id?> class="diseaseEditButton btn btn-warning">edit</button>
                <li><?=$diseas->disease_date." ".$disease_row->deases_name?></li>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>

<?php require('partials/footer.php');?>
