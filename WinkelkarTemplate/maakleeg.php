<?php
    require( '../config.php' );

    unset($_SESSION['WINKELKAR']);

    header( 'location:'.SITE_URL.'/winkelkar' );
?>
