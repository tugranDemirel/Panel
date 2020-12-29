<?php
    session_start();
    session_destroy();
    header('Refresh: 3; login.php');
    echo "Yönlendiiriliyorsunuz.";
    exit();
