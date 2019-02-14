<?php

class matleader_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function get_matleaders(){
			$query = $this->db->query("
										SELECT
											t1.*, t2.province_name,
											t3.municipality_name
										FROM
											tbl_matleader t1
										LEFT JOIN tbl_provinces t2 ON t1.provinceid = t2. ID
										LEFT JOIN tbl_municipality t3 ON t1.municipality_id = t3. ID
										ORDER BY
										CASE WHEN lower(t1.designation) LIKE lower('%cat leader%') THEN 1
										WHEN lower(t1.designation) LIKE lower('%mat leader%') THEN 2
										WHEN lower(t1.designation) LIKE lower('%asst. mat leader%') THEN 3
										END ASC,
										t1.provinceid ASC, t1.municipality_id ASC

				");
			return $query->result_array();
		}

		public function get_pats(){
			$query = $this->db->query("
										SELECT
											t1.*, t2.province_name
										FROM
											tbl_pats t1
										LEFT JOIN tbl_provinces t2 ON t1.provinceid = t2. ID
										ORDER BY
											CASE
										WHEN LOWER (t1.designation) LIKE LOWER ('%pat leader%') THEN
											1
										END ASC,
										 t1.provinceid ASC
				");
			return $query->result_array();
		}

		public function get_ldrrmos(){
			$query = $this->db->query("
										SELECT
											t1.*, t2.province_name, t3.municipality_name
										FROM
											tbl_ldrrmo t1
										LEFT JOIN tbl_provinces t2 ON t1.provinceid = t2. ID
										LEFt JOIN tbl_municipality t3 ON t1.municipality_id = t3.id
										ORDER BY
										 t1.provinceid ASC, t1.municipality_id ASC
				");
			return $query->result_array();
		}

		public function get_matmembers(){
			$query = $this->db->query("
					SELECT t1.*, t2.province_name, t3.municipality_name FROM tbl_matleader t1 LEFT JOIN tbl_provinces t2 ON t1.provinceid = t2.id
					LEFT JOIN tbl_municipality t3 on t1.municipalityid = t3.id WHERE isleader = 'f' ORDER BY t1.id ASC
				");
			return $query->result_array();
		}

		public function insert_matleaders($data){
			$query = $this->db->insert('tbl_matleader', $data);

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		public function get_matleaderinfos($data){

			$query = $this->db->query(
					"SELECT * FROM tbl_matleader WHERE id = $data"
				);	
			return $query->result_array();
			
		}

		function update_matleaders($id,$data){
			$query = $this->db->where('id', $id);
			$query = $this->db->update('tbl_matleader', $data);

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		function delete_matleaders($id){
			$query = $this->db->where('id', $id);
			$query = $this->db->delete('tbl_matleader');

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

}