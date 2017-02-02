<?php
	class Infocenter_m extends CI_Model {

	private $taschId;
	private $taeId;
	private $db_infocenter;
	public function __construct()
	{
		parent:: __construct(); // calls constructor of parent class CI_Controller
		$this->taschId = null;
		$this->taeId = null;
		$this->db_infocenter = $this->load->database('infocenterDB', TRUE);
	}

	public function get_SearchedData($dataa)
	{
		// part of sub query for title name and description body
		$descQuery = $nameQuery = $mulDescKeys = "";
		if(strpos($dataa['skey'],"+") > 0){
			$mulDescKeys = explode("+",$dataa['skey']);
			for($i = 0; $i < count($mulDescKeys); $i++){
					$nameQuery = $nameQuery." t1.ae_name LIKE '%".$mulDescKeys[$i]."%' OR";
			}
			for($i = 0; $i < count($mulDescKeys); $i++){
					$descQuery = $descQuery."OR t1.ae_description LIKE '%".$mulDescKeys[$i]."%' ";
			}
			$nameDescQ = "(".$nameQuery."".$descQuery.")";
			$nameDescQ = str_replace("OROR","OR",$nameDescQ); // part of sub query for name and description for single word
	   }
	   else
		 {
		 $nameQuery = "t1.ae_name LIKE '%".$dataa['skey']."%' OR ";
		 $descQuery = "t1.ae_description LIKE '%".$dataa['skey']."%'";
		 $nameDescQ = "(".$nameQuery."".$descQuery.")"; // part of sub query for name and description for mutlti words
	 	}
	 // part of sub query for location including venue, city and state
	 $locQuery = $lcQuery = $lvQuery = $lsQuery = $mulLocs = "";
	 if(strpos($dataa['sloc'],"+") > 0){
		 $mulLocs = explode("+",$dataa['sloc']);
		 for($i = 0; $i < count($mulLocs); $i++){
				 $lcQuery = $lcQuery." t2.ae_v_city LIKE '%".$mulLocs[$i]."%' OR";
		 }
		 for($i = 0; $i < count($mulLocs); $i++){
				 $lvQuery = $lvQuery."OR t2.ae_v_name LIKE '%".$mulLocs[$i]."%'";
		 }
		 for($i = 0; $i < count($mulLocs); $i++){
				 $lsQuery = $lsQuery."OR t2.ae_v_state LIKE '%".$mulLocs[$i]."%'";
		 }
		 //$lsQuery = substr($lsQuery,0,-2); // this is to remove last  'OR'
		 $locQuery = "(".$lcQuery."".$lvQuery."".$lsQuery.")";
		 $locQuery = str_replace("OROR","OR",$locQuery);
  	 }
	  else
		{
		$locQuery = "(t2.ae_v_city LIKE '%".$dataa['sloc']."%' OR
								 t2.ae_v_name LIKE '%".$dataa['sloc']."%' OR
								 t2.ae_v_state LIKE '%".$dataa['sloc']."%')";
		}
		// part of sub query for type
		$typeQuery = "t1.ae_type = '".$dataa['stype']."'";

		// part of sub query for date
		$dateQuery = "t1.ae_startdate = '".$dataa['sdate']."'";

	 //Set the subquery for combination of all possible searches as given below :
	 // 1. type & loc & keys , 2. type & loc , 3. loc & keys , 4. keys & type  and 5.,6.,7. either one of them
	 $skeyParam = empty($dataa['skey']);
	 $slocParam = empty($dataa['sloc']);
	 $stypeParam = empty($dataa['stype']);
	 $sdateParam = empty($dataa['sdate']);

	 //1. type & loc & keys & date
	 if(!$skeyParam AND !$slocParam AND !$stypeParam AND !$sdateParam){
		 $subQuery = "".$nameDescQ." AND ".$typeQuery." AND ".$locQuery." AND ".$dateQuery."";
	 }
	 //2. type & loc
	 elseif($skeyParam AND !$slocParam AND !$stypeParam AND $sdateParam){
		 $subQuery = "".$locQuery." AND ".$typeQuery."";
	 }
	 //3. loc & keys
	 elseif(!$skeyParam AND !$slocParam AND $stypeParam AND $sdateParam){
		 $subQuery = "".$locQuery." AND ".$nameDescQ."";
	 }
	 //4. keys & type
	 elseif(!$skeyParam AND $slocParam AND !$stypeParam AND $sdateParam){
		 $subQuery = "".$nameDescQ." AND ".$typeQuery."";
	 }
	 //5. type & date
	 elseif($skeyParam AND $slocParam AND !$stypeParam AND !$sdateParam){
		 $subQuery = "".$dateQuery." AND ".$typeQuery."";
	 }
	 //6. loc & date
	 elseif($skeyParam AND !$slocParam AND $stypeParam AND !$sdateParam){
		 $subQuery = "".$locQuery." AND ".$typeQuery."";
	 }
	 //7. key & date
	 elseif(!$skeyParam AND $slocParam AND $stypeParam AND !$sdateParam){
		 $subQuery = "".$nameDescQ." AND ".$dateQuery."";
	 }
	 //8. type & loc & date
	 elseif($skeyParam AND !$slocParam AND !$stypeParam AND !$sdateParam){
		 $subQuery = "".$locQuery." AND ".$typeQuery." AND ".$dateQuery."";
	 }
	 //9. type & loc & key
	 elseif(!$skeyParam AND !$slocParam AND !$stypeParam AND $sdateParam){
		 $subQuery = "".$locQuery." AND ".$typeQuery." AND ".$nameDescQ."";
	 }
	 //10. type & date & key
	 elseif(!$skeyParam AND $slocParam AND !$stypeParam AND !$sdateParam){
		 $subQuery = "".$dateQuery." AND ".$typeQuery." AND ".$nameDescQ."";
	 }
	 //11. loc & date & key
	 elseif(!$skeyParam AND !$slocParam AND $stypeParam AND !$sdateParam){
		 $subQuery = "".$dateQuery." AND ".$locQuery." AND ".$nameDescQ."";
	 }
	 //12. only loc
	 elseif($skeyParam AND !$slocParam AND $stypeParam AND $sdateParam){
		 $subQuery = $locQuery;
	 }
	 //13. only type
	 elseif($skeyParam AND $slocParam AND !$stypeParam AND $sdateParam){
		 $subQuery = $typeQuery;
	 }
	 //14. only skeys
	elseif(!$skeyParam AND $slocParam AND $stypeParam AND $sdateParam){
		$subQuery = $nameDescQ;
	}
	//15. only sdate
	elseif($skeyParam AND $slocParam AND $stypeParam AND !$sdateParam){
		$subQuery = $dateQuery;
	}
	
		$query = $this->db_infocenter->select('t1.*,t2.ae_v_name,t2.ae_v_city,t2.ae_v_state')
		->from('tbl_activity_events as t1')
		->join('tbl_ae_venue as t2', 't1.ae_id = t2.ae_id', 'LEFT')
		->where($subQuery)->get();
		return $query->result();
	}

}
?>
