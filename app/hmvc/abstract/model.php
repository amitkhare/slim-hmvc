<?php
namespace AmitKhareSlimHMVC;

class Model {
	protected $c;
	protected $db;
	protected $tableName = "UPDATE_IN_CHILD_MODELS";
	public function __construct($c)  {
		$this->c = $c;
		$this->db = $this->c->db;
	}
	function findAll() {
		$query = "SELECT * FROM $this->tableName";
		$results = $this->db->get_results( $query );
		if($results){
			return $results;
		}
	}

	function findOne ($id,$key =  "`id` = "){
		$id = $this->db->filter( $id );
		$query = "SELECT * FROM $this->tableName WHERE  $key $id LIMIT 1;";
		$result = $this->db->get_results( $query ,true);
		if($result){
			return $result;
		}
	}

	function store ($data){
		$data = $this->db->filter( $data );
		if($this->db->insert( $this->tableName, $data )){
			return $this->db->lastid();
		};
	}

	function update ($id, $data){
		if (count($this->findOne($id))==1){
			$data = $this->db->filter( $data );
			$update_where = array( 'id' => $id );
			if($this->db->update( $this->tableName, $data, $update_where, 1 )){
				return true;
			};
		}
		$this->c->logger->info("loader '/model/update' record update faild. id is".$id);
		return false;
	}

	function delete ($id){
		if (count($this->findOne($id))>=1){
			$where = array( "`id`" => $id );
			if($this->db->delete( $this->tableName, $where, 1 )){
				return true;
			}
		}
		$this->c->logger->info("loader '/model/delete' record not found. id is".$id);
		return false;
	}

}