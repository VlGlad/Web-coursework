<?php require('partials/head.php');?>

<div class="container" id="graphContainer">
    <h4>Enter your weight to get the graph:</h4>

    <form action="" id="addPointForm">
        <input type="number" step="0.001" name="weight">
        <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>">
        <input type="submit">
    </form>

    <div class="chartConteiner"> <!-- style="position: relative; height:50vh; width:100vh" -->
        <canvas id="myChart" width="400" height="170"></canvas>
    </div>
</div>

<?php require('partials/footer.php');?>
