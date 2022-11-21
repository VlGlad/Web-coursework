<?php

$config = require 'config.php';

$connection = Connection::make($config['database']);

$db = new QuerySelector($connection);

return $db;