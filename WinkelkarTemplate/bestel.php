<?php

    //  Voeg de bestelling toe en onthoud de PK
    //

        $sqlInsert = $dbh->prepare(
            "INSERT INTO order (  klant_id,  betaalwijze )
                             VALUES ( :KLANT_ID, :BETAALWIJZE )"
        );
        $sqlInsert->bindValue( ':KLANT_ID',    $_SESSION['USER']['ID'] );
        $sqlInsert->bindValue( ':BETAALWIJZE', $_POST['BETAALWIJZE']   );
        $sqlInsert->execute();

        $bestelling_id = $dbh->lastInsertId();

    //
      //  Voeg alle spellen die in de winkelkar zitten
    //  toe aan de tabel bestelling_spel
    //

        $sqlInsert = $dbh->prepare(
            "INSERT INTO orderproduct (  bestelling_id,  ProductID,  console_id,  aantal )
                                  VALUES ( :BESTELLING_ID, :SPEL_ID, :CONSOLE_ID, :AANTAL )"
        );
        $sqlInsert->bindValue( ':BESTELLING_ID', $bestelling_id );

        foreach( $_SESSION['WINKELKAR'] as $winkelkarSpel )
        {
            $sqlInsert->bindValue( ':SPEL_ID',    $winkelkarSpel['SPEL_ID']    );
            $sqlInsert->bindValue( ':CONSOLE_ID', $winkelkarSpel['CONSOLE_ID'] );
            $sqlInsert->bindValue( ':AANTAL',     $winkelkarSpel['AANTAL']     );
            $sqlInsert->execute();
        }

    //
    //  De nieuwe bestelling werd aangemaakt -> meld dit aan de gebruiker
    //  en maak de winkelkar opnieuw leeg
    //
    unset( $_SESSION['WINKELKAR'] );
?>
