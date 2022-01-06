<?php

namespace BackMCPE;

use pocketmine\plugin\PluginBase;

class Back extends PluginBase {

    /**
     * @var Back
     */
    public static Back $i;

    /**
     * @var SQLManager|YAMLManager
     */
    public SQLManager|YAMLManager $manager;

    /**
     * @return void
     */
    public function onEnable(): void
    {
        self::$i = $this;
        $this->getLogger()->info(Config::get('plugin_enabled'));

        //Init Manager
        switch(strtolower(Config::get('driver'))){
            case 'yaml':
                $this->manager = new YAMLManager();
                break;
            case 'sqlite3':
                $this->manager = new SQLManager();
                break;
            case 'mysql':
                $this->manager = new SQLManager();
                break;
            default:
                $this->manager = new YAMLManager();
                break;
        }

        //Init DB
        if($this->manager instanceof SQLManager){
            $this->manager::init();
        }

        //Commands
        $this->getServer()->getCommandMap()->registerAll('back', [
            new Commands\BackCommand($this)
        ]);

        //Events
        $this->getServer()->getPluginManager()->registerEvents(new Events\BackEvent($this), $this);

    }

    /**
     * @return void
     */
    public function onDisable(): void
    {
        $this->getLogger()->info(Config::get('plugin_disabled'));
        SQLManager::close();
    }

    /**
     * @return static
     */
    public static function getInstance(): self {
        return self::$i;
    }
}