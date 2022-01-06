<?php

namespace BackSystem;


use SQLite3;

class SQLManager {

    /**
     * @var string
     */
    private static string $driver;

    /**
     * @return SQLite3|\MySQLi
     */
    private static function getDB(): SQLite3|\MySQLi
    {
        $db = null;
        switch(strtolower(Config::get('driver'))){
            case 'sqlite3':
                self::$driver = "sqlite3";
                $db = new SQLite3(Back::getInstance()->getDataFolder() . 'back.sqlite3');
                break;
            case 'mysql':
                self::$driver = "mysqli";
                $db = new \MySQLi(Config::get('mysql_host'), Config::get('mysql_user'), Config::get('mysql_password'), Config::get('mysql_database'));
                break;
            default:
                self::$driver = "sqlite3";
                $db = new SQLite3(Back::getInstance()->getDataFolder() . 'back.sqlite3');
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
        self::sqliteclose();

        return is_array(self::fetch($req));
    }

    /**
     * @param string $playeruuid
     * @return array|false|null
     */
    public static function getBackCoordinates(string $playeruuid): array|false|null {
        $db = self::getDB();

        $req = $db->query("SELECT posX, posY, posZ FROM back WHERE player_uuid='$playeruuid'");
        self::sqliteclose();
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
        self::sqliteclose();
    }

    /**
     * @param string $player_uuid
     * @return void
     */
    public static function removeBackCoordinates(string $player_uuid): void{
        $db = self::getDB();

        $db->query("DELETE FROM back WHERE player_uuid='$player_uuid'");
        self::sqliteclose();
    }

    /**
     * @return void
     */
    public static function close(): void {
        self::getDB()->close();
    }

    /**
     * @param \SQLite3Result|\mysqli_result $req
     * @return array|false|null
     */
    private static function fetch(\SQLite3Result|\mysqli_result $req): array|null|false {
        if(self::$driver === "sqlite3"){
            return $req->fetchArray();
        }elseif(self::$driver === "mysql") {
            return $req->fetch_array();
        }
        return null;
    }

    /**
     * @return void
     */
    private static function sqliteclose()
    {
        if(self::$driver === "sqlite3") self::getDB()->close();
    }
}