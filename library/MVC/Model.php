<?php
// This class is called by all models (with "extends")
    class Model {
        
        protected $_sql;
        //protected $_ListModel = array();
        //protected $_RequeteSql;
        
        function __construct() {
            $this->_sql = new PDO('mysql:host='.confBDD::hostDefaut.';dbname='.confBDD::bddDefaut,confBDD::userDefaut,confBDD::passDefaut);
        }
	
	   public static function getInstance() {
           if (!isset(self::$instance)) {
               $c = __CLASS__;
               self::$instance = new $c;
           }
           return self::$instance;
       }
        
        function getLastInsertedId() {
            return $this->_sql->lastInsertId();
        }
    }
?>