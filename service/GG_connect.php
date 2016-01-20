<?php
    /**
     * GG_connect.php
     *
     * File to handle all connections to the database.
     *
     * @category   GoldenGarbageServer
     * @package    com.spectrum.ecoapp.goldengabage
     * @author     Arreglo, Charlie Ahl F. <arreglo.charlieahl@live.com>
     * @copyright  Team Spectrum
     * @version    1.1.0.1
     */

    class DB_Connect {

        function __construct() {  
        }

        function __destruct() {
        }
     
        public function connect() {
            require_once __DIR__ . '/GG_config.php';
            $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
            mysql_select_db(DB_DATABASE) or die(mysql_error());
            return $con;
        }
     
        public function close() {
            mysql_close();
        }
    }
?>