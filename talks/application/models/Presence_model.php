<?php
class Presence_model extends CI_Model
{
	private $table_event = 'cci_talks';
	private $table_member = 'member';
	public $id;
	public $name;
	public $nim;
	public $date_time;
	
	public $labels = [];
	
	public function __construct()
	{
		parent::__construct();
		$this->labels = $this->_attributeLabels();
		
		$this->load->database();
	}
	
	public function Is_registered()
	{
		$sql=sprintf("SELECT * FROM %s WHERE nim = %s LIMIT 1",
						$this->table_member,
						$this->nim
					);
		$sql_result=$this->db->query($sql);
		
		return (empty($sql_result->result()) !== True);
	}
	
	public function Get_data()
	{
		$sql=sprintf("SELECT * FROM %s WHERE nim = %s LIMIT 1",
						$this->table_member,
						$this->nim
					);
		$sql_result=$this->db->query($sql);
		return $sql_result->result();
	}
	
	public function Get_new_data()
	{
		error_reporting(0);
		
		$request = array(
			'http'=>array(
				'method'=>'POST',
				'content'=>http_build_query(array(
					'term'=>$this->nim,
					'unnamed'=>'sisfo'
					)
				),
			)
		);
		$context = stream_context_create($request);
		$html = file_get_contents('https://igracias.telkomuniversity.ac.id/libraries/ajax/ajax.dashboard.php?act=messagereceiver', false, $context);	
		$user1=json_decode($html)[0];
		$user2=json_decode($html)[1];
		if(strpos($user1->title,'PARENTS') !== False)
		{
			$id=explode(" - ",$user2->title);
		}
		else
		{
			$id=explode(" - ",$user1->title);
		}
		$result=array(
			'name'=>ucwords(strtolower($id[1]))
		);
		return $result;
	}
	
	public function Is_not_presenced()
	{
		$sql= sprintf("SELECT nim FROM %s WHERE id = '%s' LIMIT 1",
						$this->table_event,
						$this->id
					);
		$sql_result=$this->db->query($sql);
		return empty($sql_result->result());
	}
	
	public function Set_presence()
	{
		$sql = sprintf("INSERT INTO %s VALUES('%s','%s','%s','%s','%s','%s')",
						$this->table_event,
						$this->id,
						$this->name,
						$this->nim,
						$this->division,
						$this->date_time,
						$this->ip
					);
		$this->db->query($sql);
	}
	
	private function _attributeLabels()
	{
		return [
					'uname'=>'Username',
					'pwd'=>'Password',
				];
	}
}