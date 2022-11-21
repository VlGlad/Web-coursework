<?php if (!isset($_SESSION['user_id'])){
    header('Location: /404');
}?>

<?php require('partials/head.php');?>

<style>

    /* .container#graphContainer{
        margin-top: 15px;
    } */
</style>

<div class="container" id="graphContainer">
    <?php if (isset($_SESSION['user_id'])):?>
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
    <?php endif;?>
</div>


<script type="text/javascript" src="public/js/edit.js"></script>
<?php require('partials/footer.php');?>
