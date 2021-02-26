<?php declare(strict_types=1); 

class Orc extends Character
{
    /** @var int */
    private $_damage;

    public function __construct($health, $rage)
    {
        Character::__construct($health, $rage);
        echo "L'orc possède ".Character::getHealth()." points de vie et ".Character::getRage()." points de rage.<br>";
    }

    public function getDamage()
    {
        return $this->_damage;
    }

    public function setDamage($newDamage)
    {
        $this->_damage = $newDamage;
    }

    public function attack()
    {
        $this->setDamage(rand(600, 800));
    }

    public function attacked($damaged)
    {
        $this->setHealth($this->getHealth() - $damaged);
    }
}

?>