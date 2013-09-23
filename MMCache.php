<?php
/*
/
/ @class: MMCache
/ @desc: easy management of PHP Memcache
/ @author: Heiko Ramaker, www.web-skripte.de
/ @version: beta 1
/ @date: 2008/08/02
/
*/
class MMCache {

    // default lifetime in seconds: 14 days
    const DEFAULT_LIFETIME = 1209600;
    // connection port (normally 12111)
    const DEFAULT_PORT = 11211; 
    // default memcache host
    const DEFAULT_HOST = '127.0.0.1';
    // use persistant memcache connections
    const USE_PCONNECT = FALSE; 
    // enable automatic compression of large values (needs the zlib)
    const USE_AUTOMATIC_ZLIB = FALSE; 
    // automatic compression on values larger than 20000 bytes
    const AUTOMATIC_ZLIB_SIZE = 20000; 
    // compression ratio (between 0 and 1), 0.5 means 50%
    const AUTOMATIC_ZLIB_COMPRESSION = 0.4;
    // Use compression EVER on EACH value
    const USE_ZLIB = TRUE; 

    
    public $memcache; // placeholder

    /*
    / automatic connect to memcache-server
    */
    public function __construct(&$conf_arr = null) {

        $this->memcache = new Memcache;
        $conf = $this->checkConfig(&$conf_arr);

        if(self::USE_PCONNECT === TRUE) {
            $this->memcache->pconnect($conf['Host'], $conf['Port']);
        } else {
            $this->memcache->connect($conf['Host'], $conf['Port']);
        }

        if(self::USE_AUTOMATIC_ZLIB === TRUE) {
            $$this->memcache->setCompressThreshold(self::AUTOMATIC_ZLIB_SIZE, self::AUTOMATIC_ZLIB_COMPRESSION);
        }
    }

    /*
    / check $conf_arr array if connection-data is complete
    */
    private function checkConfig(&$conf_arr = null) {

        if(!is_array($conf_arr)) {
            $conf_arr = (array)$cong_arr;
        }

        if(empty($conf_arr['Host'])) {
            $host = self::DEFAULT_HOST;
        } else {
          $host = $conf_arr['Host'];
        }
        if(empty($conf_arr['Port'])) {
            $port = self::DEFAULT_PORT;
        } else {
          $port = $conf_arr['Port'];
        }
        if(empty($conf_arr['Lifetime'])) {
            $lifetime = self::DEFAULT_LIFETIME;
        } else {
          $lifetime = $conf_arr['Lifetime'];
        }

        $conf_arr = array('Host' => $host, 'Port' => $port, 'Lifetime' => $lifetime);

        return $conf_arr;

    }

    /*
    / get a value by its key from the memcache server
    */
    public function load($key) {

        $result = array();

        if(!is_array($key)) {
            $key = (array)$key;
        }

        // memcache only handles keys with max length of 250
        if(strlen($key) > 250) {
            $key = md5($key);
        }

        $result = $this->memcache->get($key);
        var_dump($result);
        if($result === FALSE) {
            return FALSE;
        } else {
            if(!is_array($result)) {
                $result = (array)$result;
            }
            return $result;
        }

    }

    /*
    / save values as an array by given key
    */
    public function save($key, $val, $compression = null, $lifetime = null) {

        if(is_null($compression)) {
            $compression = self::USE_ZLIB;
        }
        if(is_null($lifetime)) {
            $lifetime = self::DEFAULT_LIFETIME;
        }

        if(!is_array($val)) {
            $val = (array)$val;
        }

        // memcache only handles keys with max length of 250
        if(strlen($key) > 250) {
            $key = md5($key);
        }

        if( $this->memcache->set($key, $val, $compression, $lifetime) === TRUE ) {
            return TRUE;
        }

        return FALSE;

    }

    /*
    / delete memcache-object by key. key could be either string oder array
    */
    public function remove($key, $time = null) {

        if(!is_array($key)) {
            $key = (array)$key;
        }

        $time = (int)$time; // delete delayed

        foreach($key as $num) {
            $this->memcache->delete($num, $time);
        }

    }

    /*
    / get memcache stats
    */
    public function getStats() {
        return $this->memcache->getExtendedStats();
    }


    public function __destruct() {
        $this->memcache->close();
    }

}
?>