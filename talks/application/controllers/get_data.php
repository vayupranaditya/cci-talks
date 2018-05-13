<?php
class Presence extends CI_Controller{
	public $model = NULL;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Presence_model');
		$this->model = $this->Presence_model;
	}
	
	public function index()
	{
		if((isset($_GET['username'])) && isset($_GET['password']))
		{
			$uname=$_GET['username'];
			$pwd=$_GET['password'];
			
			$result;
			
			$result=file_get_contents(
					"https://dashboard.telkomuniversity.ac.id/Modul/apimobile/login/login.php?username={$uname}&&password={$pwd}");
			if ($result!=='[null]')
			{
				$result = json_decode($result);
				date_default_timezone_set('Asia/Jakarta');
				
				$this->model->id=$result[0]->nim.date('dmyHi');
				$this->model->name=ucwords(strtolower($result[0]->name));
				$this->model->nim=$result[0]->nim;
				$this->model->date_time=date('d-m-y-H-i');
				
				$this->model->Set_presence();
				
				echo "{$name} dengan NIM {$nim} sudah tercatat pada {$time} <br>";
				echo "id anda: {$nim}{$idtime}";
				
			}
			else
			{
				echo "username/password salah";
			}
		}
	}
	
}