<?php
    require_once('comm.php');
    session_start();

    if(isset($_SESSION['WINKELKAR']))
    {
        $winkelkar = $_SESSION['WINKELKAR'];
        for( $i=0; $i<count($winkelkar); $i++ )
        {
            if($winkelkar[$i]['AANTAL'] >= 1)
            {
                if($winkelkar[$i]['ProductID'] == $_GET['nr'])
                {
                    $winkelkar[$i]['AANTAL']--;
                    header( 'location: shoppingcartT.php');
                }
            }
            if($winkelkar[$i]['AANTAL'] < 1)
            {
                unset($winkelkar[$i]);
                $winkelkar = array_values($winkelkar);
                header( 'location: shoppingcartT.php');
            }
        }
        $_SESSION['WINKELKAR'] = $winkelkar;
    }
?>
