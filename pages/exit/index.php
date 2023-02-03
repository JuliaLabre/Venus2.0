<?php
session_start();
ob_start();

unset($_SESSION['user_name'],$_SESSION['user_email'],$_SESSION['user_birth'],$_SESSION['user_photo'],$_SESSION['user_adress']);
$_SESSION['msg'] = '<div class="alert alert-secondary" role="alert">
Sessão Encerrada, nos vemos em breve!
</div>';
header("location:../login");