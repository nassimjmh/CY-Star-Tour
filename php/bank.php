<style>
    * {
        text-align: center;
    } 
</style>

<h2>Test page</h2>
<h3><a href="profil.php">Go back</a></h3>
<?php

    require('getapikey.php');    
    $transaction = "154632ABCZWTC";
    $montant = "18000.99";
    $vendeur = "MI-1_I";
    $retour = "http://localhost/retour_paiement.php?session=s";
    
    $api_key = getAPIKey($vendeur);
    $control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>
<form action='https://www.plateforme-smc.fr/cybank/index.php'
    method='POST'>
    <input type='hidden' name='transaction'
    value='<?php echo $transaction; ?>'>
    <input type='hidden' name='montant' value='<?php echo $montant; ?>'>
    <input type='hidden' name='vendeur' value='MI-1_I'>
    <input type='hidden' name='retour'
    value='http://localhost/retour_paiement.php?session=s'>
    <input type='hidden' name='control'
    value='<?php echo $control; ?>'>
    <input type='submit' value="Pay">
</form>
