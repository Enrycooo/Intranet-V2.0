<?php ob_start();?>

<p>Bienvenue sur l'intranet de Landry-Sintec AVI permettant la demande de congés !</p>

<?php $content = ob_get_clean();?>

<?php require('layout.php') ?>
