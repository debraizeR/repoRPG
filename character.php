<?php declare(strict_types=1);

class Character
{
    /** @var int  */
    private $_health;
    /** @var int */
    private $_rage;

    public function __construct(int $health, int $rage)
    {
        $this->_health = $health;
        $this->_rage = $rage;
    }

    public function getHealth()
    {
        return $this->_health;
    }
    public function getRage()
    {
        return $this->_rage;
    }

    public function setHealth($newHealth)
    {
        $this->_health = $newHealth;
    }
    public function setRage($newRage)
    {
        $this->_rage = $newRage;
    }

    public function upRage()
    {
        if($this->_rage >= 100)
        {
            $this->setRage(0);
        }
        $this->_rage += 30;
    }
}

?>