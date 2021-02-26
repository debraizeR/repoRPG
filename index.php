<?php
require_once("character.php");
require_once("hero.php");
require_once("orc.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>    
    <?php

    $hero = new Hero(5000, 0, "Excalibur", 200, "Aegis", 100);
    $orc = new Orc(2000, 0);

    $battleTab[] = array("orcDamage"=>$orc->getDamage(), "heroHealth"=>$hero->getHealth(), "heroRage"=>$hero->getRage(), "weaponDamage"=>$hero->getWeaponDamage(),"shieldValue"=>$hero->getShieldValue());
    $battleTab[] = array("heroDamage"=>$hero->getWeaponDamage(), "orcHealth"=>$orc->getHealth());

    
    ?>
    <button type="button" onclick="Fight()" name="Battle" id="Battle" value="Battle">Combat</button>
    <a type="button" href="index.php" name="newBattle" id="newBattle" value="newBattle">Nouveau combat</a>

    <div class="container"> 
        <div class="container-enemy">
            <div class="enemy" id="enemy">
                <progress id="orcHealth" max="100" value="100"></progress><br>
                <img src="assets/img/Orc_Artwork.png">
            </div>
        </div>
        <div class="textbox" id="textbox">
            </div>
        <div class="container-hero">
            <div class="iconHero">
                <img src="assets/img/hero.png">
            </div>    
            <div class="statHero">
                <object data="assets/img/hearts.svg"></object> <span id="heroHealth"> <?= $hero->getHealth() ?> </span><br>
                <object data="assets/img/ifrit.svg"></object> <span id="heroRage"> <?= $hero->getRage() ?> </span>
            </div>
            <div class="statHero2">
                <object data="assets/img/gladius.svg"></object> <span id="heroWeapon"> <?= $hero->getWeaponDamage() ?> </span><br>
                <object data="assets/img/shield.svg"></object> <span id="heroShield"> <?= $hero->getShieldValue() ?> </span>
            </div>
        </div>
    </div>

    <?php
    
    while($hero->getHealth() > 0 && $orc->getHealth() > 0)
    {
        $orc->attack();
        $hero->attacked($orc->getDamage());
        $battleTab[] = array("orcDamage"=>$orc->getDamage(), "heroHealth"=>$hero->getHealth(), "heroRage"=>$hero->getRage(), "weaponDamage"=>$hero->attack(),"shieldValue"=>$hero->getShieldValue());
        if($hero->getHealth() > 0)
        {
            $orc->attacked($hero->attack());
            $battleTab[] = array("heroDamage"=>$hero->attack(), "orcHealth"=>$orc->getHealth());
        }
    }

?>
<script>
        var battleTab = <?php echo json_encode($battleTab); ?>;
        var battleTabLength = battleTab.length;

        function pause(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function Fight() {
            for (let i = 2; i < battleTabLength; i++) {
                
                if ((i % 2) != 0) {
                    document.getElementById("orcHealth").value=(battleTab[i]["orcHealth"] / battleTab[1]["orcHealth"] ) *100;
                    if(battleTab[i]["orcHealth"] > 0)
                    {
                        document.getElementById("textbox").innerHTML = "Le héros attaque. L'orc reçoit " + battleTab[i]["heroDamage"] + " de dégats.";
                    }
                    else
                    {
                        document.getElementById("textbox").innerHTML = "Le héros attaque. L'orc reçoit " + battleTab[i]["heroDamage"] + " de dégats.<br>L'orc est vaincu";
                    }
                                        
                }else{
                    document.getElementById("heroHealth").innerHTML= battleTab[i]["heroHealth"] ;
                    document.getElementById("heroRage").innerHTML= battleTab[i]["heroRage"] ;
                    document.getElementById("heroWeapon").innerHTML= battleTab[i]["weaponDamage"] ;
                    document.getElementById("heroShield").innerHTML= battleTab[i]["shieldValue"] ; 

                    if(battleTab[i]["heroHealth"] != 0)
                    {
                        document.getElementById("textbox").innerHTML = "L'orc attaque avec une puissance de " + battleTab[i]["orcDamage"] +".";
                    }
                    else
                    {
                        document.getElementById("textbox").innerHTML = "L'orc attaque avec une puissance de " + battleTab[i]["orcDamage"] +".<br>Le héros est vaincu.";
                    }

                }
                await pause(1000);
            }
        }
        
    </script>

</body>
</html>