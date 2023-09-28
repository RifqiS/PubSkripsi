<?php
    session_start();
    session_unset();
    session_destroy();
    unset($_COOKIE['inapp']); 
    setcookie('inapp', null, -1, '/'); 
    
    echo "<script>
    document.location.href='login.php';
    </script>";
