<?php
session_start();
ob_start();

unset( $_SESSION['user_name'],
$_SESSION['user_email'],
$_SESSION['user_photo'],
$_SESSION['user_CEPadress'],
$_SESSION['user_id'],
$_SESSION['datebr']
);


echo "<script>
alert('Sessão encerrada, nos vemos em breve!');
parent.location = '/';
</script>";

