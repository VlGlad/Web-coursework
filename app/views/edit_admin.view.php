<?php
if (!isset($_SESSION['user_id']) && (!$_SESSION['admin_user'])){
    header('Location: /404');
}
?>
<?php require('partials/head.php');?>

<div class="container" id="graphContainer">

    <form action="" name="getWeights">
        <input type="text" name="user_id">
        <input type="submit">
    </form>
    
    <?php /*?>
    <div class="listing">
        <ul>
            <?php for ($i = 0; $i < count($this->user_date); $i++):?>
                <div class="weights">
                    <button class="weightsButtons btn btn-danger" id="<?php echo $this->weight_points[$i]->weight_id;?>">del</button>
                    <li><?=$this->user_date[$i], " ", $this->user_weight[$i];?>kg</li>
                </div>
            <?php endfor;?>
        </ul>
    </div>
    <?php */?>
    <div class="weights-container">
        <h5>Users weights points:</h5>
        <ul id="weights_points">

        </ul>
    </div>
    <div class="second-container">
        <h5>Users some other points:</h5>
        <ul id="some-points">

        </ul>
    </div>
</div>

<script type="text/javascript" src="public/js/edit_admin.js"></script>
<?php require('partials/footer.php');?>
