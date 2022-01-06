<?php

namespace BackMCPE\Commands;

use BackMCPE\Back;
use BackMCPE\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class BackCommand extends Command {

    /**
     * @var Back
     */
    private Back $c;

    public function __construct(Back $core)
    {
        parent::__construct('back', Config::get('command.description'), Config::get('command.usage_message'), Config::get('command.aliases'));
        $this->c = $core;
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if(!$player instanceof Player) return $player->sendMessage(Config::get('use_in_game'));

        if(!$player->hasPermission(Config::get('command.permission')) && !Back::getInstance()->getServer()->isOp($player->getName())) return $player->sendMessage(Config::get('player_doesnt_have_permission'));

        if(!$this->c->manager::hasBackCoordinates($player->getXuid())) return $player->sendMessage(Config::get('player_doesnt_have_coordinates_set'));

        $pos = $this->c->manager::getBackCoordinates($player->getXuid());
        $player->teleport(new Vector3($pos[0], $pos[1], $pos[2]));
        $player->sendMessage(Config::get('player_teleport'));

        if(Config::get('delete_coordinates_after_use') === "true") $this->c->manager::removeBackCoordinates($player->getXuid());
    }
}