<?php

namespace BackSystem;

use pocketmine\plugin\PluginBase;

class Back extends PluginBase {

    /**
     * @var Back
     */
    public static Back $i;

    /**
     * @return void
     */
    public function onEnable(): void
    {
        self::$i = $this;
        $this->getLogger()->info(Config::get('plugin_enabled'));

        //Init DB
        Manager::init();

        //Commands
        $this->getServer()->getCommandMap()->registerAll('back', [
            new Commands\BackCommand($this)
        ]);

        //Registering permission


    }

    /**
     * @return void
     */
    public function onDisable(): void
    {
        $this->getLogger()->info(Config::get('plugin_disabled'));
        Manager::close();
    }

    /**
     * @return static
     */
    public static function getInstance(): self {
        return self::$i;
    }
}