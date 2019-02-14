<?php

	class mswd_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function send_sms($number,$body){

			$con = mysqli_connect("172.26.158.250",'drr_sms','disasteraction','sms_server');

			$tquery = mysqli_query($con,"INSERT INTO Messages (Body, ToAddress, DirectionID, TypeID, StatusID, CustomField2) VALUES ('$body', '$number', 2, 1, 1,'DRRROU')");

		}

		public function get_region(){

			$query = $this->db->order_by('id');
			$query = $this->db->get('tbl_regions');
			return $query->result_array();
		}

		public function get_province_per_region($id){

			$query = $this->db->where('region_psgc',$id);
			$query = $this->db->order_by('id');
			$query = $this->db->get('lib_provinces');
			return $query->result_array();
		}

		public function get_region_per_session(){

			$query = $this->db->order_by('id');
			$query = $this->db->get('tbl_regions');

			return $query->result_array();

		}

		public function get_province_per_session(){

			session_start();

			if($_SESSION['user_level_access'] == 'national'){

				$regionid = $_SESSION['regionid'];

				$query = $this->db->order_by('id');
				$query = $this->db->get('lib_provinces');

				$data['province'] = $query->result_array();

				$query1 = $this->db->order_by('id');
				$query1 = $this->db->get('lib_provinces');

				$data['province_all'] = $query1->result_array();

				$query2 = $this->db->order_by('id');
				$query2 = $this->db->get('lib_municipality');

				$data['muni_all'] = $query2->result_array();

				return $data;

			}else if($_SESSION['user_level_access'] == 'region'){

				$regionid = $_SESSION['regionid'];

				$query = $this->db->where('region_psgc',$regionid);
				$query = $this->db->order_by('id');
				$query = $this->db->get('lib_provinces');

				$data['province'] = $query->result_array();

				$query1 = $this->db->order_by('id');
				$query1 = $this->db->get('lib_provinces');

				$data['province_all'] = $query1->result_array();

				$query2 = $this->db->order_by('id');
				$query2 = $this->db->get('lib_municipality');

				$data['muni_all'] = $query2->result_array();

				return $data;

			}else if($_SESSION['user_level_access'] == 'province'){

				$provinceid = $_SESSION['provinceid'];

				$query = $this->db->where('id',$provinceid);
				$query = $this->db->get('lib_provinces');

				$data['province'] = $query->result_array();

				$query0 = $this->db->where('provinceid',$provinceid);
				$query0 = $this->db->order_by('id');
				$query0 = $this->db->get('lib_municipality');

				$data['muni'] = $query0->result_array();

				$query1 = $this->db->order_by('id');
				$query1 = $this->db->get('lib_provinces');

				$data['province_all'] = $query1->result_array();

				$query2 = $this->db->where('provinceid',$provinceid);
				$query2 = $this->db->order_by('id');
				$query2 = $this->db->get('lib_municipality');

				$data['muni_all'] = $query2->result_array();

				return $data;

			}else if($_SESSION['user_level_access'] == 'municipality'){

				$provinceid = $_SESSION['provinceid'];
				$municipality_id = $_SESSION['municipality_id'];

				$query = $this->db->where('id',$provinceid);
				$query = $this->db->get('lib_provinces');

				$data['province'] = $query->result_array();

				$query1 = $this->db->where('id',$municipality_id);
				$query1 = $this->db->get('lib_municipality');

				$data['muni'] = $query1->result_array();

				$query2 = $this->db->order_by('id');
				$query2 = $this->db->get('lib_provinces');

				$data['province_all'] = $query2->result_array();

				$query3 = $this->db->where('provinceid',$provinceid);
				$query3 = $this->db->order_by('id');
				$query3 = $this->db->get('lib_municipality');

				$data['muni_all'] = $query3->result_array();

				return $data;

			}

		}

		public function get_provinces(){

			$query = $this->db->get('tbl_provinces');
			return $query->result_array();
		}

		public function get_municipality_per_region(){
			$query = $this->db->query('SELECT * FROM lib_municipality t1 ORDER BY t1.ID ASC');
			return $query->result_array();
		}

		public function get_munics(){
			$query = $this->db->query('SELECT * FROM lib_municipality t1 ORDER BY t1.ID ASC');
			return $query->result_array();
		}

		public function insert_mswdos($data){
			$query = $this->db->insert('tbl_mswd', $data);

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		public function get_mswdos(){
			$query = $this->db->query(
					"SELECT t1.*,t2.province_name, t3.municipality_name FROM tbl_mswd t1 LEFT JOIN tbl_provinces t2 ON t1.province_id = t2.id
					LEFT JOIN tbl_municipality t3 on t1.municipality_id = t3.id"
				);
			return $query->result_array();
		}

		public function get_mswdosinfo($data){
			$query = $this->db->query(
					"SELECT * FROM tbl_mswd WHERE id = $data"
				);	
			return $query->result_array();
		}

		function update_mswd($id,$data){
			$query = $this->db->where('id', $id);
			$query = $this->db->update('tbl_mswd', $data);

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		function delete_mswdo($id){
			$query = $this->db->where('id', $id);
			$query = $this->db->delete('tbl_mswd');

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

	}