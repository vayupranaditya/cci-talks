<?php
class Welcome extends CI_Controller{
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
		if((isset($_POST['nim'])) && ($this->input->post('nim')!==''))
		{
			$this->model->nim=$this->input->post('nim');
			
			if($this->model->Is_registered())
			{
				$identity=$this->model->Get_data();
				$identity=$identity[0];
				
				$this->model->name=$identity->nama;
				
				$info=array(
					'info'=>ucwords($this->model->name),
					'nim'=>$this->model->nim
				);
					
				$this->load->view('beginning');
				$this->load->view('check_name',array('model'=>$info));
				$this->load->view('ending');
			}
			else
			{
				//wrong student id
				$identity=$this->model->Get_new_data();
				if($identity['name']!=='')
				{
					$this->model->name=$identity['name'];
					
					$info=array(
						'info'=>$this->model->name,
						'nim'=>$this->model->nim
					);
					
					$this->load->view('beginning');
					$this->load->view('check_name',array('model'=>$info));
					$this->load->view('ending');
				}
				else
				{
					$info=array(
						'info'=>'Student ID not found');
					
					$this->load->view('beginning');
					$this->load->view('input_id',array('model'=>$info));
					$this->load->view('ending');
				}
			}
		}
		else
		{
			//first call
			$info=array(
				'info'=>'');
			
			$this->load->view('beginning');
			$this->load->view('input_id',array('model'=>$info));
			$this->load->view('ending');
		}
	}
}