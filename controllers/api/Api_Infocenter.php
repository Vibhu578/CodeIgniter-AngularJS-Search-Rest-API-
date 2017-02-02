<?php class Api_Infocenter extends CI_Controller{

  public function __construct()
  {
    parent:: __construct();
    $this->load->model('Infocenter_m');
  }

  public function get_searchKeys()
  {
    //$searchKeys = $this->uri->segment(3);
     $queryString = $this->input->server('QUERY_STRING');
		 $searchParams = explode("&",$queryString);
		 $noParams = sizeof($searchParams);
		 //$dataa = array();
		 if($noParams == 4){
		  $dataa['stype'] = explode("=",$searchParams[0])[1];
		  $dataa['sloc'] = explode("=",$searchParams[1])[1];
      $dataa['sdate'] = explode("=",$searchParams[2])[1];
      $dataa['skey'] = explode("=",$searchParams[3])[1];
	   }

    $searchedData =$this->Infocenter_m->get_SearchedData($dataa);
    $apiData = json_encode($searchedData);
    print $apiData;
  }

}

?>
