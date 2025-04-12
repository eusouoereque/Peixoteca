<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_destroy();
    header('Location: ../login?msg=logout');
    return; 
}
?>