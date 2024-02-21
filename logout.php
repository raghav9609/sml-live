<?php 
    require_once(dirname(__FILE__) . '/include/constant.php');
    
    session_destroy();

    echo '<script>window.location.href = "'.$head_url.'";</script>';
    exit();
?>