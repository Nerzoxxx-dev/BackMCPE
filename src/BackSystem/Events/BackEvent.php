<?php

namespace BackSystem\Events;

use BackSystem\Back;
use BackSystem\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;

class BackEvent implements Listener {
    /**
     * @var Back
     */
    private Back $c;

    public function __construct(Back $core){
        $this->c = $core;
    }

    /**
     * @param PlayerDeathEvent $e
     * @return void
     * @throws \JsonException
     */
    public function onDeath(PlayerDeathEvent $e){
        $player = $e->getPlayer();
        if($player->hasPermission('back.use') || Back::getInstance()->getServer()->isOp($player->getName())){
            $this->c->manager::setBackCoordinates($player->getXuid(), (float)$player->getPosition()->x, (float)$player->getPosition()->y, (float)$player->getPosition()->z);
        }
    }

    /**
     * @param PlayerQuitEvent $e
     * @return void
     * @throws \JsonException
     */
    public function onLeft(PlayerQuitEvent $e){
        $player = $e->getPlayer();
        if(Config::get('delete_coordinates_after_left') === "true"){
            if($this->c->manager::hasBackCoordinates($player->getXuid())){
                $this->c->manager::removeBackCoordinates($player->getXuid());
            }
        }
    }
}