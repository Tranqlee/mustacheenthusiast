<?php #login page wich redirects to index.php
require_once('comm.php');
session_start();
$link = getDatabase();

$OrderID = $_GET['nr'];
$reminder1 = "De gewenste betaalmethode aanduiden werkt/hoeft niet";
$reminder2 = "doordat het betalen niet nodig is voor de opdracht.";

if(isset($_POST['betaalmethode']))
{
    date_default_timezone_set('Europe/Brussels');

    $huidigeDatum = new DateTime();

    $jaar = $huidigeDatum->format('Y');
    $maand = $huidigeDatum->format('m');
    $dag = $huidigeDatum->format('d');
    $uur = $huidigeDatum->format('H');
    $minuten = $huidigeDatum->format('i');
    $seconden = $huidigeDatum->format('s');

    $datumTijd = $jaar . '-' . $maand . '-' . $dag . ' ' . $uur . ':' . $minuten . ':' . $seconden;

    $stmt = $link->prepare("UPDATE `order` SET isBesteld = 1, BestelDatum = :besteldatum WHERE OrderID = :OrderID");
    $stmt->bindValue(':besteldatum', $datumTijd);
    $stmt->bindValue(':OrderID', $OrderID);
    $stmt->execute();
    header('Location: user.php');
}
?>
<!DOCTYPE html>
<head>
    <title>Webtoepassing Bestelling Afronden</title>
    <link rel="stylesheet" href="login.css" />
    <script>
    function sendDate() {
        // Stuur de datum naar hetzelfde PHP-bestand
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
            console.log('Datum is succesvol naar PHP gestuurd');
            document.getElementById('currentDateTime').textContent = this.responseText;
            }
        };
        xhttp.open('POST', '', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send('bestellen=1');
    }
  </script>
</head>
<body class="main"
      style="width: fit-content; margin: 0 auto 0 auto; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; background-color: rgb(75, 75, 75 );">
<div class="center"
     style="background-color: rgb(35, 35, 35); margin: auto; padding: 0 1cm 0 1cm; width: fit-content; height: fit-content; border-radius: 0.35cm; border: none; box-shadow: 0px 0px 10px 1px black; color: white;">
    <table>
        <tr>
            <th>
                <h2>Bestelling plaatsen</h2>
            </th>
        </tr>
        <tr>
            <td>
                <div>
                    <form action="" method="POST">
                        <style>
                            table {
                                width: max-content;
                            }
                            label {
                                width: fit-content;
                                text-align: middle;
                                margin: auto;
                                padding-left: 0cm;
                            }
                            .info1 {
                                width: fit-content;
                                margin: auto;
                                display: flex;
                                flex-direction: column;
                                justify-content: center;
                                align-items: center;
                            }
                            .info1 select {
                                padding: 0.15cm;
                                margin: 0.15cm;
                                border: none;
                                border-radius: 0.10cm;
                                width: 100%;
                            }
                            .info1 option {
                                text-align: right;
                            }
                        </style>
                        <div class="info1">
                            <label style="color: white;" for="id"><?php echo "Order ID: " . $OrderID; ?></label>
                            <br>
                            <label style="color: white;" for="Username">Gebruikersnaam</label>
                            <select id="membersField" name="betaalmethode"/>
                                <option value="1">Bankcontact</option>
                                <option value="">Payconiq</option>
                                <option value="3">Kredietkaart</option>
                                <option value="4">Debetkaart</option>
                                <option value="5">Paypal</option>
                            </select>
                        </div>
                        <br>
                        <div class="buttonlogin">
                            <input class="buttonlogin" type="submit" value="Bestellen" style="width: 50%;"/>
                        </div>
                    </form>
                    <div style="margin: 0 auto 0 auto; width: fit-content;">
                        <p>Ga terug naar <a href="index.php">Hoofdmenu</a></p>
                    </div>
                    <br>
                    <div class="error">
                        <p class="errorText"><?php echo $reminder1; ?></p>
                        <p class="errorText"><?php echo $reminder2; ?></p>
                    </div>
                    <br>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>