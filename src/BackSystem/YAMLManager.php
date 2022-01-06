<?php

namespace BackSystem;

class YAMLManager
{

    /**
     * @param string $playeruuid
     * @return bool
     */
    public static function hasBackCoordinates(string $playeruuid): bool
    {
        return (new \pocketmine\utils\Config(Back::getInstance()->getDataFolder() . 'players.yml', \pocketmine\utils\Config::YAML))->exists($playeruuid);
    }

    public static function getBackCoordinates(string $playeruuid): array
    {
        return (new \pocketmine\utils\Config(Back::getInstance()->getDataFolder() . 'players.yml', \pocketmine\utils\Config::YAML))->get($playeruuid);
    }

    /**
     * @param string $playeruuid
     * @param float $posX
     * @param float $posY
     * @param float $posZ
     * @return void
     * @throws \JsonException
     */
    public static function setBackCoordinates(string $playeruuid, float $posX, float $posY, float $posZ): void
    {
        $yaml = new \pocketmine\utils\Config(Back::getInstance()->getDataFolder() . 'players.yml', \pocketmine\utils\Config::YAML);
        $yaml->set($playeruuid, [$posX, $posY, $posZ]);
        $yaml->save();
    }

    /**
     * @param string $player_uuid
     * @return void
     * @throws \JsonException
     */
    public static function removeBackCoordinates(string $player_uuid): void
    {
        $yaml = new \pocketmine\utils\Config(Back::getInstance()->getDataFolder() . 'players.yml', \pocketmine\utils\Config::YAML);
        $yaml->remove($player_uuid);
        $yaml->save();
    }
}