<?php
namespace AmitKhare\SlimHMVC;

class baseModel {

    protected $c;
    protected $db;
    protected $tableName = "UPDATE_IN_CHILD_MODELS";
   
    public function __construct($c)  {
        $this->c = $c;
        if(isset($c->db)){
            $this->db = $c->db;
        } else {
            $settings = ($c->get('settings')['db']) ? $c->get('settings')['db'] : false;
            $this->db = $this->_getDB($settings); 
        }
    }
    
    function findAll() {
        $query = "SELECT * FROM $this->tableName";
        $results = $this->db->get_results( $query );
        if($results){
            return $results;
        }
    }
    
     private function _getDB($settings) {
        
        define( 'DB_HOST', $settings['hostname'] ); // set database host
        define( 'DB_USER', $settings['username'] ); // set database user
        define( 'DB_PASS', $settings['password'] ); // set database password
        define( 'DB_NAME', $settings['dbname'] ); // set database name
        define( 'SEND_ERRORS_TO', 'amit@khare.co.in' ); //set email notification email address
        define( 'DISPLAY_DEBUG', true ); //display db errors?
        $database = \DB::getInstance();
        return $database;
    }


    public function findOne ($id,$key =  "`id` = "){
        $id = $this->db->filter( $id );
        $query = "SELECT * FROM $this->tableName WHERE  $key $id LIMIT 1;";
        $result = $this->db->get_results( $query ,true);
        if($result){
            return $result;
        }
    }

    public function store ($data){
        $data = $this->db->filter( $data );
        if($this->db->insert( $this->tableName, $data )){
            return $this->db->lastid();
        };
    }

    public function update ($id, $data){
        if (count($this->findOne($id))==1){
            $data = $this->db->filter( $data );
            $update_where = array( 'id' => $id );
            if($this->db->update( $this->tableName, $data, $update_where, 1 )){
                return true;
            };
        }
        return false;
    }

    public function delete ($id){
        if (count($this->findOne($id))>=1){
            $where = array( "`id`" => $id );
            if($this->db->delete( $this->tableName, $where, 1 )){
                return true;
            }
        }
        return false;
    }

}