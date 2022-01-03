<?php

namespace BackSystem;


class Manager {

    /**
     * @var string
     */
    private static string $driver;

    /**
     * @return \SQLite3|\MySQLi
     */
    private static function getDB(): \SQLite3|\MySQLi
    {
        $db = null;
        switch(strtolower(Config::get('driver'))){
            case 'sqlite3':
                self::$driver = "sqlite3";
                $db = new \SQLite3(Back::getInstance()->getDataFolder() . 'back.sqlite3');
                break;
            case 'mysql':
                self::$driver = "mysqli";
                $db = new \MySQLi(Config::get('mysql_host'), Config::get('mysql_user'), Config::get('mysql_password'), Config::get('mysql_database'));
                break;
            default:
                self::$driver = "sqlite3";
                $db = new \SQLite3(Back::getInstance()->getDataFolder() . 'back.sqlite3');
        }
        return $db;
    }

    /**
     * @return void
     */
    public static function init(): void {
        $db = self::getDB();
        $db->query("CREATE TABLE IF NOT EXISTS back(player_uuid TEXT, posX FLOAT, posY FLOAT, posZ FLOAT)");
    }

    /**
     * @param string $playeruuid
     * @return bool
     */
    public static function hasBackCoordinates(string $playeruuid): bool{
        $db = self::getDB();

        $req = $db->query("SELECT * FROM back WHERE player_uuid='$playeruuid'");
        $arr = self::fetch($req);

        return !is_null($arr);
    }

    public static function getBackCoordinates(string $playeruuid): array {
        $db = self::getDB();

        $req = $db->query("SELECT posX, posY, posZ FROM back WHERE player_uuid='$playeruuid'");
        return self::fetch($req);
    }

    /**
     * @param string $playeruuid
     * @param float $posX
     * @param float $posY
     * @param float $posZ
     * @return void
     */
    public static function setBackCoordinates(string $playeruuid, float $posX, float $posY, float $posZ): void{
        $db = self::getDB();

        if(self::hasBackCoordinates($playeruuid)) {
            $db->query("UPDATE back SET posX=$posX, posY=$posY, posZ=$posZ WHERE player_uuid='$playeruuid'");
        }else {
            $db->query("INSERT INTO back(player_uuid, posX, posY, posZ) VALUES ('$playeruuid', $posX, $posY, $posZ)");
        }
    }

    /**
     * @param string $player_uuid
     * @return void
     */
    public static function removeBackCoordinates(string $player_uuid): void{
        $db = self::getDB();

        $db->query("DELETE FROM back WHERE player_uuid='$player_uuid'");
    }

    /**
     * @return void
     */
    public static function close(): void {
        self::getDB()->close();
    }

    private static function fetch(\SQLite3Result|\mysqli_result $req): array|null {
        if(self::$driver === "sqlite3"){
            return is_array($req->fetchArray()) ? $req->fetchArray() : null;
        }elseif(self::$driver === "mysqli"){
            return $req->fetch_array();
        }
        return null;
    }
}