<?php
    session_start();
	require_once 'lib/File.php';
    require_once (File::build_path(array('controller','routeur.php')));
    require_once (File::build_path(array('lib','Session.php')));
?>