</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    var is_user_logged_in = <?php echo json_encode(isset($_SESSION['user_id']));?>;
    var current_user_weight = <?php echo json_encode($user_weight); ?>;
    var current_user_date = <?php echo json_encode($user_date); ?>;
    var js_user_name = <?php echo json_encode($user_name); ?> ? <?php echo json_encode($user_name); ?> + "'s " : "";
</script>
<script type="text/javascript" src="public/js/chart.js"></script>
</body>
</html>
