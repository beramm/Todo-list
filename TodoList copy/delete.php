<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'controller.php';

$id = $_GET["id"];
if (deleteTgt($id)>0) {
    header("Location: index.php");
    exit;
} else {
    echo "
    <script>
        alert('error');
    </script>
    ";
}
?>