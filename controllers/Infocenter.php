<?php
class Infocenter extends CI_Controller{
	public function __construct()
	{
		parent:: __construct();
		$e_id = 1;
		$this->load->model('Infocenter_m');
	}

	public function event_display()
	{
		$e_id = $this->uri->segment(3);
		$data['query']=$this->Infocenter_m->get_e($e_id);//gets info for abt
		$data['eschedule']=$this->Infocenter_m->get_eschedule($e_id);//gets info of schedule
		$data['efaq']=$this->Infocenter_m->get_efaq($e_id);
		$data['evenue']=$this->Infocenter_m->get_evenue($e_id);
		$data['eorganiser']=$this->Infocenter_m->get_eorganiser($e_id);

		foreach($data['query'] as $p){$data['event_name']=$p->ae_name;}
		$this->load->view("infocenter/infocenter_header",$data);
		$this->load->view("infocenter/infocenter_event",$data);
		//$query = $this->db->get("info");
	}

}
?>
