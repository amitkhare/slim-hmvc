<?php
namespace AmitKhare\SlimHMVC;

class baseModel {

    protected $c;
    protected $db;
    protected $dbSettings;
    protected $tableName = "UPDATE_IN_CHILD_MODELS";

    public function __construct($c)  {
        $this->c = $c;
        if(isset($c->db)){
            $this->db = $c->db;
        } else {
            $this->dbSettings  = ($c->get('settings')['db']) ? $c->get('settings')['db'] : false;
            $this->db = $this->_getDB($this->dbSettings);
        }
    }

     private function _getDB($settings) {
        if(!defined('DB_HOST')){
            define( 'DB_HOST', $settings['hostname'] ); // set database host
        }
        if(!defined('DB_USER')){
            define( 'DB_USER', $settings['username'] ); // set database user
        }
        if(!defined('DB_PASS')){
            define( 'DB_PASS', $settings['password'] ); // set database password
        }
        if(!defined('DB_NAME')){
            define( 'DB_NAME', $settings['dbname'] ); // set database name
        }
        if(!defined('SEND_ERRORS_TO')){
            define( 'SEND_ERRORS_TO', 'amit@khare.co.in' ); //set email notification email address
        }
        if(!defined('DISPLAY_DEBUG')){
            define( 'DISPLAY_DEBUG', true ); //display db errors?
        }
        $database = \DB::getInstance();
        return $database;
    }

    function _findAll() {
        $query = "SELECT * FROM $this->tableName";
        $results = $this->db->get_results( $query );
        if($results){
            return $results;
        }
    }

    public function _findOne ($id,$key =  "`id` = "){
        $id = $this->db->filter( $id );
        $query = "SELECT * FROM $this->tableName WHERE  $key $id LIMIT 1;";
        $result = $this->db->get_results( $query ,true);
        if($result){
            return $result[0];
        }
    }

    public function _store ($data){
        $data = $this->db->filter( $data );
        if($this->db->insert( $this->tableName, $data )){
            return $this->db->lastid();
        };
    }

    public function _update ($id, $data){
        if (count($this->findOne($id))==1){
            $data = $this->db->filter( $data );
            $update_where = array( 'id' => $id );
            if($this->db->update( $this->tableName, $data, $update_where, 1 )){
                return true;
            };
        }
        return false;
    }

    public function _delete ($id){
        if (count($this->findOne($id))>=1){
            $where = array( "`id`" => $id );
            if($this->db->delete( $this->tableName, $where, 1 )){
                return true;
            }
        }
        return false;
    }

}