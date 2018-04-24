<?php
session_start();
session_destroy();
Print '<script>window.location.assign("index.php");</script>';
?>