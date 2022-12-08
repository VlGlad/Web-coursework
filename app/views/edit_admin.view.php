<?php
if (!isset($_SESSION['user_id']) && (!$_SESSION['admin_user'])){
    header('Location: /404');
}
?>
<?php require('partials/head.php');?>

<div class="container" id="graphContainer">

    <h5>Enter user ID:</h5>

    <form action="" name="getWeights">
        <input type="text" name="user_id">
        <input type="submit">
    </form>
    
    <div class="weights-container">
        <h5>Users weights points:</h5>
        <ul id="weights_points">

        </ul>
    </div>
    <div class="diseases-container">
        <h5>Users some other points:</h5>
        <ul id="diseases_points">

        </ul>
    </div>
</div>

<?php if (isset($_SESSION['user_id'])):?>
    <div class="container" style="display: none;">
        <form action="" name="addDiseaseForm" id="diseaseForm">
            <select name="diseasesSelect" id="selectorDisease">
                <?php foreach ($diseases as $diseas):?>
                    <option id="<?php echo $diseas->deases_id?>"><?php echo $diseas->deases_name?></option>
                <?php endforeach;?>
            </select>
            <input type="date" id="date_input" name="date" value="<?php echo date("Y-m-d"); ?>">
            <input type="submit" value="Добавить">
        </form>
    </div>
<?php endif;?>

<script type="text/javascript" src="public/js/edit_admin.js"></script>
<?php require('partials/footer.php');?>
