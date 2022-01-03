<?php

namespace BackSystem;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;

class BackEvent implements Listener {
    /**
     * @var Back
     */
    private Back $c;

    public function __construct(Back $core){
        $this->c = $core;
    }

    public function onDeath(PlayerDeathEvent $e){
        $player = $e->getPlayer();
        if($player->hasPermission('back.use') || Back::getInstance()->getServer()->isOp($player->getName())){
            Manager::setBackCoordinates($player->getXuid(), (float)$player->getPosition()->x, (float)$player->getPositio()->y, (float)$player->getPosition()->z);
        }
    }
}