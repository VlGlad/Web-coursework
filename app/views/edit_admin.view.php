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

<script type="text/javascript" src="public/js/edit_admin.js"></script>
<?php require('partials/footer.php');?>
