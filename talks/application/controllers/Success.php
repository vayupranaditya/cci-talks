<?php
class Success extends CI_Controller{
	public $model = NULL;
	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Presence_model');
		$this->model = $this->Presence_model;
		$this->load->helper('form');
	}
	public function index()
	{
		if(isset($_POST['nim']))
		{
			$this->model->nim=$this->input->post('nim');
			
			if($this->model->Is_registered())
			{
				$identity=$this->model->Get_data();
				$identity=$identity[0];
				
				$this->model->id=date('dmyHi').$this->model->nim;
				$this->model->name=$identity->nama;
				$this->model->division=$identity->divisi;
			}
			else
			{
				//student id not registered
				$identity=$this->model->Get_new_data();
				
				$this->model->id=date('dmyHi').$this->model->nim;
				$this->model->name=$identity['name'];
				$this->model->division='unknown';
			}
			
			$this->model->ip=$this->input->server('REMOTE_ADDR');
			$this->model->date_time=date('y-m-d-H-i');
			
			if($this->model->Is_not_presenced())
			{
				$this->model->Set_presence();
			}
			
			
			$info=array(
				'info'=>ucwords($this->model->name));
				
			$this->load->view('beginning');
			$this->load->view('hi',array('model'=>$info));
			$this->load->view('ending');
		}
		else
		{
			header("/");
		}
	}
	
	public function haha()
	{
		echo "hahaha";
	}
}