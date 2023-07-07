<?php
require __DIR__ . "/classes/class_bankr.php";
require __DIR__ . "/classes/class_transactie.php";
require __DIR__ . "/classes/class_transactieoverzicht.php";
require __DIR__ . "/classes/class_timestamp.php";


$Bankr_A = new Bankr("Jantje", 1, 100.00);
// $Bankr_A->set_blokkade(True);

$Bankr_B = new Bankr("Pietje", 2, 0);
$Bankr_B->set_saldobodem(-100);

echo "Saldo " . $Bankr_A->get_name() . ": " . $Bankr_A->get_saldo() . "<br>";
echo "Saldo " . $Bankr_B->get_name() . ": " . $Bankr_B->get_saldo() . "<br>";

$transactie = new Transactie(30, $Bankr_A, $Bankr_B);
$transactie->transactie();

echo "<pre>";
print_r($Bankr_A->get_transactieGeschiedenis());
echo "</pre>";

echo "<pre>";
print_r($Bankr_B->get_transactieGeschiedenis());
echo "</pre>";

echo "Saldo " . $Bankr_A->get_name() . ": " . $Bankr_A->get_saldo() . "<br>";
echo "Saldo " . $Bankr_B->get_name() . ": " . $Bankr_B->get_saldo() . "<br>";

$transactie = new Transactie(20, $Bankr_B, $Bankr_A);
$transactie->transactie();

echo "<pre>";
print_r($Bankr_A->get_transactieGeschiedenis());
echo "</pre>";

echo "<pre>";
print_r($Bankr_B->get_transactieGeschiedenis());
echo "</pre>";

echo "Saldo " . $Bankr_A->get_name() . ": " . $Bankr_A->get_saldo() . "<br>";
echo "Saldo " . $Bankr_B->get_name() . ": " . $Bankr_B->get_saldo() . "<br>";

// $Bankr_B->set_blokkade(True);
$transactie = new Transactie(10, $Bankr_A, $Bankr_B);
$transactie->transactie();

echo "<pre>";
print_r($Bankr_A->get_transactieGeschiedenis());
echo "</pre>";

echo "<pre>";
print_r($Bankr_B->get_transactieGeschiedenis());
echo "</pre>";

echo "Saldo " . $Bankr_A->get_name() . ": " . $Bankr_A->get_saldo() . "<br>";
echo "Saldo " . $Bankr_B->get_name() . ": " . $Bankr_B->get_saldo() . "<br>";

// ONDERSTAANDE CODE ROEPT VRAGEN OP OVER DE VEILIGHEID: het transactieobject bevat de complete transactiegeschiedenis van beide klanten, zender en ontvanger (is dat wel verstandig?)
// én ONDERSTAANDE CODE ROEPT VRAGEN OP OVER DE EFFICIENCY: het transactieobject bevat de complete transactiegeschiedenis van beide klanten, zender en ontvanger (is dat wel verstandig?)
// echo "<pre>";
// print_r($transactie); //uiteraard wordt een specifieke transactie nooit zo uitgeprint (een klant krijgt met get_transactieGeschiedenis() alleen zijn eigen kant van de transacties te zien, dus het is best VEILIG, lijkt me).
// echo "</pre>"; //TOCH: als bij een echte bank (met miljoenen klanten) per transactie de volledige transactiegeschiedenis van beide transactiepartijen wordt meegenomen bij het creëren van het betreffende transactie-object, ontstaat een ENORM groeiende sneeuwbal, lijkt me niet zo EFFICIENT!
// BOVENDIEN: bij een echte bank worden ook transacties met klanten van andere banken gedaan: in dat geval is er normaliter ook geen toegang tot de volledige transactiegeschiedenis van de andere partij van de transactie.
// CONCLUSIE: de inrichting van dit OOP-bankje nog maar eens heroverwegen (bijv. transactiegeschiedenis-array niet als property van bankrekening-class/object maar van een nog te creëren bank-object, waarin dan alle transacties staan van de bank en waaruit elke klant zijn eigen specifieke tr.gesch. haalt);
// AAN DE ANDERE KANT: hoe meer ik naar mijn code kijk, hoe logischer ik de al gemaakte keuzes vind. Een transactie-overzicht (array) per transactie, dat wordt opgesplitst in een subarray voor in de transactiegeschiedenis van de ene transactie-partij en een subarray voor in de transactiegeschiedenis van de andere transactie-partij: LOGISCH;
// en de bank zelf kan ook een totaaloverzicht (array) van alle transactie-overzichten maken, toch (dat moet dan nog worden uitgewerkt)? En is het niet zo, dat hoe dan ook, per transactie de transactiegeschiedenis van beide partijen moet worden geactualiseerd (waar je die ook hebt staan)?
// Hoe dan ook: zie hieronder (transactieoverzicht accumuleert ook de transactiegeschiedenis van beide partijen, dus je zou zeggen dat het toch anders moet):

echo "<pre>";
print_r($transactie); //identieke print_r (op de naam van het object na: Transactie Object)
echo "</pre>";
$transactieOverzicht = new TransactieOverzicht($transactie->get_bedrag(), $transactie->get_rekeningZender(), $transactie->get_rekeningOntvanger(), $transactie->get_datumTijd());
echo "<pre>";
print_r($transactieOverzicht); //identieke print_r (op de naam van het object na: TransactieOverzicht Object)
echo "</pre>";