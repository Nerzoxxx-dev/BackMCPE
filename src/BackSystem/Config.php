<?php

namespace BackSystem;


class Config {

    /**
     * @param string $k
     * @return string|array
     */
    public static function get(string $k): string|array {
        $config = Back::getInstance()->getConfig();

        if(!$config->exists($k)) {
            Back::getInstance()->getLogger()->alert($k . ' config key doesn\'t exists.');
            return 'not_found';
        }
        if(is_string($config->get($k))) {
            if (str_contains($config->get($k), '{prefix}')) {
                $result = str_replace('{prefix}', $config->get('prefix'), $config->get($k));
            } else {
                $result = $config->get($k);
            }
        }else {
            $result = $config->get($k);
        }
        return $result;
    }
}