<?php

        //  winkelkar is een 2-dimensionale array
        //  die per rij een gekozen spelletje bevat
        //  iedere rij heeft 3 kolommen: SPEL_ID, CONSOLE_ID en AANTAL

        //  eerst gaan we kijken of het opgegeven spel al voorkomt in de winkelkar
        //  als dat het geval is, dan verhogen we gewoon het aantal met 1
        $gevonden = false;

        if( isset($_SESSION['WINKELKAR']) )
        {
            $winkelkar = $_SESSION['WINKELKAR'];

            for( $i=0; $i<count($winkelkar) and !$gevonden; $i++ )
            {
                if( $winkelkar[$i]['SPEL_ID']==$_GET['SPEL_ID'] and $winkelkar[$i]['CONSOLE_ID']==$_GET['CONSOLE_ID'] )
                {
                    $gevonden = true;
                    $winkelkar[$i]['AANTAL']++;
                }
            }
        }

        //  als het geselecteerde spel nog niet voorkomt in de winkelkar (of er is nog geen winkelkar)
        //  dan moeten we het toevoegen aan onze winkelkar

        if( !$gevonden )
        {
            $spel = array(
                'SPEL_ID' => $_GET['SPEL_ID'],
                'CONSOLE_ID' => $_GET['CONSOLE_ID'],
                'AANTAL' => 1
                );

            $winkelkar[] = $spel;
        }

        //  Onthou de nieuwe of gewijzigde winkelkar
        $_SESSION['WINKELKAR'] = $winkelkar;

        //  ga naar de winkelkar pagina
        header( 'location:'...);
    }
?>
