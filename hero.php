<?php declare(strict_types=1);

class Hero extends Character
{
    /** @var string */
    private $_weapon;
    /** @var int */
    private $_weaponDamage;
    /** @var int */
    private $_weaponDamageRage;
    /** @var string */
    private $_shield;
    /** @var int */
    private $_shieldValue;

    public function __construct(int $health, int $rage, string $weapon, int $weaponDamage, string $shield, int $shieldValue)
    {
        Character::__construct($health, $rage);
        $this->_weapon = $weapon;
        $this->_weaponDamage = $weaponDamage;
        $this->_weaponDamageRage = $weaponDamage*2;
        $this->_shield = $shield;
        $this->_shieldValue = $shieldValue;

        echo "Le héros a ".Character::getHealth()." points de vie, ".Character::getRage()." points de rage. <br>Son arme ".$this->_weapon." a une puissance de ".$this->_weaponDamage.". 
        <br> bouclier ".$this->_shield." a une résistance de ".$this->_shieldValue.".<br>";
    }

    public function getWeapon()
    {
        return $this->_weapon;
    }
    public function getWeaponDamage()
    {
        return $this->_weaponDamage;
    }
    public function getWeaponDamageRage()
    {
        return $this->_weaponDamageRage;
    }
    public function getShield()
    {
        return $this->_shield;
    }
    public function getShieldValue()
    {
        return $this->_shieldValue;
    }

    public function setWeapon($newWeapon)
    {
        $this->_weapon = $newWeapon;
    }
    public function setWeaponDamage($newWeaponDamage)
    {
        $this->_weaponDamage = $newWeaponDamage;
    }
    public function setWeaponDamageRage($newWeaponDamageRage)
    {
        $this->_weaponDamageRage = $newWeaponDamageRage;
    }
    public function setShield($newShield)
    {
        $this->_shield = $newShield;
    }
    public function setShieldValue($newshieldValue)
    {
        $this->_shieldValue = $newshieldValue;
    }

    public function attack()
    {
        if(Character::getRage() >= 100)
        {
            return $this->getWeaponDamageRage();
        }
        else
        {
            return $this->getWeaponDamage();
        }
    }

    public function attacked($damage)
    {
        if($damage > $this->_shieldValue)
        {
            $totalDamage = $damage - $this->_shieldValue;
        }
        else
        {
            $totalDamage = 0;
        }

        $newHealth = Character::getHealth() - $totalDamage;
        if($newHealth < 0)
        {
            $newHealth = 0;
        }

        Character::setHealth($newHealth);
        Character::upRage();
    }
}



?>