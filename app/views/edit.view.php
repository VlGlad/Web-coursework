<?php if (!isset($_SESSION['user_id'])){
    header('Location: /404');
}?>

<?php require('partials/head.php');?>

<div class="container" id="graphContainer">
    <h5>Weights points:</h5>
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
</div>

<script type="text/javascript" src="public/js/edit.js"></script>
<?php require('partials/footer.php');?>
