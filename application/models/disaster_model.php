<?php

class disaster_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}


		public function new_disaster($data){
			$query = $this->db->insert('tbl_dromic',$data);

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		public function update_disaster($data){

			$datas = array(
				'disaster_name' 	=> $data['disaster_name'],
				'disaster_date' 	=> $data['disaster_date']
			);

			$query = $this->db->where('id',$data['id']);
			$query = $this->db->update('tbl_dromic',$datas);

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		public function get_disaster($username){

			$query = $this->db->query("SELECT
											t1. ID,
											t1.disaster_name,
											t1.disaster_date,
											t1.tcount,
											t1.maxid
										FROM
											(
												SELECT
													t1.*, t2.can_access_username
												FROM
													(
														SELECT
															*
														FROM
															(
																SELECT DISTINCT
																	ON (t1. ID) t1.*
																FROM
																	(
																		SELECT
																			t1.*
																		FROM
																			(
																				SELECT
																					t1. ID,
																					t1.disaster_name,
																					t1.disaster_date,
																					COALESCE (t2.tcount, 0) tcount,
																					t3. ID AS maxid
																				FROM
																					tbl_dromic t1
																				LEFT JOIN (
																					SELECT
																						t1.dromic_id,
																						COUNT (*) AS tcount
																					FROM
																						tbl_disaster_title t1
																					GROUP BY
																						t1.dromic_id
																				) t2 ON t1. ID = t2.dromic_id
																				LEFT JOIN tbl_disaster_title t3 ON t1. ID = t3.dromic_id
																				ORDER BY
																					t1.disaster_date :: DATE DESC
																			) t1
																		ORDER BY
																			t1. ID DESC,
																			t1.maxid DESC
																	) t1
																ORDER BY
																	t1. ID DESC,
																	t1.maxid DESC,
																	t1.disaster_date :: DATE DESC
															) t1
														ORDER BY
															t1.disaster_date DESC
													) t1
												RIGHT JOIN (
													SELECT
														*
													FROM
														tbl_reports_assignment
												) t2 ON t1. ID = t2.dromic_id
											) t1
										WHERE
											t1.can_access_username = '$username'
										UNION ALL
											(
												SELECT
													*
												FROM
													(
														SELECT DISTINCT
															ON (t1. ID) t1.*
														FROM
															(
																SELECT
																	t1.*
																FROM
																	(
																		SELECT
																			t1. ID,
																			t1.disaster_name,
																			t1.disaster_date,
																			COALESCE (t2.tcount, 0) tcount,
																			t3. ID AS maxid
																		FROM
																			tbl_dromic t1
																		LEFT JOIN (
																			SELECT
																				t1.dromic_id,
																				COUNT (*) AS tcount
																			FROM
																				tbl_disaster_title t1
																			GROUP BY
																				t1.dromic_id
																		) t2 ON t1. ID = t2.dromic_id
																		LEFT JOIN tbl_disaster_title t3 ON t1. ID = t3.dromic_id
																		WHERE t1.created_by_user = '$username'
																		ORDER BY
																			t1.disaster_date :: DATE DESC
																	) t1
																ORDER BY
																	t1. ID DESC,
																	t1.maxid DESC
															) t1
														ORDER BY
															t1. ID DESC,
															t1.maxid DESC,
															t1.disaster_date :: DATE DESC
													) t1
												ORDER BY
													t1.disaster_date DESC
											)

									 ");

			return $query->result_array();
			
		}

		public function get_my_disaster($username){

			$data = array();

			$rs = array();

			$provinceid 		= "";
			$municipality_id 	= "";

			$query = $this->db->query("SELECT
											*
										FROM
											(
												SELECT DISTINCT
													ON (t1. ID) t1.*
												FROM
													(
														SELECT
															t1.*
														FROM
															(
																SELECT
																	t1. ID,
																	t1.disaster_name,
																	t1.disaster_date,
																	COALESCE (t2.tcount, 0) tcount,
																	t3. ID AS maxid
																FROM
																	tbl_dromic t1
																LEFT JOIN (
																	SELECT
																		t1.dromic_id,
																		COUNT (*) AS tcount
																	FROM
																		tbl_disaster_title t1
																	GROUP BY
																		t1.dromic_id
																) t2 ON t1. ID = t2.dromic_id
																LEFT JOIN tbl_disaster_title t3 ON t1. ID = t3.dromic_id
																WHERE t1.created_by_user = '$username'
																ORDER BY
																	t1.disaster_date :: DATE DESC
															) t1
														ORDER BY
															t1. ID DESC,
															t1.maxid DESC
													) t1
												ORDER BY
													t1. ID DESC,
													t1.maxid DESC,
													t1.disaster_date :: DATE DESC
											) t1
										ORDER BY
											t1.disaster_date DESC
									 ");

			$data['disaster'] = $query->result_array();

			// if($username == 'jlompad'){

			// 	$isdswd = 't';

			// }else{

			// 	$isdswd = 'f';

			// }

			$q3 = $this->db->query("SELECT * FROM tbl_auth_user_profile WHERE username = '$username' and issuperadmin = 't'");

			if($q3->num_rows() > 0){

				$query1 = $this->db->query("SELECT
											UPPER (
												CONCAT (
													t1.firstname,
													' ',
													t1.lastname
												)
											) fullname,
											t2.province_name,
											t3.municipality_name,
											t1.agency,
											t1.designation,
											t1.username
										FROM
											tbl_auth_user_profile t1
										LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
										LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
										ORDER BY
											t1. ID"
									);


			}else{


				$q2 = $this->db->query("SELECT provinceid, municipality_id FROM tbl_auth_user_profile WHERE username = '$username'");

				$rs['prv'] = $q2->result_array();

				$provinceid 		= $rs['prv'][0]['provinceid'];
				$municipality_id 	= $rs['prv'][0]['municipality_id'];



				$query1 = $this->db->query("SELECT
												UPPER (
													CONCAT (
														t1.firstname,
														' ',
														t1.lastname
													)
												) fullname,
												t2.province_name,
												t3.municipality_name,
												t1.agency,
												t1.designation,
												t1.username
											FROM
												tbl_auth_user_profile t1
											LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
											LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
											WHERE
											t1.provinceid = '$provinceid'
											AND t1.municipality_id = '$municipality_id'
											ORDER BY
												t1. ID"
										);


			}

			

			$data['users'] = $query1->result_array();

			return $data;
			
		}

		public function get_evacuation_stats($id){

			session_start();

			$region = $_SESSION['regionid'];

			$mun_id = $_SESSION['municipality_id'];

			$user_level_access = $_SESSION['user_level_access'];

			if($user_level_access == 'national'){
				$aff_munis_drill = array();

				$query_title = $this->db->query("SELECT
												t1.*,
												t2.disaster_name,
												t2.disaster_date
											FROM
												tbl_disaster_title t1
											LEFT JOIN public.tbl_dromic t2 ON t1.dromic_id = t2. ID
											WHERE
												t1. ID = $id -- disaster_title_id
									");

				$query_brgys = $this->db->query("SELECT DISTINCT ON
													( t1.brgy_located_ec ) t1.province_id,
													t1.municipality_id,
													CONCAT ( '0', t1.brgy_located_ec ) :: INTEGER brgy_located_ec,
													t2.affected_family,
													t2.affected_persons 
												FROM
													(
													SELECT
														* 
													FROM
														(
														SELECT DISTINCT ON
															( t1.brgy_located_ec ) t1.province_id,
															municipality_id,
															CONCAT ( '0', t1.brgy_located_ec ) :: INTEGER brgy_located_ec 
														FROM
															(
															SELECT
																t0.* 
															FROM
																(
																SELECT DISTINCT ON
																	( t1.province_id, t1.municipality_id, t1.brgy_located_ec ) t1.province_id :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_located_ec :: CHARACTER VARYING 
																FROM
																	tbl_activated_ec t1
																	LEFT JOIN tbl_disaster_title t2 ON t1.dromic_id :: CHARACTER VARYING = t2.dromic_id ::
																	CHARACTER VARYING LEFT JOIN lib_provinces t3 ON t1.province_id :: CHARACTER VARYING = t3.ID :: CHARACTER VARYING 
																WHERE
																	t2.ID = '$id' 
																) t0 UNION ALL
																(
																SELECT DISTINCT ON
																	( t1.provinceid, t1.municipality_id, t1.brgy_host ) t1.provinceid :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_host :: CHARACTER VARYING 
																FROM
																	tbl_evac_outside_stats t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid :: CHARACTER VARYING = t2.ID :: CHARACTER VARYING 
																WHERE
																	t1.disaster_title_id = '$id' 
																) 
																UNION ALL
																(
																SELECT DISTINCT ON
																	( t1.provinceid, t1.municipality_id, t1.brgy_id ) t1.provinceid :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_id :: CHARACTER VARYING 
																FROM
																	tbl_damage_per_brgy t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid :: CHARACTER VARYING = t2.ID :: CHARACTER VARYING 
																WHERE
																	t1.disaster_title_id = '$id' 
																)
															) t1 
														) t1 
													ORDER BY
														t1.brgy_located_ec 
													) t1
													LEFT JOIN tbl_damage_per_brgy t2 ON t2.brgy_id = t1.brgy_located_ec
													WHERE t2.disaster_title_id = '$id'
										");

				$query = $this->db->query("SELECT
												t1. ID dromic_id,
												t3.*, t5.ec_name evacuation_names,
												t5.brgy_located_ec,
												t5.ec_cum,
												t5.ec_now,
												t5.ec_status,
												t6.region_psgc region
											FROM
												tbl_disaster_title t1
											LEFT JOIN tbl_dromic t2 ON t1.dromic_id = t2. ID
											LEFT JOIN tbl_evacuation_stats t3 ON t1. ID = t3.disaster_title_id
											LEFT JOIN lib_municipality t4 ON t3.municipality_id = t4. ID -- LEFT JOIN lib_provinces t5 ON t3.provinceid = t5. ID
											-- LEFT JOIN lib_barangay t6 ON CONCAT('0',t3.brgy_located)::integer = t6.id::integer
											LEFT JOIN tbl_activated_ec t5 ON t3.evacuation_name = t5. ID :: CHARACTER VARYING
											LEFT JOIN lib_provinces t6 ON t3.provinceid = t6. ID
											WHERE
												t1. ID = '$id' -- disaster_title_id
											ORDER BY
												t3.municipality_id ASC,
												t3.evacuation_name ASC,
												t5.brgy_located_ec ASC,
												t3.brgy_located ASC
												
										");

				$query_outec = $this->db->query("SELECT
													*,
													t2.region_psgc region
												FROM
													tbl_evac_outside_stats t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
												WHERE
													t1.disaster_title_id = '$id' -- disaster_title_id
												ORDER BY
													t1.provinceid,
													t1.municipality_id,
													t1.brgy_host
										");


					$queryecs = $this->db->query("SELECT
														t1.*,
														t3.region_psgc region
													FROM
														tbl_activated_ec t1
													LEFT JOIN tbl_disaster_title t2 ON t1.dromic_id :: CHARACTER VARYING = t2.dromic_id :: CHARACTER VARYING
													LEFT JOIN lib_provinces t3 ON t1.province_id :: CHARACTER VARYING = t3. ID :: CHARACTER VARYING
													WHERE
														t2. ID = '$id'
													ORDER BY
														t1.province_id,
														t1.municipality_id,
														t1.brgy_located_ec
											");

					$query1 = $this->db->query("SELECT DISTINCT
												ON (t1.municipality_id) t1.municipality_id ID,
												t2.municipality_name,
												t1.provinceid,
												t1.region
											FROM
												(
													SELECT DISTINCT
														ON (t1.municipality_id) t1.municipality_id,
														t1.provinceid,
														t1.region
													FROM
														(
															SELECT
																t1.municipality_id,
																t1.provinceid,
																t2.region_psgc region
															FROM
																tbl_evacuation_stats t1
															LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
															WHERE
																t1.disaster_title_id = '$id'
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_casualty_asst t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																)
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_evac_outside_stats t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																)
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_affected t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																)
														) t1
												) t1
											LEFT JOIN lib_municipality t2 ON t1.municipality_id = t2. ID
											ORDER BY
												t1.municipality_id,
												t1.provinceid
										");


				$querybrgy = $this->db->query("SELECT
													t1.*, t2.municipality_name,
													t3.province_name,
													t3.region_psgc region
												FROM
													lib_barangay t1
												LEFT JOIN lib_municipality t2 ON t1.municipality_id = t2. ID
												LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
												ORDER BY
													t1. ID
											");

				$query2 = $this->db->query("SELECT
												t5.province_name,
												t4.municipality_name,
												COALESCE (
													t6.brgy_name,
													'NOT INDICATED'
												) brgy_name,
												t1. ID dromic_id,
												t3.*,
												t5.region_psgc region
											FROM
												tbl_disaster_title t1
											LEFT JOIN tbl_dromic t2 ON t1.dromic_id = t2. ID
											LEFT JOIN tbl_evac_outside_stats t3 ON t1. ID = t3.disaster_title_id
											LEFT JOIN lib_municipality t4 ON t3.municipality_id = t4. ID
											LEFT JOIN lib_provinces t5 ON t3.provinceid = t5. ID
											LEFT JOIN lib_barangay t6 ON t3.brgy_host :: CHARACTER VARYING = t6. ID :: CHARACTER VARYING
											WHERE
												t3.disaster_title_id = '$id' -- disaster_title_id
											ORDER BY
												t3.municipality_id,
												t3.brgy_host
										");

				$query_fnfis = $this->db->query("SELECT
													t2.provinceid,
													t2.municipality_id,
													t2.disaster_title_id,
													t1.fnfi_name,
													t1.quantity,
													t1. COST,
													t1.fnfitype,
													t4.region_psgc region
												FROM
													tbl_fnfi_assistance_list t1
												LEFT JOIN tbl_fnfi_assistance t2 ON t1.fnfi_assistance_id = t2. ID
												LEFT JOIN tbl_disaster_title t3 ON t2.disaster_title_id = t3. ID
												LEFT JOIN lib_provinces t4 ON t2.provinceid = t4. ID
												WHERE
													t2.disaster_title_id = '$id'
										");

				$query_sex_gender = $this->db->query("SELECT
														t1.*, t3.brgy_located_ec,
														t4.region_psgc region
													FROM
														tbl_sex_gender_data t1
													LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id :: CHARACTER VARYING = t2. ID :: CHARACTER VARYING
													LEFT JOIN tbl_activated_ec t3 ON t1.evac_id :: CHARACTER VARYING = t3. ID :: CHARACTER VARYING
													LEFT JOIN lib_provinces t4 ON t1.province_id :: CHARACTER VARYING = t4. ID :: CHARACTER VARYING
													WHERE
														t2. ID = '$id'
										");

				$query_facilities = $this->db->query("SELECT
															t1.*, t3.brgy_located_ec,
															t4.region_psgc region
														FROM
															tbl_ec_facilities t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id :: CHARACTER VARYING = t2. ID :: CHARACTER VARYING
														LEFT JOIN tbl_activated_ec t3 ON t1.evac_id :: CHARACTER VARYING = t3. ID :: CHARACTER VARYING
														LEFT JOIN lib_provinces t4 ON t1.province_id :: CHARACTER VARYING = t4. ID :: CHARACTER VARYING
														WHERE
															t2. ID = '$id'
										");

				$masterquery = $this->db->query("SELECT
													t1.provinceid,
													t1.municipality_id,
													SUM (family_a_t) family_a_t,
													SUM (person_a_t) person_a_t,
													SUM (family_cum_i) family_cum_i,
													SUM (family_now_i) family_now_i,
													SUM (person_cum_i) person_cum_i,
													SUM (person_now_i) person_now_i,
													SUM (family_cum_o) family_cum_o,
													SUM (family_now_o) family_now_o,
													SUM (person_cum_o) person_cum_o,
													SUM (person_now_o) person_now_o,
													SUM (family_cum_s_t) family_cum_s_t,
													SUM (family_now_s_t) family_now_s_t,
													SUM (person_cum_s_t) person_cum_s_t,
													SUM (person_now_s_t) person_now_s_t,
													t2.region_psgc region
												FROM
													(
														SELECT
															t1.provinceid,
															t1.municipality_id,
															COALESCE (t1.family_cum_i, '0') + COALESCE (t1.family_cum_o, '0') family_a_t,
															COALESCE (t1.person_cum_i, '0') + COALESCE (t1.person_cum_o, '0') person_a_t,
															t1.family_cum_i,
															t1.family_now_i,
															t1.person_cum_i,
															t1.person_now_i,
															t1.family_cum_o,
															t1.family_now_o,
															t1.person_cum_o,
															t1.person_now_o,
															COALESCE (t1.family_cum_i, '0') + COALESCE (t1.family_cum_o, '0') family_cum_s_t,
															COALESCE (t1.family_now_i, '0') + COALESCE (t1.family_now_o, '0') family_now_s_t,
															COALESCE (t1.person_cum_i, '0') + COALESCE (t1.person_cum_o, '0') person_cum_s_t,
															COALESCE (t1.person_now_i, '0') + COALESCE (t1.person_now_o, '0') person_now_s_t
														FROM
															(
																SELECT
																	t1.provinceid,
																	t1.municipality_id,
																	t1.family_cum_i,
																	t1.family_now_i,
																	t1.person_cum_i,
																	t1.person_now_i,
																	t1.family_cum_o,
																	t1.family_now_o,
																	t1.person_cum_o,
																	t1.person_now_o
																FROM
																	(
																		SELECT
																			t0.*
																		FROM
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					t1.family_cum :: INTEGER family_cum_i,
																					t1.family_now :: INTEGER family_now_i,
																					t1.person_cum :: INTEGER person_cum_i,
																					t1.person_now :: INTEGER person_now_i,
																					'0' :: INTEGER family_cum_o,
																					'0' :: INTEGER family_now_o,
																					'0' :: INTEGER person_cum_o,
																					'0' :: INTEGER person_now_o
																				FROM
																					tbl_evacuation_stats t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				WHERE
																					t1.disaster_title_id = '$id'
																				ORDER BY
																					t1.municipality_id
																			) t0
																		UNION ALL
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					'0' :: INTEGER family_cum_i,
																					'0' :: INTEGER family_now_i,
																					'0' :: INTEGER person_cum_i,
																					'0' :: INTEGER person_now_i,
																					t1.family_cum :: INTEGER family_cum_o,
																					t1.family_now :: INTEGER family_now_o,
																					t1.person_cum :: INTEGER person_cum_o,
																					t1.person_now :: INTEGER person_now_o
																				FROM
																					tbl_evac_outside_stats t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				WHERE
																					t1.disaster_title_id = '$id'
																				ORDER BY
																					t1.municipality_id
																			)
																		UNION ALL
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					'0' :: INTEGER family_cum_i,
																					'0' :: INTEGER family_now_i,
																					'0' :: INTEGER person_cum_i,
																					'0' :: INTEGER person_now_i,
																					'0' :: INTEGER family_cum_o,
																					'0' :: INTEGER family_now_o,
																					'0' :: INTEGER person_cum_o,
																					'0' :: INTEGER person_now_o
																				FROM
																					tbl_casualty_asst t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				WHERE
																					t1.disaster_title_id = '$id'
																				ORDER BY
																					t1.municipality_id
																			)
																			UNION ALL
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					'0' :: INTEGER family_cum_i,
																					'0' :: INTEGER family_now_i,
																					'0' :: INTEGER person_cum_i,
																					'0' :: INTEGER person_now_i,
																					'0' :: INTEGER family_cum_o,
																					'0' :: INTEGER family_now_o,
																					'0' :: INTEGER person_cum_o,
																					'0' :: INTEGER person_now_o
																				FROM
																					tbl_affected t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id::integer = t2. ID
																				WHERE
																					t1.disaster_title_id = '$id'
																				ORDER BY
																					t1.municipality_id
																			)
																	) t1
															) t1
														ORDER BY
															t1.municipality_id
													) t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
												GROUP BY
													t2.region_psgc,
													t1.provinceid,
													t1.municipality_id
												ORDER BY
													t1.municipality_id
										");
				$masterquery2 = $this->db->query("SELECT
														t1.*, t2.region_psgc
													FROM
														(
															SELECT
																t1.provinceid,
																t1.municipality_id,
																MAX (t1.brgynum)
															FROM
																(
																	SELECT
																		*
																	FROM
																		(
																			SELECT
																				t1.provinceid,
																				t1.municipality_id,
																				COUNT (t1.brgy :: INTEGER) brgynum
																			FROM
																				(
																					SELECT
																						*
																					FROM
																						(
																							SELECT DISTINCT
																								ON (t1.brgy) t1.provinceid,
																								t1.municipality_id,
																								CONCAT ('0', t1.brgy) :: INTEGER brgy
																							FROM
																								(
																									SELECT DISTINCT
																										ON (tx.brgy) tx.provinceid,
																										tx.municipality_id,
																										CONCAT ('0', tx.brgy) :: INTEGER brgy
																									FROM
																										(
																											SELECT DISTINCT
																												tx.*
																											FROM
																												(
																													SELECT
																														t4.provinceid,
																														t4.municipality_id,
																														regexp_split_to_table(t4.brgy_located, '[\\s,]+') brgy
																													FROM
																														PUBLIC .tbl_evacuation_stats t4
																													LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																													WHERE
																														t4.disaster_title_id = $id -- disaster_title_id
																													GROUP BY
																														t4.municipality_id,
																														t4.provinceid,
																														t4.brgy_located
																													ORDER BY
																														t4.brgy_located ASC,
																														t4.municipality_id ASC
																												) tx
																											UNION ALL
																												(
																													SELECT DISTINCT
																														ON (t1.brgy) *
																													FROM
																														(
																															SELECT
																																*
																															FROM
																																(
																																	SELECT DISTINCT
																																		ON (t4.brgy_host) t4.provinceid,
																																		t4.municipality_id,
																																		t4.brgy_host brgy
																																	FROM
																																		PUBLIC .tbl_evac_outside_stats t4
																																	LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																																	WHERE
																																		t4.disaster_title_id = $id -- disaster_title_id
																																	AND t4.brgy_host <> '0'
																																	GROUP BY
																																		t4.municipality_id,
																																		t4.provinceid,
																																		t4.brgy_host
																																	ORDER BY
																																		t4.brgy_host ASC,
																																		t4.municipality_id ASC
																																) t1
																															UNION ALL
																																(
																																	SELECT DISTINCT
																																		ON (t4.brgy_origin) t4.provinceid,
																																		t4.municipality_id,
																																		t4.brgy_origin brgy
																																	FROM
																																		PUBLIC .tbl_evac_outside_stats t4
																																	LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																																	WHERE
																																		t4.disaster_title_id = $id -- disaster_title_id
																																	AND t4.brgy_origin ~ '^\d+(.\d+)?$' = TRUE
																																	GROUP BY
																																		t4.municipality_id,
																																		t4.provinceid,
																																		t4.brgy_origin
																																	ORDER BY
																																		t4.brgy_origin ASC,
																																		t4.municipality_id ASC
																																)
																														) t1
																												)
																											UNION ALL
																												(
																													SELECT
																														t1.*
																													FROM
																														(
																															SELECT DISTINCT
																																ON (t1.brgy) t1.provinceid,
																																t1.municipality_id,
																																t1.brgy
																															FROM
																																(
																																	SELECT
																																		t1.*
																																	FROM
																																		(
																																			SELECT
																																				t1.provinceid,
																																				t1.municipality_id,
																																				regexp_split_to_table(t1.brgy_id, '[\\s|]+') brgy
																																			FROM
																																				PUBLIC .tbl_casualty_asst t1
																																			WHERE
																																				t1.disaster_title_id = $id
																																		) t1
																																) t1
																															ORDER BY
																																t1.brgy
																														) t1
																													ORDER BY
																														t1.provinceid,
																														t1.municipality_id,
																														t1.brgy
																												)
																										) tx
																									ORDER BY
																										tx.brgy
																								) t1
																							ORDER BY
																								t1.brgy
																						) t1
																				) t1
																			GROUP BY
																				t1.provinceid,
																				t1.municipality_id
																		) t1
																	UNION ALL
																		(
																			SELECT
																				t2.provinceid,
																				t2.municipality_id,
																				brgy_affected brgynum
																			FROM
																				tbl_affected t2
																			WHERE
																				t2.disaster_title_id = '$id'
																		)
																) t1
															GROUP BY
																t1.provinceid,
																t1.municipality_id
														) t1
													LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
													ORDER BY
													t1.provinceid,
													t1.municipality_id

										");
				$masterquery3 = $this->db->query("SELECT
													t1.provinceid,
													t1.municipality_id,
													t4.ec_cum,
													t4.ec_now,
													t5.region_psgc region
												FROM
													PUBLIC .tbl_evacuation_stats t1
												LEFT JOIN PUBLIC .tbl_disaster_title t3 ON t1.disaster_title_id = t3. ID
												LEFT JOIN tbl_activated_ec t4 ON t1.evacuation_name :: CHARACTER VARYING = t4. ID :: CHARACTER VARYING
												LEFT JOIN lib_provinces t5 ON t1.provinceid = t5. ID
												WHERE
													t4.ec_cum = '1'
												AND t1.disaster_title_id = '$id' -- disaster_title_id
												ORDER BY
													t1.municipality_id
										");
				$query_casualty_title = $this->db->query("SELECT
															t1.*, t3.municipality_name,
															t4.region_psgc region
														FROM
															tbl_casualty_asst t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
														LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
														LEFT JOIN lib_provinces t4 ON t1.provinceid = t4. ID
														WHERE
															t2. ID = '$id' -- disaster_title_id
														ORDER BY
															t1.municipality_id
										");

				$query_casualties = $this->db->query("SELECT
														t1. ID,
														t1.disaster_title_id,
														UPPER (t1.lastname) lastname,
														UPPER (t1.firstname) firstname,
														UPPER (t1.middle_i) middle_i,
														UPPER (t1.gender) gender,
														t1.provinceid,
														t1.municipalityid,
														UPPER (t1.brgyname) brgyname,
														t1.isdead,
														t1.ismissing,
														t1.isinjured,
														UPPER (t1.remarks) remarks,
														t1.age,
														t3.municipality_name,
														t4.province_name,
														t4.region_psgc region
													FROM
														public.tbl_casualty t1
													LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
													LEFT JOIN public.lib_municipality t3 ON t1.municipalityid = t3. ID
													LEFT JOIN public.lib_provinces t4 ON t1.provinceid = t4. ID
													WHERE
														t1.disaster_title_id = $id -- disaster_title_id
													ORDER BY
														t1.provinceid,
														t1.municipalityid,
														t1.brgyname
									");

				$query_dam_per_brgy = $this->db->query("SELECT
															t1.*, t2.brgy_name, t3.region_psgc region
														FROM
															PUBLIC .tbl_damage_per_brgy t1
														LEFT JOIN PUBLIC .lib_barangay t2 ON t1.brgy_id = t2. ID
														LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
														WHERE
															t1.disaster_title_id = '$id'
														ORDER BY
															t1. ID
									");

				$query_all_affected = $this->db->query("SELECT
														t1.*
													FROM
														public.tbl_affected t1
													WHERE
														t1.disaster_title_id = '$id'
													ORDER BY t1.id
								");

				$query_all_affected = $this->db->query("SELECT
														t1.*
													FROM
														public.tbl_affected t1
													WHERE
														t1.disaster_title_id = '$id'
													ORDER BY t1.id
								");

				$query_all_munis = $this->db->query("SELECT
														COUNT (t1.municipality_id) all_munis,
														t1.iscity
													FROM
														(
															SELECT DISTINCT
																ON (t1.municipality_id) t1.*, t2.iscity
															FROM
																(
																	SELECT DISTINCT
																		(t1.municipality_id)
																	FROM
																		(
																			SELECT DISTINCT
																				(municipality_id)
																			FROM
																				tbl_evacuation_stats t1
																			LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																			WHERE
																				disaster_title_id = '$id'
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t2.municipality_id)
																					FROM
																						PUBLIC .tbl_evac_outside_stats t2
																					LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
																					WHERE
																						disaster_title_id = '$id'
																				)
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t3.municipality_id)
																					FROM
																						PUBLIC .tbl_casualty_asst t3
																					LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
																					WHERE
																						disaster_title_id = '$id'
																				)
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t3.municipality_id)
																					FROM
																						PUBLIC .tbl_affected t3
																					LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
																					WHERE
																						disaster_title_id = '$id'
																				)
																		) t1
																) t1
															LEFT JOIN PUBLIC .lib_municipality t2 ON t1.municipality_id = t2. ID
														) t1
													GROUP BY
														t1.iscity
									");

				$query_all_prov_chart = $this->db->query("SELECT
															t3. ID,
															t3.province_name,
															SUM (t1.family_cum) fam_cum
														FROM
															(
																SELECT
																	SUM (t1.family_cum :: NUMERIC) AS family_cum,
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title
																FROM
																	(
																		SELECT
																			SUM (t1.family_cum :: NUMERIC) AS family_cum,
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title
																		FROM
																			PUBLIC .tbl_evacuation_stats t1
																		LEFT JOIN PUBLIC .tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																		LEFT JOIN PUBLIC .lib_municipality t3 ON t1.municipality_id = t3. ID
																		WHERE
																			t1.disaster_title_id = $id
																		GROUP BY
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title
																		UNION ALL
																			(
																				SELECT
																					SUM (t1.family_cum :: NUMERIC) AS family_cum,
																					t1.municipality_id,
																					t3.municipality_name,
																					t2.disaster_title
																				FROM
																					PUBLIC .tbl_evac_outside_stats t1
																				LEFT JOIN PUBLIC .tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN PUBLIC .lib_municipality t3 ON t1.municipality_id = t3. ID
																				WHERE
																					t1.disaster_title_id = $id
																				GROUP BY
																					t1.municipality_id,
																					t3.municipality_name,
																					t2.disaster_title
																			)
																	) t1
																GROUP BY
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title
															) t1
														LEFT JOIN PUBLIC .lib_municipality t2 ON t1.municipality_id = t2. ID
														LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
														GROUP BY
															t3. ID,
															t3.province_name
														ORDER BY
															t3. ID
									");

				$aff_prov_chart = $query_all_prov_chart->result_array();

				$aff_prov = array();

				$pid = "";

				for ($ii=0; $ii < count($aff_prov_chart); $ii++) { 

					$chars = 'ABCDEF0123456789';
				    $colors = '#';

				    for ( $l = 0; $l < 6; $l++ ) {
				       $colors .= $chars[rand(0, strlen($chars) - 1)];
				    }

					$aff_prov[] = array(
						'name' 			=> $aff_prov_chart[$ii]['province_name'],
						'y' 			=> (int)$aff_prov_chart[$ii]['fam_cum'],
						'drilldown' 	=> $aff_prov_chart[$ii]['province_name'],
						'color' 		=> $colors

					);

					$pid = $aff_prov_chart[$ii]['id'];


					$query_all_munis_chart = $this->db->query("SELECT
																t1.*
															FROM
																(
																	SELECT
																		t3. ID,
																		t3.province_name,
																		t2.municipality_name,
																		t1.family_cum
																	FROM
																		(
																			SELECT
																				SUM (t1.family_cum :: NUMERIC) AS family_cum,
																				t1.municipality_id,
																				t1.municipality_name,
																				t1.disaster_title
																			FROM
																				(
																					SELECT
																						SUM (t1.family_cum :: NUMERIC) AS family_cum,
																						t1.municipality_id,
																						t3.municipality_name,
																						t2.disaster_title
																					FROM
																						public.tbl_evacuation_stats t1
																					LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																					LEFT JOIN public.lib_municipality t3 ON t1.municipality_id = t3. ID
																					WHERE
																						t1.disaster_title_id = $id
																					GROUP BY
																						t1.municipality_id,
																						t3.municipality_name,
																						t2.disaster_title
																					UNION ALL
																						(
																							SELECT
																								SUM (t1.family_cum :: NUMERIC) AS family_cum,
																								t1.municipality_id,
																								t3.municipality_name,
																								t2.disaster_title
																							FROM
																								public.tbl_evac_outside_stats t1
																							LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																							LEFT JOIN public.lib_municipality t3 ON t1.municipality_id = t3. ID
																							WHERE
																								t1.disaster_title_id = $id
																							GROUP BY
																								t1.municipality_id,
																								t3.municipality_name,
																								t2.disaster_title
																						)
																				) t1
																			GROUP BY
																				t1.municipality_id,
																				t1.municipality_name,
																				t1.disaster_title
																		) t1
																	LEFT JOIN public.lib_municipality t2 ON t1.municipality_id = t2. ID
																	LEFT JOIN public.lib_provinces t3 ON t2.provinceid = t3. ID
																	ORDER BY
																		t3. ID
																) t1
															WHERE t1.id = '$pid'
									");

					$aff_munis_chart = $query_all_munis_chart->result_array();

					$aff_munis = array();

					$aff_munis_drill = [];

					for ($iii=0; $iii < count($aff_munis_chart); $iii++) { 

						$chars = 'ABCDEF0123456789';
					    $colors = '#';

					    for ( $ll = 0; $ll < 6; $ll++ ) {
					       $colors .= $chars[rand(0, strlen($chars) - 1)];
					    }

						$aff_munis[] = array(
							'name' 			=> $aff_munis_chart[$iii]['municipality_name'],
							'y' 			=> (int)$aff_munis_chart[$iii]['family_cum'],
							'color' 		=> $colors
						);

						$aff_munis_all[] = array(
							'name' 			=> $aff_munis_chart[$iii]['municipality_name'],
							'y' 			=> (int)$aff_munis_chart[$iii]['family_cum'],
							'color' 		=> $colors
						);
					}

					$aff_munis_drill[] = array(
						'name' 			=> $aff_prov_chart[$ii]['province_name'],
						'id' 			=> $aff_prov_chart[$ii]['province_name'],
						'data' 			=> $aff_munis
					);

				}

				$query_brgy_unique_ec = $this->db->query("
														SELECT
															* 
														FROM
															(
															SELECT DISTINCT ON
																( t1.brgy_located_ec, t1.brgy_located ) t1.region_psgc,
																t1.province_id,
																t1.municipality_id,
																t1.brgy_located_ec :: INTEGER,
																t1.brgy_located :: INTEGER 
															FROM
																(
																SELECT
																	* 
																FROM
																	(
																	SELECT
																		t3.region_psgc,
																		t1.province_id,
																		t1.municipality_id,
																		t1.brgy_located_ec,
																		regexp_split_to_table( t2.brgy_located, ',' ) AS brgy_located 
																	FROM
																		tbl_activated_ec t1
																		LEFT JOIN tbl_evacuation_stats t2 ON t1.ID = t2.evacuation_name :: INTEGER 
																		AND t1.dromic_id = t2.dromic_ids
																		LEFT JOIN lib_provinces t3 ON t1.province_id :: INTEGER = t3.ID 
																	WHERE
																		t2.disaster_title_id = '$id'
																	) t1 
																) t1 
															) t1 
														ORDER BY
															t1.municipality_id ASC,
															t1.brgy_located_ec ASC,
															t1.brgy_located ASC 
				");

				$query_served_not_displaced = $this->db->query("
														SELECT
															t2.region_psgc,
															t1.*
														FROM
															tbl_not_displaced_served t1 
															LEFT JOIN lib_provinces t2 ON t1.provinceid::character varying = t2.id::character varying 
															WHERE t1.disaster_title_id = '$id'
				");


				$data['rs'] 					= $query->result();
				$data['rsoutside'] 				= $query2->result();
				$data['city'] 					= $query1->result();
				$data['brgy'] 					= $querybrgy->result();
				$data['brgys'] 					= $query_brgys->result();
				$data['masterquery'] 			= $masterquery->result();
				$data['masterquery2'] 			= $masterquery2->result();
				$data['masterquery3'] 			= $masterquery3->result();
				$data['query_title'] 			= $query_title->result();
				$data['query_asst'] 			= $query_casualty_title->result();
				$data['query_casualties'] 		= $query_casualties->result();
				$data['query_damage_per_brgy'] 	= $query_dam_per_brgy->result();
				$data['query_all_munis'] 		= $query_all_munis->result();
				$data['aff_prov'] 				= $aff_prov;
				$data['aff_munis_drill'] 		= $aff_munis_drill;
				$data['aff_munis_all'] 			= $aff_munis_all;

				$data['queryecs'] 				= $queryecs->result();

				$data['query_outec'] 			= $query_outec->result();

				$data['query_fnfis'] 			= $query_fnfis->result();

				$data['sex'] 					= $query_sex_gender->result();
				$data['facilities'] 			= $query_facilities->result();

				$data['brgy_unique_ec'] 		= $query_brgy_unique_ec->result();

				$data['all_affected'] 			= $query_all_affected->result();

				$data['fnds'] 					= $query_served_not_displaced->result();

				return $data;

			}else if($user_level_access == 'province' || $user_level_access == 'region'){

				$aff_munis_all = array();

				$aff_munis_drill[] = array();

				$query_title = $this->db->query("SELECT
													t1.*,
													t2.disaster_name,
													t2.disaster_date
												FROM
													tbl_disaster_title t1
												LEFT JOIN public.tbl_dromic t2 ON t1.dromic_id = t2. ID
												WHERE
													t1. ID = $id -- disaster_title_id
										");

				$query_brgys = $this->db->query("SELECT DISTINCT ON
													( t1.brgy_located_ec ) t1.province_id,
													t1.municipality_id,
													CONCAT ( '0', t1.brgy_located_ec ) :: INTEGER brgy_located_ec,
													t2.affected_family,
													t2.affected_persons 
												FROM
													(
													SELECT
														* 
													FROM
														(
														SELECT DISTINCT ON
															( t1.brgy_located_ec ) t1.province_id,
															municipality_id,
															CONCAT ( '0', t1.brgy_located_ec ) :: INTEGER brgy_located_ec 
														FROM
															(
															SELECT
																t0.* 
															FROM
																(
																SELECT DISTINCT ON
																	( t1.province_id, t1.municipality_id, t1.brgy_located_ec ) t1.province_id :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_located_ec :: CHARACTER VARYING 
																FROM
																	tbl_activated_ec t1
																	LEFT JOIN tbl_disaster_title t2 ON t1.dromic_id :: CHARACTER VARYING = t2.dromic_id ::
																	CHARACTER VARYING LEFT JOIN lib_provinces t3 ON t1.province_id :: CHARACTER VARYING = t3.ID :: CHARACTER VARYING 
																WHERE
																	t2.ID = '$id' 
																	AND t3.region_psgc :: CHARACTER VARYING = '$region' 
																) t0 UNION ALL
																(
																SELECT DISTINCT ON
																	( t1.provinceid, t1.municipality_id, t1.brgy_host ) t1.provinceid :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_host :: CHARACTER VARYING 
																FROM
																	tbl_evac_outside_stats t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid :: CHARACTER VARYING = t2.ID :: CHARACTER VARYING 
																WHERE
																	t1.disaster_title_id = '$id' 
																	AND t2.region_psgc :: CHARACTER VARYING = '$region' 
																) 
																UNION ALL
																(
																SELECT DISTINCT ON
																	( t1.provinceid, t1.municipality_id, t1.brgy_id ) t1.provinceid :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_id :: CHARACTER VARYING 
																FROM
																	tbl_damage_per_brgy t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid :: CHARACTER VARYING = t2.ID :: CHARACTER VARYING 
																WHERE
																	t1.disaster_title_id = '$id' 
																	AND t2.region_psgc :: CHARACTER VARYING = '$region' 
																)
															) t1 
														) t1 
													ORDER BY
														t1.brgy_located_ec 
													) t1
													LEFT JOIN tbl_damage_per_brgy t2 ON t2.brgy_id = t1.brgy_located_ec
													WHERE t2.disaster_title_id = '$id'
										");

				$query = $this->db->query("SELECT
												t1. ID dromic_id,
												t3.*, t5.ec_name evacuation_names,
												t5.brgy_located_ec,
												t5.ec_cum,
												t5.ec_now,
												t5.ec_status
											FROM
												tbl_disaster_title t1
											LEFT JOIN tbl_dromic t2 ON t1.dromic_id = t2. ID
											LEFT JOIN tbl_evacuation_stats t3 ON t1. ID = t3.disaster_title_id
											LEFT JOIN lib_municipality t4 ON t3.municipality_id = t4. ID -- LEFT JOIN lib_provinces t5 ON t3.provinceid = t5. ID
											-- LEFT JOIN lib_barangay t6 ON CONCAT('0',t3.brgy_located)::integer = t6.id::integer
											LEFT JOIN tbl_activated_ec t5 ON t3.evacuation_name = t5. ID :: CHARACTER VARYING
											LEFT JOIN lib_provinces t6 ON t3.provinceid = t6.id
											WHERE
												t1. ID = '$id' -- disaster_title_id
											AND t6.region_psgc = '$region'
											ORDER BY
												t3.municipality_id ASC,
												t3.evacuation_name ASC,
												t5.brgy_located_ec ASC,
												t3.brgy_located ASC
										");

				$query_outec = $this->db->query("SELECT
													*
												FROM
													tbl_evac_outside_stats t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2.id
												WHERE
													t1.disaster_title_id = '$id' -- disaster_title_id
												AND t2.region_psgc = '$region'
												ORDER BY
													t1.provinceid,
													t1.municipality_id,
													t1.brgy_host
										");


				$queryecs = $this->db->query("SELECT
													t1.*
												FROM
													tbl_activated_ec t1
												LEFT JOIN tbl_disaster_title t2 ON t1.dromic_id :: CHARACTER VARYING = t2.dromic_id :: CHARACTER VARYING
												LEFT JOIN lib_provinces t3 ON t1.province_id::character varying = t3.id::character varying
												WHERE
													t2. ID = '$id'
												AND t3.region_psgc = '$region'
												ORDER BY
													t1.province_id,
													t1.municipality_id,
													t1.brgy_located_ec
											");

				$query1 = $this->db->query("SELECT DISTINCT
												ON (t1.municipality_id) t1.municipality_id ID,
												t2.municipality_name,
												t1.provinceid,
												t1.region
											FROM
												(
													SELECT DISTINCT
														ON (t1.municipality_id) t1.municipality_id,
														t1.provinceid,
														t1.region
													FROM
														(
															SELECT
																t1.municipality_id,
																t1.provinceid,
																t2.region_psgc region
															FROM
																tbl_evacuation_stats t1
															LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
															WHERE
																t1.disaster_title_id = '$id'
																AND t2.region_psgc = '$region'
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_casualty_asst t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																		AND t2.region_psgc = '$region'
																)
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_evac_outside_stats t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																		AND t2.region_psgc = '$region'
																)
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_affected t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																		AND t2.region_psgc = '$region'
																)
														) t1
												) t1
											LEFT JOIN lib_municipality t2 ON t1.municipality_id = t2. ID
											ORDER BY
												t1.municipality_id,
												t1.provinceid
					");


				$querybrgy = $this->db->query("SELECT
													t1.*, t2.municipality_name,
													t3.province_name
												FROM
													lib_barangay t1
												LEFT JOIN lib_municipality t2 ON t1.municipality_id = t2. ID
												LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
												WHERE t3.region_psgc = '$region'
												ORDER BY
													t1. ID
											");

				$query2 = $this->db->query("SELECT
												t5.province_name,
												t4.municipality_name,
												COALESCE (
													t6.brgy_name,
													'NOT INDICATED'
												) brgy_name,
												t1. ID dromic_id,
												t3.*
											FROM
												tbl_disaster_title t1
											LEFT JOIN tbl_dromic t2 ON t1.dromic_id = t2. ID
											LEFT JOIN  tbl_evac_outside_stats t3 ON t1. ID = t3.disaster_title_id
											LEFT JOIN  lib_municipality t4 ON t3.municipality_id = t4. ID
											LEFT JOIN  lib_provinces t5 ON t3.provinceid = t5. ID
											LEFT JOIN  lib_barangay t6 ON t3.brgy_host :: CHARACTER VARYING = t6. ID :: CHARACTER VARYING
											WHERE
												t3.disaster_title_id = '$id' -- disaster_title_id
											AND t5.region_psgc = '$region'
											ORDER BY
												t3.municipality_id,
												t3.brgy_host
										");

				$query_fnfis = $this->db->query("SELECT
													t2.provinceid,
													t2.municipality_id,
													t2.disaster_title_id,
													t1.fnfi_name,
													t1.quantity,
													t1. COST,
													t1.fnfitype
												FROM
													tbl_fnfi_assistance_list t1
												LEFT JOIN tbl_fnfi_assistance t2 ON t1.fnfi_assistance_id = t2. ID
												LEFT JOIN tbl_disaster_title t3 ON t2.disaster_title_id = t3. ID
												LEFT JOIN lib_provinces t4 ON t2.provinceid = t4.id
												WHERE
													t2.disaster_title_id = '$id'
												AND t4.region_psgc = '$region'
										");

				$query_sex_gender = $this->db->query("SELECT
															t1.*, t3.brgy_located_ec
														FROM
															tbl_sex_gender_data t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id :: CHARACTER VARYING = t2. ID :: CHARACTER VARYING
														LEFT JOIN tbl_activated_ec t3 ON t1.evac_id :: CHARACTER VARYING = t3. ID :: CHARACTER VARYING
														LEFT JOIN lib_provinces t4 ON t1.province_id :: CHARACTER VARYING = t4.id :: CHARACTER VARYING
														WHERE
															t2. ID = '$id'
														AND t4.region_psgc = '$region'
										");

				$query_facilities = $this->db->query("SELECT
														t1.*, t3.brgy_located_ec
													FROM
														tbl_ec_facilities t1
													LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id :: CHARACTER VARYING = t2. ID :: CHARACTER VARYING
													LEFT JOIN tbl_activated_ec t3 ON t1.evac_id :: CHARACTER VARYING = t3. ID :: CHARACTER VARYING
													LEFT JOIN lib_provinces t4 ON t1.province_id :: CHARACTER VARYING = t4. ID :: CHARACTER VARYING
													WHERE
														t2. ID = '$id'
													AND t4.region_psgc = '$region'
										");

				$masterquery = $this->db->query("SELECT
													t1.provinceid,
													t1.municipality_id,
													SUM (family_a_t) family_a_t,
													SUM (person_a_t) person_a_t,
													SUM (family_cum_i) family_cum_i,
													SUM (family_now_i) family_now_i,
													SUM (person_cum_i) person_cum_i,
													SUM (person_now_i) person_now_i,
													SUM (family_cum_o) family_cum_o,
													SUM (family_now_o) family_now_o,
													SUM (person_cum_o) person_cum_o,
													SUM (person_now_o) person_now_o,
													SUM (family_cum_s_t) family_cum_s_t,
													SUM (family_now_s_t) family_now_s_t,
													SUM (person_cum_s_t) person_cum_s_t,
													SUM (person_now_s_t) person_now_s_t
												FROM
													(
														SELECT
															t1.provinceid,
															t1.municipality_id,
															COALESCE (t1.family_cum_i, '0') + COALESCE (t1.family_cum_o, '0') family_a_t,
															COALESCE (t1.person_cum_i, '0') + COALESCE (t1.person_cum_o, '0') person_a_t,
															t1.family_cum_i,
															t1.family_now_i,
															t1.person_cum_i,
															t1.person_now_i,
															t1.family_cum_o,
															t1.family_now_o,
															t1.person_cum_o,
															t1.person_now_o,
															COALESCE (t1.family_cum_i, '0') + COALESCE (t1.family_cum_o, '0') family_cum_s_t,
															COALESCE (t1.family_now_i, '0') + COALESCE (t1.family_now_o, '0') family_now_s_t,
															COALESCE (t1.person_cum_i, '0') + COALESCE (t1.person_cum_o, '0') person_cum_s_t,
															COALESCE (t1.person_now_i, '0') + COALESCE (t1.person_now_o, '0') person_now_s_t
														FROM
															(
																SELECT
																	t1.provinceid,
																	t1.municipality_id,
																	t1.family_cum_i,
																	t1.family_now_i,
																	t1.person_cum_i,
																	t1.person_now_i,
																	t1.family_cum_o,
																	t1.family_now_o,
																	t1.person_cum_o,
																	t1.person_now_o
																FROM
																	(
																		SELECT
																			t0.*
																		FROM
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					t1.family_cum :: INTEGER family_cum_i,
																					t1.family_now :: INTEGER family_now_i,
																					t1.person_cum :: INTEGER person_cum_i,
																					t1.person_now :: INTEGER person_now_i,
																					'0' :: INTEGER family_cum_o,
																					'0' :: INTEGER family_now_o,
																					'0' :: INTEGER person_cum_o,
																					'0' :: INTEGER person_now_o
																				FROM
																					tbl_evacuation_stats t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN lib_provinces t3 On t1.provinceid = t3.id
																				WHERE
																					t1.disaster_title_id =  '$id'
																					AND t3.region_psgc = '$region'
																				ORDER BY
																					t1.municipality_id
																			) t0
																		UNION ALL
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					'0' :: INTEGER family_cum_i,
																					'0' :: INTEGER family_now_i,
																					'0' :: INTEGER person_cum_i,
																					'0' :: INTEGER person_now_i,
																					t1.family_cum :: INTEGER family_cum_o,
																					t1.family_now :: INTEGER family_now_o,
																					t1.person_cum :: INTEGER person_cum_o,
																					t1.person_now :: INTEGER person_now_o
																				FROM
																					tbl_evac_outside_stats t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN lib_provinces t3 On t1.provinceid = t3.id
																				WHERE
																					t1.disaster_title_id =  '$id'
																					AND t3.region_psgc = '$region'
																				ORDER BY
																					t1.municipality_id
																			)
																		UNION ALL
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					'0' :: INTEGER family_cum_i,
																					'0' :: INTEGER family_now_i,
																					'0' :: INTEGER person_cum_i,
																					'0' :: INTEGER person_now_i,
																					'0' :: INTEGER family_cum_o,
																					'0' :: INTEGER family_now_o,
																					'0' :: INTEGER person_cum_o,
																					'0' :: INTEGER person_now_o
																				FROM
																					tbl_casualty_asst t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN lib_provinces t3 On t1.provinceid = t3.id
																				WHERE
																					t1.disaster_title_id =  '$id'
																					AND t3.region_psgc = '$region'
																				ORDER BY
																					t1.municipality_id
																			)
																	) t1
															) t1
														ORDER BY
															t1.municipality_id
													) t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
												WHERE t2.region_psgc = '$region'
												GROUP BY
													t1.provinceid,
													t1.municipality_id
												ORDER BY
													t1.municipality_id
										");
				$masterquery2 = $this->db->query("SELECT
													t1.*
												FROM
													(
														SELECT
															t1.provinceid,
															t1.municipality_id,
															COUNT (t1.brgy :: INTEGER) brgynum
														FROM
															(
																SELECT
																	*
																FROM
																	(
																		SELECT DISTINCT
																			ON (t1.brgy) t1.provinceid,
																			t1.municipality_id,
																			CONCAT ('0', t1.brgy) :: INTEGER brgy
																		FROM
																			(
																				SELECT DISTINCT
																					ON (tx.brgy) tx.provinceid,
																					tx.municipality_id,
																					CONCAT ('0', tx.brgy) :: INTEGER brgy
																				FROM
																					(
																						SELECT DISTINCT
																							tx.*
																						FROM
																							(
																								SELECT
																									t4.provinceid,
																									t4.municipality_id,
																									regexp_split_to_table(t4.brgy_located, '[\\s,]+') brgy
																								FROM
																									PUBLIC .tbl_evacuation_stats t4
																								LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																								WHERE
																									t4.disaster_title_id = $id -- disaster_title_id
																								GROUP BY
																									t4.municipality_id,
																									t4.provinceid,
																									t4.brgy_located
																								ORDER BY
																									t4.brgy_located ASC,
																									t4.municipality_id ASC
																							) tx
																						UNION ALL
																							(
																								SELECT DISTINCT
																									ON (t1.brgy) *
																								FROM
																									(
																										SELECT
																											*
																										FROM
																											(
																												SELECT DISTINCT
																													ON (t4.brgy_host) t4.provinceid,
																													t4.municipality_id,
																													t4.brgy_host brgy
																												FROM
																													PUBLIC .tbl_evac_outside_stats t4
																												LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																												WHERE
																													t4.disaster_title_id = $id -- disaster_title_id
																												AND t4.brgy_host <> '0'
																												GROUP BY
																													t4.municipality_id,
																													t4.provinceid,
																													t4.brgy_host
																												ORDER BY
																													t4.brgy_host ASC,
																													t4.municipality_id ASC
																											) t1
																										UNION ALL
																											(
																												SELECT DISTINCT
																													ON (t4.brgy_origin) t4.provinceid,
																													t4.municipality_id,
																													t4.brgy_origin brgy
																												FROM
																													PUBLIC .tbl_evac_outside_stats t4
																												LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																												WHERE
																													t4.disaster_title_id = $id -- disaster_title_id
																												AND t4.brgy_origin ~ '^\d+(.\d+)?$' = TRUE
																												GROUP BY
																													t4.municipality_id,
																													t4.provinceid,
																													t4.brgy_origin
																												ORDER BY
																													t4.brgy_origin ASC,
																													t4.municipality_id ASC
																											)
																									) t1
																							)
																						UNION ALL
																							(
																								SELECT
																									t1.*
																								FROM
																									(
																										SELECT DISTINCT
																											ON (t1.brgy) t1.provinceid,
																											t1.municipality_id,
																											t1.brgy
																										FROM
																											(
																												SELECT
																													t1.*
																												FROM
																													(
																														SELECT
																															t1.provinceid,
																															t1.municipality_id,
																															regexp_split_to_table(t1.brgy_id, '[\\s|]+') brgy
																														FROM
																															PUBLIC .tbl_casualty_asst t1
																														WHERE
																															t1.disaster_title_id = $id
																													) t1
																											) t1
																										ORDER BY
																											t1.brgy
																									) t1
																								ORDER BY
																									t1.provinceid,
																									t1.municipality_id,
																									t1.brgy
																							)
																					) tx
																				ORDER BY
																					tx.brgy
																			) t1
																		ORDER BY
																			t1.brgy
																	) t1
															) t1
														GROUP BY
															t1.provinceid,
															t1.municipality_id
													) t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
												WHERE
													t2.region_psgc = '$region'
												ORDER BY
													t1.provinceid,
													t1.municipality_id

										");
				$masterquery3 = $this->db->query("SELECT
													t1.provinceid,
													t1.municipality_id,
													t4.ec_cum,
													t4.ec_now
												FROM
													PUBLIC .tbl_evacuation_stats t1
												LEFT JOIN PUBLIC .tbl_disaster_title t3 ON t1.disaster_title_id = t3. ID
												LEFT JOIN tbl_activated_ec t4 ON t1.evacuation_name :: CHARACTER VARYING = t4. ID :: CHARACTER VARYING
												LEFT JOIN lib_provinces t5 ON t1.provinceid = t5. ID
												WHERE
													t4.ec_cum = '1'
												AND t1.disaster_title_id = '$id' -- disaster_title_id
												AND t5.region_psgc = '$region'
												ORDER BY
													t1.municipality_id
										");
				$query_casualty_title = $this->db->query("SELECT
															t1.*, t3.municipality_name
														FROM
															tbl_casualty_asst t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
														LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
														LEFT JOIN lib_provinces t4 ON t1.provinceid = t4. ID
														WHERE
															t2. ID = '$id' -- disaster_title_id
														AND t4.region_psgc = '$region'
														ORDER BY
															t1.municipality_id
										");

				$query_casualties = $this->db->query("SELECT
														t1. ID,
														t1.disaster_title_id,
														UPPER (t1.lastname) lastname,
														UPPER (t1.firstname) firstname,
														UPPER (t1.middle_i) middle_i,
														UPPER (t1.gender) gender,
														t1.provinceid,
														t1.municipalityid,
														UPPER (t1.brgyname) brgyname,
														t1.isdead,
														t1.ismissing,
														t1.isinjured,
														UPPER (t1.remarks) remarks,
														t1.age,
														t3.municipality_name,
														t4.province_name
													FROM
														public.tbl_casualty t1
													LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
													LEFT JOIN public.lib_municipality t3 ON t1.municipalityid = t3. ID
													LEFT JOIN public.lib_provinces t4 ON t1.provinceid = t4. ID
													WHERE
														t1.disaster_title_id = $id -- disaster_title_id
													ORDER BY
														t1.provinceid,
														t1.municipalityid,
														t1.brgyname
									");

				$query_dam_per_brgy = $this->db->query("SELECT
															t1.*, t2.brgy_name
														FROM
															PUBLIC .tbl_damage_per_brgy t1
														LEFT JOIN PUBLIC .lib_barangay t2 ON t1.brgy_id = t2. ID
														LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
														WHERE
															t1.disaster_title_id = '$id'
														AND t3.region_psgc = '$region'
														ORDER BY
															t1. ID
									");

				$query_all_affected = $this->db->query("SELECT
														t1.*
													FROM
														public.tbl_affected t1
														LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
													WHERE
														t1.disaster_title_id = '$id'
														AND t3.region_psgc = '$region'
													ORDER BY t1.id
								");

				$query_all_munis = $this->db->query("SELECT
														COUNT (t1.municipality_id) all_munis,
														t1.iscity
													FROM
														(
															SELECT
																t1.*, t2.iscity
															FROM
																(
																	SELECT DISTINCT
																		(t1.municipality_id)
																	FROM
																		(
																			SELECT DISTINCT
																				(municipality_id)
																			FROM
																				tbl_evacuation_stats t1
																			LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																			WHERE
																				disaster_title_id = '$id'
																			AND t2.region_psgc = '$region'
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t2.municipality_id)
																					FROM
																						PUBLIC .tbl_evac_outside_stats t2
																					LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
																					WHERE
																						disaster_title_id = '$id'
																					AND t3.region_psgc = '$region'
																				)
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t3.municipality_id)
																					FROM
																						PUBLIC .tbl_casualty_asst t3
																					LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
																					WHERE
																						disaster_title_id = '$id'
																					AND t4.region_psgc = '$region'
																				)
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t3.municipality_id)
																					FROM
																						PUBLIC .tbl_affected t3
																					LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
																					WHERE
																						disaster_title_id = '$id'
																					AND t4.region_psgc = '$region'
																				)
																		) t1
																) t1
															LEFT JOIN PUBLIC .lib_municipality t2 ON t1.municipality_id = t2. ID
														) t1
													GROUP BY
														t1.iscity
									");

				$query_all_prov_chart = $this->db->query("SELECT
															t3. ID,
															t3.province_name,
															SUM (t1.family_cum) fam_cum
														FROM
															(
																SELECT
																	SUM (t1.family_cum :: NUMERIC) AS family_cum,
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title
																FROM
																	(
																		SELECT
																			SUM (t1.family_cum :: NUMERIC) AS family_cum,
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title
																		FROM
																			PUBLIC .tbl_evacuation_stats t1
																		LEFT JOIN PUBLIC .tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																		LEFT JOIN PUBLIC .lib_municipality t3 ON t1.municipality_id = t3. ID
																		WHERE
																			t1.disaster_title_id = $id
																		GROUP BY
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title
																		UNION ALL
																			(
																				SELECT
																					SUM (t1.family_cum :: NUMERIC) AS family_cum,
																					t1.municipality_id,
																					t3.municipality_name,
																					t2.disaster_title
																				FROM
																					PUBLIC .tbl_evac_outside_stats t1
																				LEFT JOIN PUBLIC .tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN PUBLIC .lib_municipality t3 ON t1.municipality_id = t3. ID
																				WHERE
																					t1.disaster_title_id = $id
																				GROUP BY
																					t1.municipality_id,
																					t3.municipality_name,
																					t2.disaster_title
																			)
																	) t1
																GROUP BY
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title
															) t1
														LEFT JOIN PUBLIC .lib_municipality t2 ON t1.municipality_id = t2. ID
														LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
														WHERE t3.region_psgc = '$region'
														GROUP BY
															t3. ID,
															t3.province_name
														ORDER BY
															t3. ID
									");

				$aff_prov_chart = $query_all_prov_chart->result_array();

				$aff_prov = array();

				$pid = "";

				for ($ii=0; $ii < count($aff_prov_chart); $ii++) { 

					$chars = 'ABCDEF0123456789';
				    $colors = '#';

				    for ( $l = 0; $l < 6; $l++ ) {
				       $colors .= $chars[rand(0, strlen($chars) - 1)];
				    }

					$aff_prov[] = array(
						'name' 			=> $aff_prov_chart[$ii]['province_name'],
						'y' 			=> (int)$aff_prov_chart[$ii]['fam_cum'],
						'drilldown' 	=> $aff_prov_chart[$ii]['province_name'],
						'color' 		=> $colors

					);

					$pid = $aff_prov_chart[$ii]['id'];


					$query_all_munis_chart = $this->db->query("SELECT
																t1.*
															FROM
																(
																	SELECT
																		t3. ID,
																		t3.province_name,
																		t2.municipality_name,
																		t1.family_cum
																	FROM
																		(
																			SELECT
																				SUM (t1.family_cum :: NUMERIC) AS family_cum,
																				t1.municipality_id,
																				t1.municipality_name,
																				t1.disaster_title
																				FROM
																					(
																						SELECT
																							SUM (t1.family_cum :: NUMERIC) AS family_cum,
																							t1.municipality_id,
																							t3.municipality_name,
																							t2.disaster_title
																						FROM
																							public.tbl_evacuation_stats t1
																						LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																						LEFT JOIN public.lib_municipality t3 ON t1.municipality_id = t3. ID
																						WHERE
																							t1.disaster_title_id = $id
																						GROUP BY
																							t1.municipality_id,
																							t3.municipality_name,
																							t2.disaster_title
																						UNION ALL
																							(
																								SELECT
																									SUM (t1.family_cum :: NUMERIC) AS family_cum,
																									t1.municipality_id,
																									t3.municipality_name,
																									t2.disaster_title
																								FROM
																									public.tbl_evac_outside_stats t1
																								LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																								LEFT JOIN public.lib_municipality t3 ON t1.municipality_id = t3. ID
																								WHERE
																									t1.disaster_title_id = $id
																								GROUP BY
																									t1.municipality_id,
																									t3.municipality_name,
																									t2.disaster_title
																							)
																					) t1
																				GROUP BY
																					t1.municipality_id,
																					t1.municipality_name,
																					t1.disaster_title
																		) t1
																	LEFT JOIN public.lib_municipality t2 ON t1.municipality_id = t2. ID
																	LEFT JOIN public.lib_provinces t3 ON t2.provinceid = t3. ID
																	ORDER BY
																		t3. ID
																) t1
															WHERE t1.id = '$pid'
									");

					$aff_munis_chart = $query_all_munis_chart->result_array();

					$aff_munis = array();

					$aff_munis_drill[] = array();

					for ($iii=0; $iii < count($aff_munis_chart); $iii++) { 

						$chars = 'ABCDEF0123456789';
					    $colors = '#';

					    for ( $ll = 0; $ll < 6; $ll++ ) {
					       $colors .= $chars[rand(0, strlen($chars) - 1)];
					    }

						$aff_munis[] = array(
							'name' 			=> $aff_munis_chart[$iii]['municipality_name'],
							'y' 			=> (int)$aff_munis_chart[$iii]['family_cum'],
							'color' 		=> $colors
						);

						$aff_munis_all[] = array(
							'name' 			=> $aff_munis_chart[$iii]['municipality_name'],
							'y' 			=> (int)$aff_munis_chart[$iii]['family_cum'],
							'color' 		=> $colors
						);
					}

					$aff_munis_drill[] = array(
						'name' 			=> $aff_prov_chart[$ii]['province_name'],
						'id' 			=> $aff_prov_chart[$ii]['province_name'],
						'data' 			=> $aff_munis
					);

				}

				$query_brgy_unique_ec = $this->db->query("
													SELECT
														* 
													FROM
														(
														SELECT DISTINCT ON
															( t1.brgy_located_ec, t1.brgy_located ) t1.region_psgc,
															t1.province_id,
															t1.municipality_id,
															t1.brgy_located_ec :: INTEGER,
															t1.brgy_located :: INTEGER 
														FROM
															(
															SELECT
																* 
															FROM
																(
																SELECT
																	t3.region_psgc,
																	t1.province_id,
																	t1.municipality_id,
																	t1.brgy_located_ec,
																	regexp_split_to_table( t2.brgy_located, ',' ) AS brgy_located 
																FROM
																	tbl_activated_ec t1
																	LEFT JOIN tbl_evacuation_stats t2 ON t1.ID = t2.evacuation_name :: INTEGER 
																	AND t1.dromic_id = t2.dromic_ids
																	LEFT JOIN lib_provinces t3 ON t1.province_id :: INTEGER = t3.ID 
																WHERE
																	t2.disaster_title_id = '$id' 
																	AND t3.region_psgc = '$region' 
																) t1 
															) t1 
														) t1 
													ORDER BY
														t1.municipality_id ASC,
														t1.brgy_located_ec ASC,
														t1.brgy_located ASC 
				");

				$query_served_not_displaced = $this->db->query("
														SELECT
															t2.region_psgc,
															t1.*
														FROM
															tbl_not_displaced_served t1 
															LEFT JOIN lib_provinces t2 ON t1.provinceid::character varying = t2.id::character varying 
															WHERE t1.disaster_title_id = '$id'
															AND t2.region_psgc = '$region'
				");


				$data['rs'] 					= $query->result();
				$data['rsoutside'] 				= $query2->result();
				$data['city'] 					= $query1->result();
				$data['brgy'] 					= $querybrgy->result();
				$data['brgys'] 					= $query_brgys->result();
				$data['masterquery'] 			= $masterquery->result();
				$data['masterquery2'] 			= $masterquery2->result();
				$data['masterquery3'] 			= $masterquery3->result();
				$data['query_title'] 			= $query_title->result();
				$data['query_asst'] 			= $query_casualty_title->result();
				$data['query_casualties'] 		= $query_casualties->result();
				$data['query_damage_per_brgy'] 	= $query_dam_per_brgy->result();
				$data['query_all_munis'] 		= $query_all_munis->result();
				$data['aff_prov'] 				= $aff_prov;
				$data['aff_munis_drill'] 		= $aff_munis_drill;
				$data['aff_munis_all'] 			= $aff_munis_all;

				$data['queryecs'] 				= $queryecs->result();

				$data['query_outec'] 			= $query_outec->result();

				$data['query_fnfis'] 			= $query_fnfis->result();

				$data['sex'] 					= $query_sex_gender->result();
				$data['facilities'] 			= $query_facilities->result();

				$data['brgy_unique_ec'] 		= $query_brgy_unique_ec->result();

				$data['all_affected'] 			= $query_all_affected->result();

				$data['fnds'] 					= $query_served_not_displaced->result();

				return $data;

			}else if($user_level_access == 'municipality'){

				$aff_munis_all = array();

				$aff_munis_drill[] = array();

				$query_title = $this->db->query("SELECT
													t1.*,
													t2.disaster_name,
													t2.disaster_date
												FROM
													tbl_disaster_title t1
												LEFT JOIN public.tbl_dromic t2 ON t1.dromic_id = t2. ID
												WHERE
													t1. ID = $id -- disaster_title_id
										");

				$query_brgys = $this->db->query("SELECT DISTINCT ON
													( t1.brgy_located_ec ) t1.province_id,
													t1.municipality_id,
													CONCAT ( '0', t1.brgy_located_ec ) :: INTEGER brgy_located_ec,
													t2.affected_family,
													t2.affected_persons 
												FROM
													(
													SELECT
														* 
													FROM
														(
														SELECT DISTINCT ON
															( t1.brgy_located_ec ) t1.province_id,
															municipality_id,
															CONCAT ( '0', t1.brgy_located_ec ) :: INTEGER brgy_located_ec 
														FROM
															(
															SELECT
																t0.* 
															FROM
																(
																SELECT DISTINCT ON
																	( t1.province_id, t1.municipality_id, t1.brgy_located_ec ) t1.province_id :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_located_ec :: CHARACTER VARYING 
																FROM
																	tbl_activated_ec t1
																	LEFT JOIN tbl_disaster_title t2 ON t1.dromic_id :: CHARACTER VARYING = t2.dromic_id ::
																	CHARACTER VARYING LEFT JOIN lib_provinces t3 ON t1.province_id :: CHARACTER VARYING = t3.ID :: CHARACTER VARYING 
																WHERE
																	t2.ID = '$id' 
																	AND t3.region_psgc :: CHARACTER VARYING = '$region' 
																) t0 UNION ALL
																(
																SELECT DISTINCT ON
																	( t1.provinceid, t1.municipality_id, t1.brgy_host ) t1.provinceid :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_host :: CHARACTER VARYING 
																FROM
																	tbl_evac_outside_stats t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid :: CHARACTER VARYING = t2.ID :: CHARACTER VARYING 
																WHERE
																	t1.disaster_title_id = '$id' 
																	AND t2.region_psgc :: CHARACTER VARYING = '$region' 
																) 
																UNION ALL
																(
																SELECT DISTINCT ON
																	( t1.provinceid, t1.municipality_id, t1.brgy_id ) t1.provinceid :: CHARACTER VARYING,
																	t1.municipality_id :: CHARACTER VARYING,
																	t1.brgy_id :: CHARACTER VARYING 
																FROM
																	tbl_damage_per_brgy t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid :: CHARACTER VARYING = t2.ID :: CHARACTER VARYING 
																WHERE
																	t1.disaster_title_id = '$id' 
																	AND t2.region_psgc :: CHARACTER VARYING = '$region' 
																)
															) t1 
														) t1 
													ORDER BY
														t1.brgy_located_ec 
													) t1
													LEFT JOIN tbl_damage_per_brgy t2 ON t2.brgy_id = t1.brgy_located_ec
													WHERE t2.disaster_title_id = '$id'
										");

				$query = $this->db->query("SELECT
												t1. ID dromic_id,
												t3.*, t5.ec_name evacuation_names,
												t5.brgy_located_ec,
												t5.ec_cum,
												t5.ec_now,
												t5.ec_status
											FROM
												tbl_disaster_title t1
											LEFT JOIN tbl_dromic t2 ON t1.dromic_id = t2. ID
											LEFT JOIN tbl_evacuation_stats t3 ON t1. ID = t3.disaster_title_id
											LEFT JOIN lib_municipality t4 ON t3.municipality_id = t4. ID -- LEFT JOIN lib_provinces t5 ON t3.provinceid = t5. ID
											-- LEFT JOIN lib_barangay t6 ON CONCAT('0',t3.brgy_located)::integer = t6.id::integer
											LEFT JOIN tbl_activated_ec t5 ON t3.evacuation_name = t5. ID :: CHARACTER VARYING
											LEFT JOIN lib_provinces t6 ON t3.provinceid = t6.id
											WHERE
												t1. ID = '$id' -- disaster_title_id
											AND t6.region_psgc = '$region'
											ORDER BY
												t3.municipality_id ASC,
												t3.evacuation_name ASC,
												t5.brgy_located_ec ASC,
												t3.brgy_located ASC
												
										");

				$query_outec = $this->db->query("SELECT
													*
												FROM
													tbl_evac_outside_stats t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2.id
												WHERE
													t1.disaster_title_id = '$id' -- disaster_title_id
												AND t2.region_psgc = '$region'
												ORDER BY
													t1.provinceid,
													t1.municipality_id,
													t1.brgy_host
										");


				$queryecs = $this->db->query("SELECT
													t1.*
												FROM
													tbl_activated_ec t1
												LEFT JOIN tbl_disaster_title t2 ON t1.dromic_id :: CHARACTER VARYING = t2.dromic_id :: CHARACTER VARYING
												LEFT JOIN lib_provinces t3 ON t1.province_id::character varying = t3.id::character varying
												WHERE
													t2. ID = '$id'
												AND t3.region_psgc = '$region'
												ORDER BY
													t1.province_id,
													t1.municipality_id,
													t1.brgy_located_ec
											");

				$query1 = $this->db->query("SELECT DISTINCT
												ON (t1.municipality_id) t1.municipality_id ID,
												t2.municipality_name,
												t1.provinceid,
												t1.region
											FROM
												(
													SELECT DISTINCT
														ON (t1.municipality_id) t1.municipality_id,
														t1.provinceid,
														t1.region
													FROM
														(
															SELECT
																t1.municipality_id,
																t1.provinceid,
																t2.region_psgc region
															FROM
																tbl_evacuation_stats t1
															LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
															WHERE
																t1.disaster_title_id = '$id'
																AND t2.region_psgc = '$region'
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_casualty_asst t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																		AND t2.region_psgc = '$region'
																)
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_evac_outside_stats t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																		AND t2.region_psgc = '$region'
																)
															UNION ALL
																(
																	SELECT
																		t1.municipality_id,
																		t1.provinceid,
																		t2.region_psgc region
																	FROM
																		tbl_affected t1
																	LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																	WHERE
																		t1.disaster_title_id = '$id'
																		AND t2.region_psgc = '$region'
																)
														) t1
												) t1
											LEFT JOIN lib_municipality t2 ON t1.municipality_id = t2. ID
											ORDER BY
												t1.municipality_id,
												t1.provinceid
					");


				$querybrgy = $this->db->query("SELECT
													t1.*, t2.municipality_name,
													t3.province_name
												FROM
													lib_barangay t1
												LEFT JOIN lib_municipality t2 ON t1.municipality_id = t2. ID
												LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
												WHERE t3.region_psgc = '$region'
												ORDER BY
													t1. ID
											");

				$query2 = $this->db->query("SELECT
												t5.province_name,
												t4.municipality_name,
												COALESCE (
													t6.brgy_name,
													'NOT INDICATED'
												) brgy_name,
												t1. ID dromic_id,
												t3.*
											FROM
												tbl_disaster_title t1
											LEFT JOIN tbl_dromic t2 ON t1.dromic_id = t2. ID
											LEFT JOIN  tbl_evac_outside_stats t3 ON t1. ID = t3.disaster_title_id
											LEFT JOIN  lib_municipality t4 ON t3.municipality_id = t4. ID
											LEFT JOIN  lib_provinces t5 ON t3.provinceid = t5. ID
											LEFT JOIN  lib_barangay t6 ON t3.brgy_host :: CHARACTER VARYING = t6. ID :: CHARACTER VARYING
											WHERE
												t3.disaster_title_id = '$id' -- disaster_title_id
											AND t5.region_psgc = '$region'
											ORDER BY
												t3.municipality_id,
												t3.brgy_host
										");

				$query_fnfis = $this->db->query("SELECT
													t2.provinceid,
													t2.municipality_id,
													t2.disaster_title_id,
													t1.fnfi_name,
													t1.quantity,
													t1. COST,
													t1.fnfitype
												FROM
													tbl_fnfi_assistance_list t1
												LEFT JOIN tbl_fnfi_assistance t2 ON t1.fnfi_assistance_id = t2. ID
												LEFT JOIN tbl_disaster_title t3 ON t2.disaster_title_id = t3. ID
												LEFT JOIN lib_provinces t4 ON t2.provinceid = t4.id
												WHERE
													t2.disaster_title_id = '$id'
												AND t4.region_psgc = '$region'
										");

				$query_sex_gender = $this->db->query("SELECT
															t1.*, t3.brgy_located_ec
														FROM
															tbl_sex_gender_data t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id :: CHARACTER VARYING = t2. ID :: CHARACTER VARYING
														LEFT JOIN tbl_activated_ec t3 ON t1.evac_id :: CHARACTER VARYING = t3. ID :: CHARACTER VARYING
														LEFT JOIN lib_provinces t4 ON t1.province_id :: CHARACTER VARYING = t4.id :: CHARACTER VARYING
														WHERE
															t2. ID = '$id'
														AND t4.region_psgc = '$region'
										");

				$query_facilities = $this->db->query("SELECT
														t1.*, t3.brgy_located_ec
													FROM
														tbl_ec_facilities t1
													LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id :: CHARACTER VARYING = t2. ID :: CHARACTER VARYING
													LEFT JOIN tbl_activated_ec t3 ON t1.evac_id :: CHARACTER VARYING = t3. ID :: CHARACTER VARYING
													LEFT JOIN lib_provinces t4 ON t1.province_id :: CHARACTER VARYING = t4. ID :: CHARACTER VARYING
													WHERE
														t2. ID = '$id'
													AND t4.region_psgc = '$region'
										");

				$masterquery = $this->db->query("SELECT
													t1.provinceid,
													t1.municipality_id,
													SUM (family_a_t) family_a_t,
													SUM (person_a_t) person_a_t,
													SUM (family_cum_i) family_cum_i,
													SUM (family_now_i) family_now_i,
													SUM (person_cum_i) person_cum_i,
													SUM (person_now_i) person_now_i,
													SUM (family_cum_o) family_cum_o,
													SUM (family_now_o) family_now_o,
													SUM (person_cum_o) person_cum_o,
													SUM (person_now_o) person_now_o,
													SUM (family_cum_s_t) family_cum_s_t,
													SUM (family_now_s_t) family_now_s_t,
													SUM (person_cum_s_t) person_cum_s_t,
													SUM (person_now_s_t) person_now_s_t
												FROM
													(
														SELECT
															t1.provinceid,
															t1.municipality_id,
															COALESCE (t1.family_cum_i, '0') + COALESCE (t1.family_cum_o, '0') family_a_t,
															COALESCE (t1.person_cum_i, '0') + COALESCE (t1.person_cum_o, '0') person_a_t,
															t1.family_cum_i,
															t1.family_now_i,
															t1.person_cum_i,
															t1.person_now_i,
															t1.family_cum_o,
															t1.family_now_o,
															t1.person_cum_o,
															t1.person_now_o,
															COALESCE (t1.family_cum_i, '0') + COALESCE (t1.family_cum_o, '0') family_cum_s_t,
															COALESCE (t1.family_now_i, '0') + COALESCE (t1.family_now_o, '0') family_now_s_t,
															COALESCE (t1.person_cum_i, '0') + COALESCE (t1.person_cum_o, '0') person_cum_s_t,
															COALESCE (t1.person_now_i, '0') + COALESCE (t1.person_now_o, '0') person_now_s_t
														FROM
															(
																SELECT
																	t1.provinceid,
																	t1.municipality_id,
																	t1.family_cum_i,
																	t1.family_now_i,
																	t1.person_cum_i,
																	t1.person_now_i,
																	t1.family_cum_o,
																	t1.family_now_o,
																	t1.person_cum_o,
																	t1.person_now_o
																FROM
																	(
																		SELECT
																			t0.*
																		FROM
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					t1.family_cum :: INTEGER family_cum_i,
																					t1.family_now :: INTEGER family_now_i,
																					t1.person_cum :: INTEGER person_cum_i,
																					t1.person_now :: INTEGER person_now_i,
																					'0' :: INTEGER family_cum_o,
																					'0' :: INTEGER family_now_o,
																					'0' :: INTEGER person_cum_o,
																					'0' :: INTEGER person_now_o
																				FROM
																					tbl_evacuation_stats t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN lib_provinces t3 On t1.provinceid = t3.id
																				WHERE
																					t1.disaster_title_id =  '$id'
																					AND t3.region_psgc = '$region'
																				ORDER BY
																					t1.municipality_id
																			) t0
																		UNION ALL
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					'0' :: INTEGER family_cum_i,
																					'0' :: INTEGER family_now_i,
																					'0' :: INTEGER person_cum_i,
																					'0' :: INTEGER person_now_i,
																					t1.family_cum :: INTEGER family_cum_o,
																					t1.family_now :: INTEGER family_now_o,
																					t1.person_cum :: INTEGER person_cum_o,
																					t1.person_now :: INTEGER person_now_o
																				FROM
																					tbl_evac_outside_stats t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN lib_provinces t3 On t1.provinceid = t3.id
																				WHERE
																					t1.disaster_title_id =  '$id'
																					AND t3.region_psgc = '$region'
																				ORDER BY
																					t1.municipality_id
																			)
																		UNION ALL
																			(
																				SELECT
																					t1.provinceid,
																					t1.municipality_id,
																					'0' :: INTEGER family_cum_i,
																					'0' :: INTEGER family_now_i,
																					'0' :: INTEGER person_cum_i,
																					'0' :: INTEGER person_now_i,
																					'0' :: INTEGER family_cum_o,
																					'0' :: INTEGER family_now_o,
																					'0' :: INTEGER person_cum_o,
																					'0' :: INTEGER person_now_o
																				FROM
																					tbl_casualty_asst t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN lib_provinces t3 On t1.provinceid = t3.id
																				WHERE
																					t1.disaster_title_id =  '$id'
																					AND t3.region_psgc = '$region'
																				ORDER BY
																					t1.municipality_id
																			)
																	) t1
															) t1
														ORDER BY
															t1.municipality_id
													) t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
												WHERE t2.region_psgc = '$region'
												GROUP BY
													t1.provinceid,
													t1.municipality_id
												ORDER BY
													t1.municipality_id
										");
				$masterquery2 = $this->db->query("SELECT
													t1.*
												FROM
													(
														SELECT
															t1.provinceid,
															t1.municipality_id,
															COUNT (t1.brgy :: INTEGER) brgynum
														FROM
															(
																SELECT
																	*
																FROM
																	(
																		SELECT DISTINCT
																			ON (t1.brgy) t1.provinceid,
																			t1.municipality_id,
																			CONCAT ('0', t1.brgy) :: INTEGER brgy
																		FROM
																			(
																				SELECT DISTINCT
																					ON (tx.brgy) tx.provinceid,
																					tx.municipality_id,
																					CONCAT ('0', tx.brgy) :: INTEGER brgy
																				FROM
																					(
																						SELECT DISTINCT
																							tx.*
																						FROM
																							(
																								SELECT
																									t4.provinceid,
																									t4.municipality_id,
																									regexp_split_to_table(t4.brgy_located, '[\\s,]+') brgy
																								FROM
																									PUBLIC .tbl_evacuation_stats t4
																								LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																								WHERE
																									t4.disaster_title_id = $id -- disaster_title_id
																								GROUP BY
																									t4.municipality_id,
																									t4.provinceid,
																									t4.brgy_located
																								ORDER BY
																									t4.brgy_located ASC,
																									t4.municipality_id ASC
																							) tx
																						UNION ALL
																							(
																								SELECT DISTINCT
																									ON (t1.brgy) *
																								FROM
																									(
																										SELECT
																											*
																										FROM
																											(
																												SELECT DISTINCT
																													ON (t4.brgy_host) t4.provinceid,
																													t4.municipality_id,
																													t4.brgy_host brgy
																												FROM
																													PUBLIC .tbl_evac_outside_stats t4
																												LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																												WHERE
																													t4.disaster_title_id = $id -- disaster_title_id
																												AND t4.brgy_host <> '0'
																												GROUP BY
																													t4.municipality_id,
																													t4.provinceid,
																													t4.brgy_host
																												ORDER BY
																													t4.brgy_host ASC,
																													t4.municipality_id ASC
																											) t1
																										UNION ALL
																											(
																												SELECT DISTINCT
																													ON (t4.brgy_origin) t4.provinceid,
																													t4.municipality_id,
																													t4.brgy_origin brgy
																												FROM
																													PUBLIC .tbl_evac_outside_stats t4
																												LEFT JOIN PUBLIC .tbl_disaster_title t5 ON t4.disaster_title_id = t5. ID
																												WHERE
																													t4.disaster_title_id = $id -- disaster_title_id
																												AND t4.brgy_origin ~ '^\d+(.\d+)?$' = TRUE
																												GROUP BY
																													t4.municipality_id,
																													t4.provinceid,
																													t4.brgy_origin
																												ORDER BY
																													t4.brgy_origin ASC,
																													t4.municipality_id ASC
																											)
																									) t1
																							)
																						UNION ALL
																							(
																								SELECT
																									t1.*
																								FROM
																									(
																										SELECT DISTINCT
																											ON (t1.brgy) t1.provinceid,
																											t1.municipality_id,
																											t1.brgy
																										FROM
																											(
																												SELECT
																													t1.*
																												FROM
																													(
																														SELECT
																															t1.provinceid,
																															t1.municipality_id,
																															regexp_split_to_table(t1.brgy_id, '[\\s|]+') brgy
																														FROM
																															PUBLIC .tbl_casualty_asst t1
																														WHERE
																															t1.disaster_title_id = $id
																													) t1
																											) t1
																										ORDER BY
																											t1.brgy
																									) t1
																								ORDER BY
																									t1.provinceid,
																									t1.municipality_id,
																									t1.brgy
																							)
																					) tx
																				ORDER BY
																					tx.brgy
																			) t1
																		ORDER BY
																			t1.brgy
																	) t1
															) t1
														GROUP BY
															t1.provinceid,
															t1.municipality_id
													) t1
												LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
												WHERE
													t2.region_psgc = '$region'
												ORDER BY
													t1.provinceid,
													t1.municipality_id

										");
				$masterquery3 = $this->db->query("SELECT
													t1.provinceid,
													t1.municipality_id,
													t4.ec_cum,
													t4.ec_now
												FROM
													PUBLIC .tbl_evacuation_stats t1
												LEFT JOIN PUBLIC .tbl_disaster_title t3 ON t1.disaster_title_id = t3. ID
												LEFT JOIN tbl_activated_ec t4 ON t1.evacuation_name :: CHARACTER VARYING = t4. ID :: CHARACTER VARYING
												LEFT JOIN lib_provinces t5 ON t1.provinceid = t5. ID
												WHERE
													t4.ec_cum = '1'
												AND t1.disaster_title_id = '$id' -- disaster_title_id
												AND t5.region_psgc = '$region'
												ORDER BY
													t1.municipality_id
										");
				$query_casualty_title = $this->db->query("SELECT
															t1.*, t3.municipality_name
														FROM
															tbl_casualty_asst t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
														LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
														LEFT JOIN lib_provinces t4 ON t1.provinceid = t4. ID
														WHERE
															t2. ID = '$id' -- disaster_title_id
														AND t4.region_psgc = '$region'
														ORDER BY
															t1.municipality_id
										");

				$query_casualties = $this->db->query("SELECT
														t1. ID,
														t1.disaster_title_id,
														UPPER (t1.lastname) lastname,
														UPPER (t1.firstname) firstname,
														UPPER (t1.middle_i) middle_i,
														UPPER (t1.gender) gender,
														t1.provinceid,
														t1.municipalityid,
														UPPER (t1.brgyname) brgyname,
														t1.isdead,
														t1.ismissing,
														t1.isinjured,
														UPPER (t1.remarks) remarks,
														t1.age,
														t3.municipality_name,
														t4.province_name
													FROM
														public.tbl_casualty t1
													LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
													LEFT JOIN public.lib_municipality t3 ON t1.municipalityid = t3. ID
													LEFT JOIN public.lib_provinces t4 ON t1.provinceid = t4. ID
													WHERE
														t1.disaster_title_id = $id -- disaster_title_id
													ORDER BY
														t1.provinceid,
														t1.municipalityid,
														t1.brgyname
									");

				$query_dam_per_brgy = $this->db->query("SELECT
															t1.*, t2.brgy_name
														FROM
															PUBLIC .tbl_damage_per_brgy t1
														LEFT JOIN PUBLIC .lib_barangay t2 ON t1.brgy_id = t2. ID
														LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
														WHERE
															t1.disaster_title_id = '$id'
														AND t3.region_psgc = '$region'
														ORDER BY
															t1. ID
									");

				$query_all_affected = $this->db->query("SELECT
														t1.*
													FROM
														public.tbl_affected t1
														LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
													WHERE
														t1.disaster_title_id = '$id'
														AND t3.region_psgc = '$region'
													ORDER BY t1.id
								");

				$query_all_munis = $this->db->query("SELECT
														COUNT (t1.municipality_id) all_munis,
														t1.iscity
													FROM
														(
															SELECT
																t1.*, t2.iscity
															FROM
																(
																	SELECT DISTINCT
																		(t1.municipality_id)
																	FROM
																		(
																			SELECT DISTINCT
																				(municipality_id)
																			FROM
																				tbl_evacuation_stats t1
																			LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
																			WHERE
																				disaster_title_id = '$id'
																			AND t2.region_psgc = '$region'
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t2.municipality_id)
																					FROM
																						PUBLIC .tbl_evac_outside_stats t2
																					LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
																					WHERE
																						disaster_title_id = '$id'
																					AND t3.region_psgc = '$region'
																				)
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t3.municipality_id)
																					FROM
																						PUBLIC .tbl_casualty_asst t3
																					LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
																					WHERE
																						disaster_title_id = '$id'
																					AND t4.region_psgc = '$region'
																				)
																			UNION ALL
																				(
																					SELECT DISTINCT
																						(t3.municipality_id)
																					FROM
																						PUBLIC .tbl_affected t3
																					LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
																					WHERE
																						disaster_title_id = '$id'
																					AND t4.region_psgc = '$region'
																				)
																		) t1
																) t1
															LEFT JOIN PUBLIC .lib_municipality t2 ON t1.municipality_id = t2. ID
														) t1
													GROUP BY
														t1.iscity
									");

				$query_all_prov_chart = $this->db->query("SELECT
															t3. ID,
															t3.province_name,
															SUM (t1.family_cum) fam_cum
														FROM
															(
																SELECT
																	SUM (t1.family_cum :: NUMERIC) AS family_cum,
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title
																FROM
																	(
																		SELECT
																			SUM (t1.family_cum :: NUMERIC) AS family_cum,
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title
																		FROM
																			PUBLIC .tbl_evacuation_stats t1
																		LEFT JOIN PUBLIC .tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																		LEFT JOIN PUBLIC .lib_municipality t3 ON t1.municipality_id = t3. ID
																		WHERE
																			t1.disaster_title_id = $id
																		GROUP BY
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title
																		UNION ALL
																			(
																				SELECT
																					SUM (t1.family_cum :: NUMERIC) AS family_cum,
																					t1.municipality_id,
																					t3.municipality_name,
																					t2.disaster_title
																				FROM
																					PUBLIC .tbl_evac_outside_stats t1
																				LEFT JOIN PUBLIC .tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN PUBLIC .lib_municipality t3 ON t1.municipality_id = t3. ID
																				WHERE
																					t1.disaster_title_id = $id
																				GROUP BY
																					t1.municipality_id,
																					t3.municipality_name,
																					t2.disaster_title
																			)
																	) t1
																GROUP BY
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title
															) t1
														LEFT JOIN PUBLIC .lib_municipality t2 ON t1.municipality_id = t2. ID
														LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
														WHERE t3.region_psgc = '$region'
														GROUP BY
															t3. ID,
															t3.province_name
														ORDER BY
															t3. ID
									");

				$aff_prov_chart = $query_all_prov_chart->result_array();

				$aff_prov = array();

				$pid = "";

				for ($ii=0; $ii < count($aff_prov_chart); $ii++) { 

					$chars = 'ABCDEF0123456789';
				    $colors = '#';

				    for ( $l = 0; $l < 6; $l++ ) {
				       $colors .= $chars[rand(0, strlen($chars) - 1)];
				    }

					$aff_prov[] = array(
						'name' 			=> $aff_prov_chart[$ii]['province_name'],
						'y' 			=> (int)$aff_prov_chart[$ii]['fam_cum'],
						'drilldown' 	=> $aff_prov_chart[$ii]['province_name'],
						'color' 		=> $colors

					);

					$pid = $aff_prov_chart[$ii]['id'];


					$query_all_munis_chart = $this->db->query("SELECT
																t1.*
															FROM
																(
																	SELECT
																		t3. ID,
																		t3.province_name,
																		t2.municipality_name,
																		t1.family_cum
																	FROM
																		(
																			SELECT
																				SUM (t1.family_cum :: NUMERIC) AS family_cum,
																				t1.municipality_id,
																				t1.municipality_name,
																				t1.disaster_title
																				FROM
																					(
																						SELECT
																							SUM (t1.family_cum :: NUMERIC) AS family_cum,
																							t1.municipality_id,
																							t3.municipality_name,
																							t2.disaster_title
																						FROM
																							public.tbl_evacuation_stats t1
																						LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																						LEFT JOIN public.lib_municipality t3 ON t1.municipality_id = t3. ID
																						WHERE
																							t1.disaster_title_id = $id
																						GROUP BY
																							t1.municipality_id,
																							t3.municipality_name,
																							t2.disaster_title
																						UNION ALL
																							(
																								SELECT
																									SUM (t1.family_cum :: NUMERIC) AS family_cum,
																									t1.municipality_id,
																									t3.municipality_name,
																									t2.disaster_title
																								FROM
																									public.tbl_evac_outside_stats t1
																								LEFT JOIN public.tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																								LEFT JOIN public.lib_municipality t3 ON t1.municipality_id = t3. ID
																								WHERE
																									t1.disaster_title_id = $id
																								GROUP BY
																									t1.municipality_id,
																									t3.municipality_name,
																									t2.disaster_title
																							)
																					) t1
																				GROUP BY
																					t1.municipality_id,
																					t1.municipality_name,
																					t1.disaster_title
																		) t1
																	LEFT JOIN public.lib_municipality t2 ON t1.municipality_id = t2. ID
																	LEFT JOIN public.lib_provinces t3 ON t2.provinceid = t3. ID
																	ORDER BY
																		t3. ID
																) t1
															WHERE t1.id = '$pid'
									");

					$aff_munis_chart = $query_all_munis_chart->result_array();

					$aff_munis = array();

					$aff_munis_drill[] = array();

					for ($iii=0; $iii < count($aff_munis_chart); $iii++) { 

						$chars = 'ABCDEF0123456789';
					    $colors = '#';

					    for ( $ll = 0; $ll < 6; $ll++ ) {
					       $colors .= $chars[rand(0, strlen($chars) - 1)];
					    }

						$aff_munis[] = array(
							'name' 			=> $aff_munis_chart[$iii]['municipality_name'],
							'y' 			=> (int)$aff_munis_chart[$iii]['family_cum'],
							'color' 		=> $colors
						);

						$aff_munis_all[] = array(
							'name' 			=> $aff_munis_chart[$iii]['municipality_name'],
							'y' 			=> (int)$aff_munis_chart[$iii]['family_cum'],
							'color' 		=> $colors
						);
					}

					$aff_munis_drill[] = array(
						'name' 			=> $aff_prov_chart[$ii]['province_name'],
						'id' 			=> $aff_prov_chart[$ii]['province_name'],
						'data' 			=> $aff_munis
					);

				}

				$query_all_brgy_chart = $this->db->query("SELECT
																t1.municipality_id,
																t1.municipality_name,
																t1.brgy_located_ec,
																t2.brgy_name,
																t1.family_cum 
															FROM
																(
																SELECT SUM
																	( t1.family_cum :: NUMERIC ) AS family_cum,
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title,
																	t1.brgy_located_ec 
																FROM
																	(
																	SELECT SUM
																		( t1.family_cum :: NUMERIC ) AS family_cum,
																		t1.municipality_id,
																		t3.municipality_name,
																		t2.disaster_title,
																		t4.brgy_located_ec 
																	FROM
																		PUBLIC.tbl_evacuation_stats t1
																		LEFT JOIN PUBLIC.tbl_disaster_title t2 ON t1.disaster_title_id = t2.
																		ID LEFT JOIN PUBLIC.lib_municipality t3 ON t1.municipality_id = t3.
																		ID LEFT JOIN PUBLIC.tbl_activated_ec t4 ON t1.evacuation_name :: INTEGER = t4.ID 
																	WHERE
																		t1.disaster_title_id = '$id'
																	GROUP BY
																		t1.municipality_id,
																		t3.municipality_name,
																		t2.disaster_title,
																		t4.brgy_located_ec UNION ALL
																		(
																		SELECT SUM
																			( t1.family_cum :: NUMERIC ) AS family_cum,
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title,
																			t1.brgy_host brgy_located_ec 
																		FROM
																			PUBLIC.tbl_evac_outside_stats t1
																			LEFT JOIN PUBLIC.tbl_disaster_title t2 ON t1.disaster_title_id = t2.
																			ID LEFT JOIN PUBLIC.lib_municipality t3 ON t1.municipality_id = t3.ID 
																		WHERE
																			t1.disaster_title_id = '$id'
																		GROUP BY
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title,
																			t1.brgy_host 
																		)) t1 
																GROUP BY
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title,
																	t1.brgy_located_ec 
																) t1
																LEFT JOIN lib_barangay t2 On t1.brgy_located_ec::integer = t2.ID
																WHERE t1.municipality_id = '$mun_id'
					");

				$aff_brgy_chart = $query_all_brgy_chart->result_array();

				$aff_brgy = array();

				for ($vv = 0; $vv < count($aff_brgy_chart); $vv++) { 

					$chars = 'ABCDEF0123456789';
				    $colors = '#';

				    for ( $ll = 0; $ll < 6; $ll++ ) {
				       $colors .= $chars[rand(0, strlen($chars) - 1)];
				    }

					$aff_brgy[] = array(
						'name' 			=> $aff_brgy_chart[$vv]['brgy_name'],
						'y' 			=> (int)$aff_brgy_chart[$vv]['family_cum'],
						'color' 		=> $colors
					);

				}

				$query_brgy_unique_ec = $this->db->query("
														SELECT
															* 
														FROM
															(
															SELECT DISTINCT ON
																( t1.brgy_located_ec, t1.brgy_located ) t1.region_psgc,
																t1.province_id,
																t1.municipality_id,
																t1.brgy_located_ec :: INTEGER,
																t1.brgy_located :: INTEGER 
															FROM
																(
																SELECT
																	* 
																FROM
																	(
																	SELECT
																		t3.region_psgc,
																		t1.province_id,
																		t1.municipality_id,
																		t1.brgy_located_ec,
																		regexp_split_to_table( t2.brgy_located, ',' ) AS brgy_located 
																	FROM
																		tbl_activated_ec t1
																		LEFT JOIN tbl_evacuation_stats t2 ON t1.ID = t2.evacuation_name :: INTEGER 
																		AND t1.dromic_id = t2.dromic_ids
																		LEFT JOIN lib_provinces t3 ON t1.province_id :: INTEGER = t3.ID 
																	WHERE
																		t2.disaster_title_id = '$id' 
																		AND t3.region_psgc = '$region' 
																	) t1 
																) t1 
															) t1 
														ORDER BY
															t1.municipality_id ASC,
															t1.brgy_located_ec ASC,
															t1.brgy_located ASC 
				");

				$query_served_not_displaced = $this->db->query("
														SELECT
															t2.region_psgc,
															t1.*
														FROM
															tbl_not_displaced_served t1 
															LEFT JOIN lib_provinces t2 ON t1.provinceid::character varying = t2.id::character varying 
															WHERE t1.disaster_title_id = '$id'
															AND t2.region_psgc = '$region'
				");


				$data['rs'] 					= $query->result();
				$data['rsoutside'] 				= $query2->result();
				$data['city'] 					= $query1->result();
				$data['brgy'] 					= $querybrgy->result();
				$data['brgys'] 					= $query_brgys->result();
				$data['masterquery'] 			= $masterquery->result();
				$data['masterquery2'] 			= $masterquery2->result();
				$data['masterquery3'] 			= $masterquery3->result();
				$data['query_title'] 			= $query_title->result();
				$data['query_asst'] 			= $query_casualty_title->result();
				$data['query_casualties'] 		= $query_casualties->result();
				$data['query_damage_per_brgy'] 	= $query_dam_per_brgy->result();
				$data['query_all_munis'] 		= $query_all_munis->result();
				$data['aff_prov'] 				= $aff_prov;
				$data['aff_munis_drill'] 		= $aff_munis_drill;
				$data['aff_munis_all'] 			= $aff_munis_all;
				$data['aff_brgy'] 				= $aff_brgy;

				$data['queryecs'] 				= $queryecs->result();

				$data['query_outec'] 			= $query_outec->result();

				$data['query_fnfis'] 			= $query_fnfis->result();

				$data['sex'] 					= $query_sex_gender->result();
				$data['facilities'] 			= $query_facilities->result();

				$data['brgy_unique_ec'] 		= $query_brgy_unique_ec->result();

				$data['all_affected'] 			= $query_all_affected->result();

				$data['fnds'] 					= $query_served_not_displaced->result();

				return $data;
			}
			
		}

		function get_narrative_report($id){

			$query_narrative = $this->db->query("SELECT * FROM tbl_narrative_report t1 WHERE disaster_title_id = '$id' ORDER BY t1.id DESC");

			$data['narrative_report'] 		= $query_narrative->result();

			if($query_narrative->num_rows() > 0){

				return $data;

			}else{

				return 0;
				
			}

		}

		public function get_disasterdetail($id){

			$query = $this->db->where('id', $id);
			$query = $this->db->get('tbl_dromic');

			$query2 = $this->db->query("SELECT t1.* FROM tbl_disaster_title t1 WHERE dromic_id = $id ORDER BY t1.id DESC");
			
			$data['rs'] = $query->result_array();
			$data['rstitle'] = $query2->result_array();

			return $data;

		}

		public function savenewtitle($data){
			$this->db->insert('tbl_disaster_title', $data);
   			$insert_id = $this->db->insert_id();
   			return $insert_id;
		}

		public function savenewec($data){

			$disaster_title_id = $data["disaster_title_id"];

			//str_replace("'","\"",$data["evacuation_name"]);
			$ec 				= str_replace(array("'", "\"", "&quot;"), "&#39",htmlspecialchars($data["evacuation_name"]));
			$province_id 		= $data["provinceid"];
			$municipality_id 	= $data["municipality_id"];

			$brgy_located 		= $data['brgy_located_ec'];

			$ec2 				= strtolower($data["evacuation_name"]);


			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$disaster_title_id'");

			$rs = $query->result_array();

			$dromic_id = $rs[0]["dromic_id"];

			$queryfindec = $this->db->where('dromic_id', (string)$dromic_id);
			$queryfindec = $this->db->where('lower(ec_name)', $ec2);
			$queryfindec = $this->db->where('province_id', $province_id);
			$queryfindec = $this->db->where('municipality_id', $municipality_id);
			$queryfindec = $this->db->where('brgy_located_ec', $brgy_located);
			$queryfindec = $this->db->get('tbl_activated_ec');

			if($queryfindec->num_rows() > 0){

				$ars = $queryfindec->result_array();

				$ecid = $ars[0]["id"];

				$this->db->trans_begin(); 

				$dataec2 = array(
					'disaster_title_id' 	=> $data['disaster_title_id'],
					'municipality_id' 		=> $data['municipality_id'],
					'provinceid' 			=> $data['provinceid'],
					'evacuation_name' 		=> $ecid,
					'family_cum' 			=> $data['family_cum'],
					'family_now' 			=> $data['family_now'],
					'person_cum' 			=> $data['person_cum'],
					'person_now' 			=> $data['person_now'],
					'brgy_located' 			=> $data['brgy_located'],
					'place_of_origin' 		=> "",
					'dromic_ids' 			=> $dromic_id,
					'fourps' 				=> $data['fourps']
				);

				$this->db->insert('tbl_evacuation_stats', $dataec2);

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    return 0;
				}
				else
				{
				    $this->db->trans_commit();

				    $query2_a= $this->db->query("
													SELECT
														t1.brgy_located_ec,
														SUM ( t1.fam_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														(
														SELECT
															* 
														FROM
															(
															SELECT
																t2.brgy_located_ec,
																SUM ( t1.family_cum :: INTEGER ) fam_cum,
																SUM ( t1.person_cum :: INTEGER ) person_cum 
															FROM
																tbl_evacuation_stats t1
																LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
															WHERE
																t1.disaster_title_id = '$disaster_title_id' 
																AND t2.brgy_located_ec = '$brgy_located' 
															GROUP BY
																t2.brgy_located_ec 
															) t1 UNION ALL
															(
															SELECT
																t1.brgy_host,
																SUM ( t1.family_cum :: INTEGER ) fam_cum,
																SUM ( t1.person_cum :: INTEGER ) person_cum 
															FROM
																tbl_evac_outside_stats t1 
															WHERE
																t1.disaster_title_id = '$disaster_title_id' 
																AND t1.brgy_host = '$brgy_located' 
															GROUP BY
															t1.brgy_host 
														)) t1
														GROUP BY
																t1.brgy_located_ec 
					");

					$arr_a = $query2_a->result_array();

					if($query2_a->num_rows() > 0){

						$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND brgy_id = '$brgy_located'");
						$arr2_q = $q_2->result_array();

						$tmp_fam = 0;
						$tmp_per = 0;
						$affected_family = 0;
						$affected_persons = 0;

						if($q_2->num_rows() > 0){

							for($r = 0 ; $r < count($arr2_q) ; $r++){
								$tmp_fam += $arr2_q[$r]["affected_family"];
								$tmp_per += $arr2_q[$r]["affected_persons"];
							}

							if($tmp_fam >= $arr_a[0]['fam_cum']){
								$affected_family = $tmp_fam;
							}else{
								$affected_family = $arr_a[0]['fam_cum'];
							}

							if($tmp_per >= $arr_a[0]['person_cum']){
								$affected_persons = $tmp_per;
							}else{
								$affected_persons = $arr_a[0]['person_cum'];
							}

							$data_ec_up = array(
								'affected_family' 			=> $affected_family,
								'affected_persons' 			=> $affected_persons
							);

							$q_a = $this->db->where('disaster_title_id', $data['disaster_title_id']);
							$q_a = $this->db->where('brgy_id', $data['brgy_located_ec']);
							$q_a = $this->db->update('tbl_damage_per_brgy', $data_ec_up);

						}else{

							$affected_family = $arr_a[0]['fam_cum'];
							$affected_persons = $arr_a[0]['person_cum'];

							$data_ec_ins = array(
								'disaster_title_id' 		=> $data['disaster_title_id'],
								'provinceid' 				=> $data['provinceid'],
								'municipality_id' 			=> $data['municipality_id'],
								'brgy_id' 					=> $data['brgy_located_ec'],
								'totally_damaged' 			=> 0,
								'partially_damaged' 		=> 0,
								'affected_family' 			=> $affected_family,
								'affected_persons' 			=> $affected_persons,
								'costasst_brgy' 			=> 0
							);

							$this->db->insert("tbl_damage_per_brgy",$data_ec_ins);

						}

					}

				    return 1;
				}

			}else{

				$this->db->trans_begin(); 

				//str_replace("'","\'",trtoupper($data["evacuation_name"])),

				$dataec = array(
					"dromic_id" 		=> $dromic_id,
					"ec_name" 			=> $data["evacuation_name"],
					"province_id" 		=> $data["provinceid"],
					"municipality_id" 	=> $data["municipality_id"],
					'brgy_located_ec' 	=> $data['brgy_located_ec'],
					'ec_status' 		=> $data['ec_status'],
					'ec_cum' 			=> $data['ec_cum'],
					'ec_now' 			=> $data['ec_now']
				);

				$this->db->insert('tbl_activated_ec', $dataec);

				$insert_id = $this->db->insert_id();

				$dataec2 = array(
					'disaster_title_id' 	=> $data['disaster_title_id'],
					'municipality_id' 		=> $data['municipality_id'],
					'provinceid' 			=> $data['provinceid'],
					'evacuation_name' 		=> $insert_id,
					'family_cum' 			=> $data['family_cum'],
					'family_now' 			=> $data['family_now'],
					'person_cum' 			=> $data['person_cum'],
					'person_now' 			=> $data['person_now'],
					'brgy_located' 			=> $data['brgy_located'],
					'place_of_origin' 		=> "",
					'dromic_ids' 			=> $dromic_id,
					'fourps' 				=> $data['fourps']
				);

				$this->db->insert('tbl_evacuation_stats', $dataec2);

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    return 0;

				}else{

				    $this->db->trans_commit();

				    $query2_a = $this->db->query("
													SELECT
														t1.brgy_located_ec,
														SUM ( t1.fam_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														(
														SELECT
															* 
														FROM
															(
															SELECT
																t2.brgy_located_ec,
																SUM ( t1.family_cum :: INTEGER ) fam_cum,
																SUM ( t1.person_cum :: INTEGER ) person_cum 
															FROM
																tbl_evacuation_stats t1
																LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
															WHERE
																t1.disaster_title_id = '$disaster_title_id' 
																AND t2.brgy_located_ec = '$brgy_located' 
															GROUP BY
																t2.brgy_located_ec 
															) t1 UNION ALL
															(
															SELECT
																t1.brgy_host,
																SUM ( t1.family_cum :: INTEGER ) fam_cum,
																SUM ( t1.person_cum :: INTEGER ) person_cum 
															FROM
																tbl_evac_outside_stats t1 
															WHERE
																t1.disaster_title_id = '$disaster_title_id' 
																AND t1.brgy_host = '$brgy_located' 
															GROUP BY
															t1.brgy_host 
														)) t1
														GROUP BY
																t1.brgy_located_ec 
					");

					$arr_a = $query2_a->result_array();

					if($query2_a->num_rows() > 0){

						$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND brgy_id = '$brgy_located'");
						$arr2_q = $q_2->result_array();

						$tmp_fam = 0;
						$tmp_per = 0;
						$affected_family = 0;
						$affected_persons = 0;

						if($q_2->num_rows() > 0){

							for($r = 0 ; $r < count($arr2_q) ; $r++){
								$tmp_fam += $arr2_q[$r]["affected_family"];
								$tmp_per += $arr2_q[$r]["affected_persons"];
							}

							if($tmp_fam >= $arr_a[0]['fam_cum']){
								$affected_family = $tmp_fam;
							}else{
								$affected_family = $arr_a[0]['fam_cum'];
							}

							if($tmp_per >= $arr_a[0]['person_cum']){
								$affected_persons = $tmp_per;
							}else{
								$affected_persons = $arr_a[0]['person_cum'];
							}

							$data_ec_up = array(
								'affected_family' 			=> $affected_family,
								'affected_persons' 			=> $affected_persons
							);

							$q_a = $this->db->where('disaster_title_id', $data['disaster_title_id']);
							$q_a = $this->db->where('brgy_id', $data['brgy_located_ec']);
							$q_a = $this->db->update('tbl_damage_per_brgy', $data_ec_up);

						}else{

							$affected_family = $arr_a[0]['fam_cum'];
							$affected_persons = $arr_a[0]['person_cum'];

							$data_ec_ins = array(
								'disaster_title_id' 		=> $data['disaster_title_id'],
								'provinceid' 				=> $data['provinceid'],
								'municipality_id' 			=> $data['municipality_id'],
								'brgy_id' 					=> $data['brgy_located_ec'],
								'totally_damaged' 			=> 0,
								'partially_damaged' 		=> 0,
								'affected_family' 			=> $affected_family,
								'affected_persons' 			=> $affected_persons,
								'costasst_brgy' 			=> 0
							);

							$this->db->insert("tbl_damage_per_brgy", $data_ec_ins);

						}

					}

				    return 1;
				}

			}


		}

		public function getAllEC($uriID,$cid){

			$query = $this->db->query("
										SELECT DISTINCT
											(t1.ec_name) evacuation_name
										FROM
											(
												SELECT DISTINCT
													t1.*, t2.ec_name
												FROM
													tbl_evacuation_stats t1
												LEFT JOIN tbl_activated_ec t2 ON t1.municipality_id :: CHARACTER VARYING = t2.municipality_id :: CHARACTER VARYING
												AND t2.dromic_id ::character varying = t1.dromic_ids :: character varying
												WHERE
													t1.disaster_title_id = '$uriID'
												AND t1.municipality_id = '$cid'
											) t1
			");

			$data['rs'] = $query->result_array();

			$query1 = $this->db->query("
				SELECT
					UPPER(t1.evacuation_name) as evacuation_name
				FROM
					tbl_evacuation_list t1
				WHERE municipality_id = '$cid'
				--WHERE
					--t1.disaster_title_id = $uriID
				--AND t1.municipality_id = $cid
			");

			$data['re'] = $query1->result_array();

			return $data;

		}

		public function getECDetail($id){

			$query = $this->db->query("SELECT
										t1.*, 
										t2.ec_name ec_name,
										t2.ec_cum,
										t2.ec_now,
										t2.brgy_located_ec,
										t2.ec_status
									FROM
										tbl_evacuation_stats t1
									LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name = t2. ID :: CHARACTER VARYING
									WHERE
										t1. ID = '$id'
			");

			$data['rs'] = $query->result_array();

			$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q2 = $this->db->get('lib_municipality');

			$data['city'] = $q2->result_array();

			$q3 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q3 = $this->db->get('lib_barangay');

			$data['brgy'] = $q3->result_array();

			return $data;

		}

		public function getECDetailProfile($id){

			$query = $this->db->query("SELECT
										t1.*, 
										t2.ec_name ec_name,
										t2.ec_cum,
										t2.ec_now,
										t2.brgy_located_ec,
										t2.ec_status
									FROM
										tbl_evacuation_stats t1
									LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name = t2. ID :: CHARACTER VARYING
									WHERE
										t1. ID = '$id'
			");

			$data['rs'] = $query->result_array();

			$dromic_id 	= $data['rs'][0]["dromic_ids"];
			$evacid 	= $data['rs'][0]["evacuation_name"];

			$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q2 = $this->db->get('lib_municipality');

			$data['city'] = $q2->result_array();

			$q3 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q3 = $this->db->get('lib_barangay');

			$data['brgy'] = $q3->result_array();

			$query1 = $this->db->query("SELECT * FROM tbl_sex_gender_data WHERE dromic_id = '$dromic_id' AND evac_id = '$evacid'");

			$data['ecprofile'] = $query1->result_array();

			return $data;

		}

		public function deletesexdata($data){

			$disaster_title_id  = $data['disaster_title_id'];
			$dromic_id  		= $data['dromic_id'];
			$evac_id 			= $data['evac_id'];
			$municipality_id 	= $data['municipality_id'];

			$this->db->where('disaster_title_id', $disaster_title_id);
			$this->db->where('dromic_id', $dromic_id);
			$this->db->where('evac_id', $evac_id);
			$this->db->where('municipality_id', $municipality_id);
			$this->db->delete('tbl_sex_gender_data');

			if($this->db->trans_status() === FALSE){
				 $this->db->trans_rollback();
				 return 0;
			}else{
			    $this->db->trans_commit();
			    return 1;
			}

		}

		public function getECDetailFacility($id){

			$query = $this->db->query("SELECT
										t1.*, 
										t2.ec_name ec_name,
										t2.ec_cum,
										t2.ec_now,
										t2.brgy_located_ec,
										t2.ec_status
									FROM
										tbl_evacuation_stats t1
									LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name = t2. ID :: CHARACTER VARYING
									WHERE
										t1. ID = '$id'
			");

			$data['rs'] = $query->result_array();

			$dromic_id 	= $data['rs'][0]["dromic_ids"];
			$evacid 	= $data['rs'][0]["evacuation_name"];

			$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q2 = $this->db->get('lib_municipality');

			$data['city'] = $q2->result_array();

			$q3 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q3 = $this->db->get('lib_barangay');

			$data['brgy'] = $q3->result_array();

			$query1 = $this->db->query("SELECT * FROM tbl_ec_facilities WHERE dromic_id = '$dromic_id' AND evac_id = '$evacid'");

			$data['ecfacility'] = $query1->result_array();

			return $data;

		}

		public function getAllOrigin($uriID,$cid){

			$query = $this->db->query("
										SELECT
											t1.*,
											t2.municipality_name
										FROM
											lib_barangay t1
										LEFt JOIN lib_municipality t2 ON t1.municipality_id = t2.id
										WHERE
											t1.municipality_id = '$cid'
										ORDER BY
											t1. ID ASC
			");

			return $data['rs'] = $query->result_array();

		}

		public function getAllOriginBrgy($cid){

			$query = $this->db->query("
				SELECT * FROM lib_barangay t1 WHERE t1.municipality_id = $cid ORDER BY t1.id ASC
			");

			return $data['rs'] = $query->result_array();

		}

		public function getAllOriginProvince($uriID,$cid){

			$query1 = $this->db->query("SELECT
										*
									FROM
										lib_municipality t1
									WHERE
										t1.provinceid = $cid
									ORDER BY
										t1. ID ASC
			");

			$data['city'] = $query1->result_array();

			$query2 = $this->db->query("SELECT
										t1.*, t2.municipality_name
									FROM
										lib_barangay t1
									LEFT JOIN lib_municipality t2 ON t1.municipality_id = t2.id
									WHERE
										t1.provinceid = $cid
									ORDER BY
										t1.brgy_name
			");

			$data['rs'] = $query2->result_array();

			return $data;

		}

		public function updateEC($id,$data){

			$disaster_title_id = $data["uriID"];

			$did =  (int)$disaster_title_id;

			$evacuation_center_id = $data['evacuation_center_id'];

			$brgy_located_ec = $data['brgy_located_ec'];

			$dataupactivated_ec = array(
				'ec_name' 			=> $data['evacuation_name'],
				'ec_cum'			=> $data['ec_cum'],
				'ec_now'			=> $data['ec_now'],
				'ec_status'			=> $data['ec_status'],
				'brgy_located_ec'	=> $data['brgy_located_ec'],
			);

			$queryactivatedec = $this->db->where('id', $evacuation_center_id);
			$queryactivatedec = $this->db->update('tbl_activated_ec', $dataupactivated_ec);


			if($queryactivatedec){

				$this->db->trans_begin();

				$disaster_title_id = "";
				$arr = array();

				$dataupec = array( 
					'family_cum'			=> $data['family_cum'],
					'family_now'			=> $data['family_now'],
					'person_cum'			=> $data['person_cum'],
					'person_now'			=> $data['person_now'],
					'brgy_located'			=> $data['brgy_located'],
					'fourps'				=> $data['fourps']
				);

				$query = $this->db->where('id', $id);
				$query = $this->db->update('tbl_evacuation_stats', $dataupec);

				$stat1 = $this->db->trans_status();

				if($stat1 == TRUE){

					if($query){

						$query2_a= $this->db->query("
														SELECT
															t1.brgy_located_ec,
															SUM ( t1.fam_cum :: INTEGER ) fam_cum,
															SUM ( t1.person_cum :: INTEGER ) person_cum 
														FROM
															(
															SELECT
																* 
															FROM
																(
																SELECT
																	t2.brgy_located_ec,
																	SUM ( t1.family_cum :: INTEGER ) fam_cum,
																	SUM ( t1.person_cum :: INTEGER ) person_cum 
																FROM
																	tbl_evacuation_stats t1
																	LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
																WHERE
																	t1.disaster_title_id = $did 
																	AND t2.brgy_located_ec = '$brgy_located_ec' 
																GROUP BY
																	t2.brgy_located_ec 
																) t1 UNION ALL
																(
																SELECT
																	t1.brgy_host,
																	SUM ( t1.family_cum :: INTEGER ) fam_cum,
																	SUM ( t1.person_cum :: INTEGER ) person_cum 
																FROM
																	tbl_evac_outside_stats t1 
																WHERE
																	t1.disaster_title_id = $did
																	AND t1.brgy_host = '$brgy_located_ec' 
																GROUP BY
																t1.brgy_host 
															)) t1
															GROUP BY
																	t1.brgy_located_ec 
						");

						$arr_a = $query2_a->result_array();

						if($query2_a->num_rows() > 0){

							$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$did' AND brgy_id = '$brgy_located_ec'");
							$arr2_q = $q_2->result_array();

							$tmp_fam = 0;
							$tmp_per = 0;
							$affected_family = 0;
							$affected_persons = 0;

							if($q_2->num_rows() > 0){

								for($r = 0 ; $r < count($arr2_q) ; $r++){
									$tmp_fam += $arr2_q[$r]["affected_family"];
									$tmp_per += $arr2_q[$r]["affected_persons"];
								}

								if($tmp_fam >= $arr_a[0]['fam_cum']){
									$affected_family = $tmp_fam;
								}else{
									$affected_family = $arr_a[0]['fam_cum'];
								}

								if($tmp_per >= $arr_a[0]['person_cum']){
									$affected_persons = $tmp_per;
								}else{
									$affected_persons = $arr_a[0]['person_cum'];
								}

								$data_ec_up = array(
									'affected_family' 			=> $affected_family,
									'affected_persons' 			=> $affected_persons
								);

								$q_a = $this->db->where('disaster_title_id', $did);
								$q_a = $this->db->where('brgy_id', $brgy_located_ec);
								$q_a = $this->db->update('tbl_damage_per_brgy', $data_ec_up);

							}

						}


						$q2 = $this->db->where('id', $id);
						$q2 = $this->db->get('tbl_evacuation_stats');

						$arr = $q2->result_array();

						$disaster_title_id = $arr[0]['disaster_title_id'];

						$ecname = $data['evacuation_center_id'];

						$data2 = array(
							'family_now' => 0,
							'person_now' => 0
						);

						if(strtolower($data['ec_status']) == 'closed'){

							$query3 = $this->db->where('evacuation_name', $ecname);
							$query3 = $this->db->where('disaster_title_id', $disaster_title_id);
							$query3 = $this->db->update('tbl_evacuation_stats', $data2);

							$stat2 = $this->db->trans_status();

							if($stat2 == TRUE){

								$this->db->trans_commit();

								return 1;

							}else{

								$this->db->trans_rollback();

								return 0;

							}

						}else{

							$this->db->trans_commit();
							return 1;

						}
					}else{

						$this->db->trans_rollback();
						return 0;
					}

				}else{

					$this->db->trans_rollback();
					return 0;

				}

			}else{
				return 0;
			}

		}

		public function getECMain($id){
			$query = $this->db->where('id', $id);
			$query = $this->db->get('tbl_disaster_title');
			return $query->result_array();
		}

		public function saveasnewrecordEC($data,$oid){

			$query = $this->db->insert('tbl_disaster_title',$data);

			$dromic_id = "";

			if($query){

				$insert_id = $this->db->insert_id();

				$q1 = $this->db->where('disaster_title_id', $oid);
				$q1 = $this->db->get('tbl_evacuation_stats');

				$data['rs'] = $q1->result_array();

				$dromic_id = $data['rs'][0]['dromic_ids'];

				for($i = 0 ; $i < count($data['rs']) ; $i++){

					$datai = array(	
						'disaster_title_id' 	=> $insert_id,
						'municipality_id' 		=> $data['rs'][$i]['municipality_id'], 
						'provinceid' 			=> $data['rs'][$i]['provinceid'],  
						'evacuation_name' 		=> $data['rs'][$i]['evacuation_name'], 
						'family_cum' 			=> $data['rs'][$i]['family_cum'], 
						'family_now' 			=> $data['rs'][$i]['family_now'], 
						'person_cum' 			=> $data['rs'][$i]['person_cum'], 
						'person_now' 			=> $data['rs'][$i]['person_now'], 
						'place_of_origin' 		=> $data['rs'][$i]['place_of_origin'], 
						'brgy_located' 			=> $data['rs'][$i]['brgy_located'],
						'dromic_ids' 			=> $data['rs'][$i]['dromic_ids'],
						'fourps' 				=> $data['rs'][$i]['fourps']
					); 

					$q1_a= $this->db->insert('tbl_evacuation_stats',$datai);

				}

				$q2 = $this->db->where('disaster_title_id', $oid);
				$q2 = $this->db->get('tbl_evac_outside_stats');

				$data['rs'] = $q2->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){
					$datai = array(	
						'disaster_title_id' 	=> $insert_id,
						'municipality_id' 		=> $data['rs'][$i]['municipality_id'],
						'provinceid' 			=> $data['rs'][$i]['provinceid'],
						'family_cum' 			=> $data['rs'][$i]['family_cum'],
						'family_now' 			=> $data['rs'][$i]['family_now'],
						'person_cum' 			=> $data['rs'][$i]['person_cum'],
						'person_now' 			=> $data['rs'][$i]['person_now'],
						'brgy_host' 			=> $data['rs'][$i]['brgy_host'],
						'brgy_origin' 			=> $data['rs'][$i]['brgy_origin'],
						'municipality_origin' 	=> $data['rs'][$i]['municipality_origin'],
						'province_origin' 		=> $data['rs'][$i]['province_origin'],
					);
					$q2_a= $this->db->insert('tbl_evac_outside_stats',$datai);
				}

				$q3 = $this->db->where('disaster_title_id', $oid);
				$q3 = $this->db->get('tbl_casualty_asst');

				$data['rs'] = $q3->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){
					$datai = array(	
						'disaster_title_id' 	=> $insert_id,
						'municipality_id' 		=> $data['rs'][$i]['municipality_id'],
						'provinceid' 			=> $data['rs'][$i]['provinceid'],
						'totally_damaged' 		=> $data['rs'][$i]['totally_damaged'],
						'partially_damaged' 	=> $data['rs'][$i]['partially_damaged'],
						'dswd_asst' 			=> $data['rs'][$i]['dswd_asst'],
						'lgu_asst' 				=> $data['rs'][$i]['lgu_asst'],
						'ngo_asst' 				=> $data['rs'][$i]['ngo_asst'],
						'ogo_asst' 				=> $data['rs'][$i]['ogo_asst'],
						'brgy_id' 				=> $data['rs'][$i]['brgy_id']

					);
					$q3_a= $this->db->insert('tbl_casualty_asst',$datai);
				}

				$q4 = $this->db->where('disaster_title_id', $oid);
				$q4 = $this->db->get('tbl_casualty');

				$data['rs'] = $q4->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){
					$datai = array(	
						'disaster_title_id' 	=> $insert_id,
						'lastname' 				=> $data['rs'][$i]['lastname'],
						'firstname' 			=> $data['rs'][$i]['firstname'],
						'middle_i' 				=> $data['rs'][$i]['middle_i'],
						'gender' 				=> $data['rs'][$i]['gender'],
						'provinceid' 			=> $data['rs'][$i]['provinceid'],
						'municipalityid' 		=> $data['rs'][$i]['municipalityid'],
						'brgyname' 				=> $data['rs'][$i]['brgyname'],
						'isdead' 				=> $data['rs'][$i]['isdead'],
						'ismissing' 			=> $data['rs'][$i]['ismissing'],
						'isinjured' 			=> $data['rs'][$i]['isinjured'],
						'remarks' 				=> $data['rs'][$i]['remarks'],
						'age' 					=> $data['rs'][$i]['age']
					);
					$q4_a= $this->db->insert('tbl_casualty',$datai);
				}

				$q5 = $this->db->where('disaster_title_id', $oid);
				$q5 = $this->db->get('tbl_fnfi_assistance');

				$data['rs'] = $q5->result_array();

				for($k = 0 ; $k < count($data['rs']) ; $k++){
					$datai = array(	
						'disaster_title_id' 	=> $insert_id,
						'provinceid' 			=> $data['rs'][$k]['provinceid'],
						'municipality_id' 		=> $data['rs'][$k]['municipality_id'],
						'family_served' 		=> $data['rs'][$k]['family_served'],
						'remarks' 				=> $data['rs'][$k]['remarks']
					);

					$id = $data['rs'][$k]['id'];
					$q5_a= $this->db->insert('tbl_fnfi_assistance',$datai);
					$insert_id1 = $this->db->insert_id();

					$q6 = $this->db->where('fnfi_assistance_id', $id);
					$q6 = $this->db->get('tbl_fnfi_assistance_list');

					$arr['rs'] = $q6->result_array();

					for($i = 0 ; $i < count($arr['rs']) ; $i++){
						$datai = array(	
							'fnfi_assistance_id' 	=> $insert_id1,
							'fnfi_name' 			=> $arr['rs'][$i]['fnfi_name'],
							'cost' 					=> $arr['rs'][$i]['cost'],
							'quantity' 				=> $arr['rs'][$i]['quantity'],
							'date_augmented' 		=> $arr['rs'][$i]['date_augmented'],
							'fnfitype' 				=> $arr['rs'][$i]['fnfitype']
						);
						$q6_a= $this->db->insert('tbl_fnfi_assistance_list',$datai);
					}
				}


				$q7 = $this->db->where('disaster_title_id',$oid);
				$q7 = $this->db->get('tbl_damage_per_brgy');

				$data['rs'] = $q7->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){

					$datai = array(	
						'disaster_title_id' 	=> $insert_id,
						'provinceid' 			=> $data['rs'][$i]['provinceid'],
						'municipality_id' 		=> $data['rs'][$i]['municipality_id'],
						'brgy_id' 				=> $data['rs'][$i]['brgy_id'],
						'totally_damaged' 		=> $data['rs'][$i]['totally_damaged'],
						'partially_damaged' 	=> $data['rs'][$i]['partially_damaged'],
						'costasst_brgy' 		=> $data['rs'][$i]['costasst_brgy'],
						'affected_family' 		=> $data['rs'][$i]['affected_family'],
						'affected_persons' 		=> $data['rs'][$i]['affected_persons'],
					);

					$q7_a= $this->db->insert('tbl_damage_per_brgy',$datai);

				}

				$q8 = $this->db->where('disaster_title_id',$oid);
				$q8 = $this->db->get('tbl_ec_facilities');

				$data['rs'] = $q8->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){

					$dataecfacility = array(	
						'disaster_title_id' 		=> $insert_id,
						'province_id' 				=> $data['rs'][$i]['province_id'],			
						'municipality_id' 			=> $data['rs'][$i]['municipality_id'],		
						'disaster_title_id' 		=> $data['rs'][$i]['disaster_title_id'],		
						'dromic_id' 				=> $data['rs'][$i]['dromic_id'],			
						'bathing_cubicles_male' 	=> $data['rs'][$i]['bathing_cubicles_male'],	
						'bathing_cubicles_female' 	=> $data['rs'][$i]['bathing_cubicles_female'],
						'compost_pit' 				=> $data['rs'][$i]['compost_pit'],			
						'sealed'					=> $data['rs'][$i]['sealed'],					
						'portalets_male' 			=> $data['rs'][$i]['portalets_male'],			
						'portalets_female' 			=> $data['rs'][$i]['portalets_female'],		
						'portalets_common' 			=> $data['rs'][$i]['portalets_common'],		
						'bathing_cubicles_common' 	=> $data['rs'][$i]['bathing_cubicles_common'],
						'child_space' 				=> $data['rs'][$i]['child_space'], 			
						'women_space' 				=> $data['rs'][$i]['women_space'],			
						'couple_room' 				=> $data['rs'][$i]['couple_room'],			
						'prayer_room' 				=> $data['rs'][$i]['prayer_room'],			
						'community_kitchen' 		=> $data['rs'][$i]['community_kitchen'],		
						'wash' 						=> $data['rs'][$i]['wash'], 					
						'ramps' 					=> $data['rs'][$i]['ramps'], 					
						'help_desk' 				=> $data['rs'][$i]['help_desk'],				
						'capacity' 					=> $data['rs'][$i]['capacity'],				
						'no_of_rooms' 				=> $data['rs'][$i]['no_of_rooms']			
					);

					$q8_a= $this->db->insert('tbl_ec_facilities',$dataecfacility);

				}

				$q9 = $this->db->where('disaster_title_id',$oid);
				$q9 = $this->db->get('tbl_sex_gender_data');

				$data['rs'] = $q9->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){

					$dataecprofile = array(	
						'disaster_title_id' 		=> $insert_id,
						'province_id' 				=> $data['rs'][$i]['province_id'], 
						'municipality_id' 			=> $data['rs'][$i]['municipality_id'], 
						'dromic_id' 				=> $data['rs'][$i]['dromic_id'],
						'evac_id' 					=> $data['rs'][$i]['evac_id'], 
						'infant_male_cum' 		 	=> $data['rs'][$i]['infant_male_cum'], 
						'infant_male_now' 		 	=> $data['rs'][$i]['infant_male_now'], 
						'infant_female_cum' 		=> $data['rs'][$i]['infant_female_cum'], 
						'infant_female_now' 		=> $data['rs'][$i]['infant_female_now'], 
						'toddler_male_cum' 		 	=> $data['rs'][$i]['toddler_male_cum'], 
						'toddler_male_now' 		 	=> $data['rs'][$i]['toddler_male_now'], 
						'toddler_female_cum' 		=> $data['rs'][$i]['toddler_female_cum'], 
						'toddler_female_now' 		=> $data['rs'][$i]['toddler_female_now'], 
						'preschooler_male_cum' 	 	=> $data['rs'][$i]['preschooler_male_cum'], 
						'preschooler_male_now' 	 	=> $data['rs'][$i]['preschooler_male_now'], 
						'preschooler_female_cum' 	=> $data['rs'][$i]['preschooler_female_cum'], 
						'preschooler_female_now' 	=> $data['rs'][$i]['preschooler_female_now'], 
						'schoolage_male_cum' 		=> $data['rs'][$i]['schoolage_male_cum'], 
						'schoolage_male_now' 		=> $data['rs'][$i]['schoolage_male_now'], 
						'schoolage_female_cum' 	 	=> $data['rs'][$i]['schoolage_female_cum'], 
						'schoolage_female_now' 	 	=> $data['rs'][$i]['schoolage_female_now'], 
						'teenage_male_cum' 		 	=> $data['rs'][$i]['teenage_male_cum'], 
						'teenage_male_now' 		 	=> $data['rs'][$i]['teenage_male_now'], 
						'teenage_female_cum' 		=> $data['rs'][$i]['teenage_female_cum'], 
						'teenage_female_now' 		=> $data['rs'][$i]['teenage_female_now'], 
						'adult_male_cum' 			=> $data['rs'][$i]['adult_male_cum'], 
						'adult_male_now' 			=> $data['rs'][$i]['adult_male_now'], 
						'adult_female_cum' 		 	=> $data['rs'][$i]['adult_female_cum'], 
						'adult_female_now' 		 	=> $data['rs'][$i]['adult_female_now'], 
						'senior_male_cum' 		 	=> $data['rs'][$i]['senior_male_cum'], 
						'senior_male_now' 		 	=> $data['rs'][$i]['senior_male_now'], 
						'senior_female_cum' 		=> $data['rs'][$i]['senior_female_cum'], 
						'senior_female_now' 		=> $data['rs'][$i]['senior_female_now'], 
						'pregnant_cum' 			 	=> $data['rs'][$i]['pregnant_cum'], 
						'pregnant_now' 			 	=> $data['rs'][$i]['pregnant_now'], 
						'lactating_cum' 			=> $data['rs'][$i]['lactating_cum'], 
						'lactating_now' 			=> $data['rs'][$i]['lactating_now'], 
						'solo_cum' 		 			=> $data['rs'][$i]['solo_cum'], 
						'solo_now' 		 			=> $data['rs'][$i]['solo_now'], 
						'ip_cum' 		 			=> $data['rs'][$i]['ip_cum'], 
						'ip_now' 		 			=> $data['rs'][$i]['ip_now'], 
						'disable_male_cum' 			=> $data['rs'][$i]['disable_male_cum'], 
						'disable_male_now' 			=> $data['rs'][$i]['disable_male_now'], 
						'disable_female_cum' 		=> $data['rs'][$i]['disable_female_cum'], 
						'disable_female_now' 		=> $data['rs'][$i]['disable_female_now']			
					);

					$q9_a= $this->db->insert('tbl_sex_gender_data',$dataecprofile);

				}


				$this->db->query("
					UPDATE tbl_activated_ec set ec_status = 'Existing' 
					WHERE dromic_id = '$dromic_id' 
					AND ((lower(ec_status) = lower('newly-opened')) OR (lower(ec_status) = lower('re-activated')))
				");

				$q10 = $this->db->where('disaster_title_id',$oid);
				$q10 = $this->db->get('tbl_not_displaced_served');

				$data['rs'] = $q10->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){

					$datafnds = array(	
						'disaster_title_id' 		=> $insert_id,
						'provinceid' 				=> $data['rs'][$i]['provinceid'], 
						'municipality_id' 			=> $data['rs'][$i]['municipality_id'],  
						'families_served_cum' 		=> $data['rs'][$i]['families_served_cum'], 
						'families_served_now' 		=> $data['rs'][$i]['families_served_now'], 
						'persons_served_cum' 		=> $data['rs'][$i]['persons_served_cum'], 
						'persons_served_now' 		=> $data['rs'][$i]['persons_served_now']			
					);

					$q10_a= $this->db->insert('tbl_not_displaced_served',$datafnds);

				}

 
				return $insert_id;

			}

		}

		public function saveasnewDamAss($data){

			$disaster_title_id 		= $data['disaster_title_id'];
			$municipality_id 		= $data['municipality_id'];
			$provinceid 			= $data['provinceid'];

			$query = $this->db->where('municipality_id',$municipality_id);
			$query = $this->db->where('provinceid',$provinceid);
			$query = $this->db->where('disaster_title_id',$disaster_title_id);
			$query = $this->db->get('tbl_casualty_asst');

			$result = $query->result_array();

			if(count($query->result_array()) > 0){

				$id = $result[0]['id'];

				$data = array(
					'municipality_id' 	=> $_GET['municipality_id'],
					'provinceid' 		=> $_GET['provinceid'],
					'lgu_asst' 			=> $_GET['lgu_asst'],
					'ngo_asst' 			=> $_GET['ngo_asst'],
					'ogo_asst' 			=> $_GET['ogo_asst']
				);

				$this->db->trans_start();

				try{

					$query = $this->db->where('id', $id);
					$query = $this->db->update('tbl_casualty_asst', $data);

					$this->db->trans_commit();

					return 1;
                                    
				}catch(Exception $e){

					$this->db->trans_commit();

					return 0;
				}


			}else{

				$q = $this->db->insert('tbl_casualty_asst',$data);
				if($q){
					return 1;
				}

			}
			

		}

		public function getDamAss($id){

			$q1 = $this->db->where('id', $id);
			$q1 = $this->db->get('tbl_casualty_asst');

			$data['rs'] = $q1->result_array();

			$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q2 = $this->db->get('lib_municipality');

			$data['city'] = $q2->result_array();
			return $data;

		}

		public function getDamAssMain($municipality_id, $id){

			$q1 = $this->db->where('disaster_title_id', $id);
			$q1 = $this->db->where('municipality_id', $municipality_id);
			$q1 = $this->db->get('tbl_casualty_asst');

			$data['rs'] = $q1->result_array();

			if(count($q1->result_array()) > 0){

				$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
				$q2 = $this->db->get('lib_municipality');

				$data['city'] = $q2->result_array();
				return $data;

			}else{

				$q2 = $this->db->where('id', $municipality_id);
				$q2 = $this->db->get('lib_municipality');

				$arr = $q2->result_array();

				$q3 = $this->db->where('provinceid', $arr[0]['provinceid']);
				$q3 = $this->db->get('lib_municipality');

				$data['city'] = $q3->result_array();

				$data['rs'][0]['municipality_id'] = $municipality_id;

				return $data;

			}

		}

		public function getAllAffected($municipality_id, $id){

			$q1 = $this->db->where('disaster_title_id', $id);
			$q1 = $this->db->where('municipality_id', $municipality_id);
			$q1 = $this->db->get('tbl_affected');

			$data['rs'] = $q1->result_array();

			if(count($q1->result_array()) > 0){

				$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
				$q2 = $this->db->get('lib_municipality');

				$data['city'] = $q2->result_array();
				return $data;

			}else{

				$q2 = $this->db->where('id', $municipality_id);
				$q2 = $this->db->get('lib_municipality');

				$arr = $q2->result_array();

				$q3 = $this->db->where('provinceid', $arr[0]['provinceid']);
				$q3 = $this->db->get('lib_municipality');

				$data['city'] = $q3->result_array();

				$data['rs'][0]['municipality_id'] = $municipality_id;

				return $data;

			}

		}


		public function updateDamAss($data,$id){

			$query = $this->db->where('id', $id);
			$query = $this->db->update('tbl_casualty_asst', $data);

			if($query){
				return 1;
			}else{
				return 0;
			}

		}

		public function savenewfamOEC($data){

			$disaster_title_id = $data["disaster_title_id"];
			$brgy_located = $data["brgy_host"];

			$q = $this->db->insert('tbl_evac_outside_stats',$data);

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();

			    $query2_a= $this->db->query("
												SELECT
													t1.brgy_located_ec,
													SUM ( t1.fam_cum :: INTEGER ) fam_cum,
													SUM ( t1.person_cum :: INTEGER ) person_cum 
												FROM
													(
													SELECT
														* 
													FROM
														(
														SELECT
															t2.brgy_located_ec,
															SUM ( t1.family_cum :: INTEGER ) fam_cum,
															SUM ( t1.person_cum :: INTEGER ) person_cum 
														FROM
															tbl_evacuation_stats t1
															LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
														WHERE
															t1.disaster_title_id = '$disaster_title_id' 
															AND t2.brgy_located_ec = '$brgy_located' 
														GROUP BY
															t2.brgy_located_ec 
														) t1 UNION ALL
														(
														SELECT
															t1.brgy_host,
															SUM ( t1.family_cum :: INTEGER ) fam_cum,
															SUM ( t1.person_cum :: INTEGER ) person_cum 
														FROM
															tbl_evac_outside_stats t1 
														WHERE
															t1.disaster_title_id = '$disaster_title_id' 
															AND t1.brgy_host = '$brgy_located' 
														GROUP BY
														t1.brgy_host 
													)) t1
													GROUP BY
															t1.brgy_located_ec 
				");

				$arr_a = $query2_a->result_array();

				if($query2_a->num_rows() > 0){

					$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND brgy_id = '$brgy_located'");
					$arr2_q = $q_2->result_array();

					$tmp_fam = 0;
					$tmp_per = 0;
					$affected_family = 0;
					$affected_persons = 0;

					if($q_2->num_rows() > 0){

						for($r = 0 ; $r < count($arr2_q) ; $r++){
							$tmp_fam += $arr2_q[$r]["affected_family"];
							$tmp_per += $arr2_q[$r]["affected_persons"];
						}

						if($tmp_fam >= $arr_a[0]['fam_cum']){
							$affected_family = $tmp_fam;
						}else{
							$affected_family = $arr_a[0]['fam_cum'];
						}

						if($tmp_per >= $arr_a[0]['person_cum']){
							$affected_persons = $tmp_per;
						}else{
							$affected_persons = $arr_a[0]['person_cum'];
						}

						$data_ec_up = array(
							'affected_family' 			=> $affected_family,
							'affected_persons' 			=> $affected_persons
						);

						$q_a = $this->db->where('disaster_title_id', $data['disaster_title_id']);
						$q_a = $this->db->where('brgy_id', $data['brgy_host']);
						$q_a = $this->db->update('tbl_damage_per_brgy', $data_ec_up);

					}else{

						$affected_family = $arr_a[0]['fam_cum'];
						$affected_persons = $arr_a[0]['person_cum'];

						$data_ec_ins = array(
							'disaster_title_id' 		=> $data['disaster_title_id'],
							'provinceid' 				=> $data['provinceid'],
							'municipality_id' 			=> $data['municipality_id'],
							'brgy_id' 					=> $data['brgy_host'],
							'totally_damaged' 			=> 0,
							'partially_damaged' 		=> 0,
							'affected_family' 			=> $affected_family,
							'affected_persons' 			=> $affected_persons,
							'costasst_brgy' 			=> 0
						);

						$this->db->insert("tbl_damage_per_brgy",$data_ec_ins);

					}

				}

			    return 1;
			}

		}

		public function getFamOEC($id){

			session_start();

			$q1 = $this->db->where('id', $id);
			$q1 = $this->db->get('tbl_evac_outside_stats');

			$arr = $q1->result_array();

			$data['rs'] = $q1->result_array();

			$provinceid 		= $arr[0]['provinceid'];
			$municipality_id 	= $arr[0]['municipality_id'];

			$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q2 = $this->db->get('lib_municipality');

			$data['city'] = $q2->result_array();

			$q3 = $this->db->where('municipality_id', $data['rs'][0]['municipality_id']);
			$q3 = $this->db->get('lib_barangay');

			$data['brgy'] = $q3->result_array();

			$q2 = $this->db->where('provinceid', $provinceid);
			$q2 = $this->db->get('lib_municipality');

			$data['city2'] = $q2->result_array();

			$q4 = $this->db->where('municipality_id', $municipality_id);
			$q4 = $this->db->get('lib_barangay');

			$data['brgy2'] = $q4->result_array();

			$q5 = $this->db->order_by('id');
			$q5 = $this->db->get('lib_provinces');

			$data['provinces'] = $q5->result_array();

			return $data;


		}

		public function updateFamOEC($data,$id,$disaster_title_id){

			$this->db->trans_start();

			$brgy_located = $data['brgy_host'];

			try{

				$query = $this->db->where('id', $id);
				$query = $this->db->update('tbl_evac_outside_stats', $data);

				$query2_a= $this->db->query("
												SELECT
													t1.brgy_located_ec,
													SUM ( t1.fam_cum :: INTEGER ) fam_cum,
													SUM ( t1.person_cum :: INTEGER ) person_cum 
												FROM
													(
													SELECT
														* 
													FROM
														(
														SELECT
															t2.brgy_located_ec,
															SUM ( t1.family_cum :: INTEGER ) fam_cum,
															SUM ( t1.person_cum :: INTEGER ) person_cum 
														FROM
															tbl_evacuation_stats t1
															LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
														WHERE
															t1.disaster_title_id = '$disaster_title_id' 
															AND t2.brgy_located_ec = '$brgy_located' 
														GROUP BY
															t2.brgy_located_ec 
														) t1 UNION ALL
														(
														SELECT
															t1.brgy_host,
															SUM ( t1.family_cum :: INTEGER ) fam_cum,
															SUM ( t1.person_cum :: INTEGER ) person_cum 
														FROM
															tbl_evac_outside_stats t1 
														WHERE
															t1.disaster_title_id = '$disaster_title_id' 
															AND t1.brgy_host = '$brgy_located' 
														GROUP BY
														t1.brgy_host 
													)) t1
													GROUP BY
															t1.brgy_located_ec 
				");

				$arr_a = $query2_a->result_array();

				if($query2_a->num_rows() > 0){

					$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND brgy_id = '$brgy_located'");
					$arr2_q = $q_2->result_array();

					$tmp_fam = 0;
					$tmp_per = 0;
					$affected_family = 0;
					$affected_persons = 0;

					if($q_2->num_rows() > 0){

						for($r = 0 ; $r < count($arr2_q) ; $r++){
							$tmp_fam += $arr2_q[$r]["affected_family"];
							$tmp_per += $arr2_q[$r]["affected_persons"];
						}

						if($tmp_fam >= $arr_a[0]['fam_cum']){
							$affected_family = $tmp_fam;
						}else{
							$affected_family = $arr_a[0]['fam_cum'];
						}

						if($tmp_per >= $arr_a[0]['person_cum']){
							$affected_persons = $tmp_per;
						}else{
							$affected_persons = $arr_a[0]['person_cum'];
						}

						$data_ec_up = array(
							'affected_family' 			=> $affected_family,
							'affected_persons' 			=> $affected_persons
						);

						$q_a = $this->db->where('disaster_title_id', $disaster_title_id);
						$q_a = $this->db->where('brgy_id', $data['brgy_host']);
						$q_a = $this->db->update('tbl_damage_per_brgy', $data_ec_up);
					}

				}

				$this->db->trans_commit();
			    return 1;

			}catch(Exception $e){

				$this->db->trans_rollback();
				return 0;

			}

		}

		public function savenewCAS($data){

			$q = $this->db->insert('tbl_casualty',$data);

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();
			    return 1;
			}

		}

		public function getCasualty($id){
			$q1 = $this->db->where('id', $id);
			$q1 = $this->db->get('tbl_casualty');

			$data['rs'] = $q1->result_array();

			$q2 = $this->db->where('provinceid', $data['rs'][0]['provinceid']);
			$q2 = $this->db->get('lib_municipality');

			$data['city'] = $q2->result_array();
			return $data;
		}

		public function updateCAS($data,$id){

			$query = $this->db->where('id', $id);
			$query = $this->db->update('tbl_casualty', $data);

			if($query){
				return 1;
			}else{
				return 0;
			}

		}

		public function countEOpCen(){

			$count = 0;
			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												evacuation_name,
												ecstatus,
												fam_no,
												person_no,
												place_of_origin,
												disaster_name,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_eopcen
										WHERE rstatus = 'NOT READ'
										ORDER BY
											province_name DESC,
											municipality_name DESC,
											evacuation_name DESC,
											ecstatus DESC,
											fam_no DESC,
											person_no DESC,
											place_of_origin DESC,
											disaster_name DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE DESC

								");

			$count = $count + $q1->num_rows();

			$data['inec'] = $q1->num_rows();
			$data['inecdet'] = $q1->result_array();

			$q2 = $this->db->query("SELECT DISTINCT
											ON (
												disaster_name,
												province_name,
												municipality_name,
												tot_damaged,
												part_damaged,
												dead,
												missing,
												injured,
												dswd_asst,
												lgu_asst,
												ngo_asst,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_casualty_asstm
										WHERE rstatus = 'NOT READ'
										ORDER BY
											disaster_name DESC,
											province_name DESC,
											municipality_name DESC,
											tot_damaged DESC,
											part_damaged DESC,
											dead DESC,
											missing DESC,
											injured DESC,
											dswd_asst DESC,
											lgu_asst DESC,
											ngo_asst DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE DESC
								");
			$count = $count + $q2->num_rows();

			$data['damass'] = $q2->num_rows();
			$data['damassdet'] = $q2->result_array();

			$q3 = $this->db->query("SELECT DISTINCT
											ON (
												disaster_name,
												province_name,
												municipality_name,
												lname,
												fname,
												mi,
												age,
												gender,
												brgyname,
												isdead,
												ismissing,
												isinjured,
												remarks,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_casualtym
										WHERE rstatus = 'NOT READ'
										ORDER BY
											disaster_name DESC,
											province_name DESC,
											municipality_name DESC,
											lname DESC,
											fname DESC,
											mi DESC,
											age DESC,
											gender DESC,
											brgyname DESC,
											isdead DESC,
											ismissing DESC,
											isinjured DESC,
											remarks DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE DESC");
			$count = $count + $q3->num_rows();

			$data['casualty'] = $q3->num_rows();
			$data['casualtydet'] = $q3->result_array();

			$q4 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												brgy,
												fam_no,
												person_no,
												disaster_name,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_outecm_a
										WHERE rstatus = 'NOT READ'
										ORDER BY
											province_name DESC,
											municipality_name DESC,
											brgy DESC,
											fam_no DESC,
											person_no DESC,
											disaster_name DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE	DESC");
			$count = $count + $q4->num_rows();

			$data['outec'] = $q4->num_rows();
			$data['outecdet'] = $q4->result_array();

			$q5 = $this->db->query("SELECT DISTINCT
										ON (
											pics,
											description,
											rstatus,
											ddate :: DATE,
											dtime :: TIME WITHOUT TIME ZONE,
											isnotified
										) *
									FROM
										tbl_images t1
									WHERE rstatus = 'NOT READ'
									ORDER BY
										t1.pics DESC,
										t1.description DESC,
										t1.rstatus DESC,
										t1.ddate :: DATE DESC,
										t1.dtime :: TIME WITHOUT TIME ZONE DESC");
			$count = $count + $q5->num_rows();

			$data['uppics'] = $q5->num_rows();
			$data['uppicsdet'] = $q5->result_array();

			$q6 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												disaster_name,
												brgy_name,
												part_damage,
												tot_damage,
												dead,
												missing,
												injured,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_damagesm
										ORDER BY
											province_name DESC,
											municipality_name DESC,
											disaster_name DESC,
											brgy_name DESC,
											part_damage DESC,
											tot_damage DESC,
											dead DESC,
											missing DESC,
											injured DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE	DESC
									");
			$count = $count + $q6->num_rows();

			$data['cdamage'] = $q6->num_rows();
			$data['cdamagedet'] = $q6->result_array();

			$data['allcount'] = $count;

			return $data;

		}

		public function radarphp(){

			$a = file_get_contents("http://www1.pagasa.dost.gov.ph/images/radar/mosaic/mosaic_rain_radar.php");
			return $a;
			
		}

		public function cinec(){
			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												evacuation_name,
												ecstatus,
												fam_no,
												person_no,
												place_of_origin,
												disaster_name,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_eopcen
										ORDER BY
											province_name DESC,
											municipality_name DESC,
											evacuation_name DESC,
											ecstatus DESC,
											fam_no DESC,
											person_no DESC,
											place_of_origin DESC,
											disaster_name DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE DESC
									");
			return $q1->result_array();
		}

		public function coutec(){
			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												brgy,
												fam_no,
												person_no,
												disaster_name,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_outecm_a
										ORDER BY
											province_name DESC,
											municipality_name DESC,
											brgy DESC,
											fam_no DESC,
											person_no DESC,
											disaster_name DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE	DESC
									");
			return $q1->result_array();
		}

		public function cdamage(){
			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												disaster_name,
												brgy_name,
												part_damage,
												tot_damage,
												dead,
												missing,
												injured,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_damagesm
										ORDER BY
											province_name DESC,
											municipality_name DESC,
											disaster_name DESC,
											brgy_name DESC,
											part_damage DESC,
											tot_damage DESC,
											dead DESC,
											missing DESC,
											injured DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE	DESC
									");
			return $q1->result_array();
		}

		public function cdamass(){
			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												disaster_name,
												province_name,
												municipality_name,
												tot_damaged,
												part_damaged,
												dead,
												missing,
												injured,
												dswd_asst,
												lgu_asst,
												ngo_asst,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_casualty_asstm
										ORDER BY
											disaster_name DESC,
											province_name DESC,
											municipality_name DESC,
											tot_damaged DESC,
											part_damaged DESC,
											dead DESC,
											missing DESC,
											injured DESC,
											dswd_asst DESC,
											lgu_asst DESC,
											ngo_asst DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE DESC
									");
			return $q1->result_array();
		}

		public function ccasualty(){
			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												disaster_name,
												province_name,
												municipality_name,
												lname,
												fname,
												mi,
												age,
												gender,
												brgyname,
												isdead,
												ismissing,
												isinjured,
												remarks,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_casualtym
										ORDER BY
											disaster_name DESC,
											province_name DESC,
											municipality_name DESC,
											lname DESC,
											fname DESC,
											mi DESC,
											age DESC,
											gender DESC,
											brgyname DESC,
											isdead DESC,
											ismissing DESC,
											isinjured DESC,
											remarks DESC,
											rstatus DESC,
											ddate :: DATE DESC,
											dtime :: TIME WITHOUT TIME ZONE DESC
									");
			return $q1->result_array();
		}

		public function cpics(){
			$q1 = $this->db->query("SELECT DISTINCT
										ON (
											pics,
											description,
											rstatus,
											ddate :: DATE,
											dtime :: TIME WITHOUT TIME ZONE,
											isnotified
										) *
									FROM
										tbl_images t1
									ORDER BY
										t1.pics DESC,
										t1.description DESC,
										t1.rstatus DESC,
										t1.ddate :: DATE DESC,
										t1.dtime :: TIME WITHOUT TIME ZONE DESC
								");
			return $q1->result_array();
		}

		public function picEnlarge($id){
			$q5 = $this->db->query("SELECT * FROM tbl_images t1 WHERE id='$id' ORDER BY t1.id DESC");
			$data['uppicsdet'] = $q5->result_array();
			return $data;
		}

		public function markreadinec(){
			$q1 = $this->db->query("UPDATE tbl_eopcen SET rstatus = 'READ' WHERE rstatus = 'NOT READ'");
			if($q1){
				return 1;
			}
		}

		public function markreaddamass(){
			$q1 = $this->db->query("UPDATE tbl_casualty_asstm SET rstatus = 'READ' WHERE rstatus = 'NOT READ'");
			if($q1){
				return 1;
			}
		}

		public function markreadoutec(){
			$q1 = $this->db->query("UPDATE tbl_outecm_a SET rstatus = 'READ' WHERE rstatus = 'NOT READ'");
			if($q1){
				return 1;
			}
		}

		public function markreadcasualty(){
			$q1 = $this->db->query("UPDATE tbl_casualtym SET rstatus = 'READ' WHERE rstatus = 'NOT READ'");
			if($q1){
				return 1;
			}
		}

		public function markreaduploads(){
			$q1 = $this->db->query("UPDATE tbl_images SET rstatus = 'READ' WHERE rstatus = 'NOT READ'");
			if($q1){
				return 1;
			}
		}

		public function cinecnotif(){

			$q1 = $this->db->query("SELECT DISTINCT
										ON (
											province_name,
											municipality_name,
											evacuation_name,
											ecstatus,
											fam_no,
											person_no,
											place_of_origin,
											disaster_name,
											rstatus,
											ddate :: DATE,
											dtime :: TIME WITHOUT TIME ZONE
										) *
									FROM
										tbl_eopcen
									WHERE
										isnotified = 'NOT NOTIFIED'
								");
			$q2 = $this->db->query("UPDATE tbl_eopcen SET isnotified = 'NOTIFIED' WHERE isnotified = 'NOT NOTIFIED'");

			return $q1->result_array();

		}

		public function coutecnotif(){

			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												brgy,
												fam_no,
												person_no,
												disaster_name,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_outecm_a
										WHERE
											isnotified = 'NOT NOTIFIED'
									");
			$q2 = $this->db->query("UPDATE tbl_outecm_a SET isnotified = 'NOTIFIED' WHERE isnotified = 'NOT NOTIFIED'");

			return $q1->result_array();

		}

		public function casualtynotif(){

			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												disaster_name,
												province_name,
												municipality_name,
												lname,
												fname,
												mi,
												age,
												gender,
												brgyname,
												isdead,
												ismissing,
												isinjured,
												remarks,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_casualtym
										WHERE
											isnotified = 'NOT NOTIFIED'
									");
			$q2 = $this->db->query("UPDATE tbl_casualtym SET isnotified = 'NOTIFIED' WHERE isnotified = 'NOT NOTIFIED'");

			return $q1->result_array();

		}

		public function assistnotif(){

			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												disaster_name,
												province_name,
												municipality_name,
												tot_damaged,
												part_damaged,
												dead,
												missing,
												injured,
												dswd_asst,
												lgu_asst,
												ngo_asst,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_casualty_asstm
										WHERE
											isnotified = 'NOT NOTIFIED'
									");
			$q2 = $this->db->query("UPDATE tbl_casualty_asstm SET isnotified = 'NOTIFIED' WHERE isnotified = 'NOT NOTIFIED'");

			return $q1->result_array();

		}

		public function picnotif(){

			$q1 = $this->db->query("SELECT distinct on(pics,description,rstatus,ddate,dtime,isnotified) * FROM tbl_images WHERE isnotified='NOT NOTIFIED'");
			$q2 = $this->db->query("UPDATE tbl_images SET isnotified = 'NOTIFIED' WHERE isnotified = 'NOT NOTIFIED'");

			return $q1->result_array();

		}

		public function damagesnotif(){

			$q1 = $this->db->query("SELECT DISTINCT
											ON (
												province_name,
												municipality_name,
												disaster_name,
												brgy_name,
												tot_damage,
												part_damage,
												dead,
												missing,
												injured,
												rstatus,
												ddate :: DATE,
												dtime :: TIME WITHOUT TIME ZONE
											) *
										FROM
											tbl_damagesm
										WHERE
											isnotified = 'NOT NOTIFIED'
									");
			$q2 = $this->db->query("UPDATE tbl_damagesm SET isnotified = 'NOTIFIED' WHERE isnotified = 'NOT NOTIFIED'");

			return $q1->result_array();

		}

		public function newMessage(){

			$q1 = $this->db->query("SELECT
										COUNT(*) msgcount
									FROM
										sms_in t1
									WHERE
										t1.isnotified = 'NOT NOTIFIED'
									");

			$q2 = $this->db->query("UPDATE sms_in SET isnotified = 'NOTIFIED' WHERE isnotified = 'NOT NOTIFIED'");

			return $q1->result_array();

		}

		public function viewMessage(){

			$q1 = $this->db->query("SELECT * FROM sms_in ORDER BY sent_dt DESC");

			return $q1->result_array();

		}

		public function get_allquake(){

			$b = file_get_contents("http://earthquake-report.com/feeds/recent-eq?json");

			$a = json_decode($b);

			for($i = 0 ; $i < count($a) ; $i++){
				// $q = $a[$i]->location;
				// $w = stripos($q,"Philippine");
				// if($w > 0){
					$data = array(
						'location' 	=> $a[$i]->location,
						'depth' 	=> $a[$i]->depth,
						'latitude' 	=> $a[$i]->latitude,
						'longitude' => $a[$i]->longitude,
						'date_time' => $a[$i]->date_time,
						'magnitude' => $a[$i]->magnitude
					);

					$q1 = $this->db->where('location', $a[$i]->location);
					$q1 = $this->db->where('depth', $a[$i]->depth);
					$q1 = $this->db->where('latitude', $a[$i]->latitude);
					$q1 = $this->db->where('longitude', $a[$i]->longitude);
					$q1 = $this->db->where('date_time', $a[$i]->date_time);
					$q1 = $this->db->where('magnitude', $a[$i]->magnitude);
					$q1 = $this->db->get('tbl_quake');

					if($q1->num_rows() < 1){
						$query = $this->db->insert('tbl_quake',$data);
					}
				// }
			}

			$q2 = $this->db->where('isnotified', "NOT NOTIFIED");
			$q2 = $this->db->get('tbl_quake');

			$datas['quake'] = $q2->result_array();

			$updata = array(
				'isnotified' => "NOTIFIED"
			);

			$query = $this->db->where('isnotified', "NOT NOTIFIED");
			$query = $this->db->update('tbl_quake', $updata);

			return $datas;

		}

		public function getEarthquake(){

			$q1 = $this->db->query("SELECT * FROM tbl_quake ORDER by date_time::timestamp desc");
			return $q1->result();

		}

		public function getWeather(){

			$a = file_get_contents("http://m.weather.gov.ph/agaptest/main_local.php");

			$a = strip_tags($a);

			$a = json_decode($a);
			return $a;

		}

		public function magEarthquake(){

			$q1 = $this->db->query("SELECT * FROM tbl_quake ORDER by date_time::timestamp desc");
		    $b['rs'] = $q1->result();

			for($i = 0 ; $i < count($b['rs']) ; $i++){
				$c['features'][] = Array(
					"type" => "Feature",
					"properties" => array(
						"mag" => $b['rs'][$i]->magnitude,
						"place" => $b['rs'][$i]->location,
						"date_time" => $b['rs'][$i]->date_time,
						"depth" => $b['rs'][$i]->depth,
						"id"=>$b['rs'][$i]->id
					),
					"geometry"=>array(
						"type"=>"Point",
						"coordinates"=>array(
								$b['rs'][$i]->longitude,
								$b['rs'][$i]->latitude
							)
					),
					"id"=>$b['rs'][$i]->id
				);
			}

			$a = array(
				"type" => "FeatureCollection",
				"features" => $c['features']
			);

			return $a;

		}

		public function getfloodintersect($id,$tbl){

			$q1 = $this->db->query("SELECT
										t1.*
									FROM
										(
											SELECT
												floodsusc,
												st_intersects (
													st_transform (
														st_setsrid (st_geometryfromtext(st_astext(geom)), 32651),
														4326
													),
													(
														SELECT
															ST_Transform (
																ST_SetSRID (
																	ST_GeomFromText (
																		CONCAT (
																			'POINT(',
																			t1.longitude,
																			' ',
																			t1.latitude,
																			')'
																		),
																		32651
																	),
																	4326
																),
																4326
															) AS geom
														FROM
															tbl_evacuation t1
														WHERE
															t1. ID = $id
													)
												) :: BOOLEAN AS intersects
											FROM
												$tbl
										) t1
									WHERE t1.intersects = true
								");

			return $q1->result_array();

		}

		public function saveQRT($data){

			$this->db->trans_begin();

			$this->db->insert('tbl_qrt_composition',$data['leader']);
			$this->db->insert('tbl_qrt_composition',$data['statistician']);
			$this->db->insert('tbl_qrt_composition',$data['smu']);
			$this->db->insert('tbl_qrt_composition',$data['aa']);
			for($i = 0 ; $i < count($data['qstaff']) ; $i++){
				$this->db->insert('tbl_qrt_composition',$data['qstaff'][$i]);
			}
			for($i = 0 ; $i < count($data['qdriver']) ; $i++){
				$this->db->insert('tbl_qrt_composition',$data['qdriver'][$i]);
			}

			if($this->db->trans_status() === FALSE){
				 $this->db->trans_rollback();
				 return 0;
			}else{
			    $this->db->trans_commit();
			    return 1;
			}
		}

		public function checkQRTNumber($data){

			$query = $this->db->where('qrt_team_id', $data);
			$query = $this->db->get('tbl_qrt_composition');
			return $query->result_array();

		}

		public function getAllQRT(){

			$query = $this->db->query("SELECT * FROM tbl_qrtteam ORDER BY id ASC");
			$data['team'] = $query->result_array();

			$query1 = $this->db->query("SELECT
											t1.*,
											t2.position_name
										FROM
											tbl_qrt_composition t1
										LEFT JOIN tbl_qrtposition t2
										ON t1.qrt_position_id = t2.id
										ORDER BY
											t1.qrt_team_id ASC, t1.id ASC"
			);
			$data['members'] = $query1->result_array();

			return $data;

		}

		public function getSpecQRT($id){

			$query1 = $this->db->query("SELECT
											t1.*,
											t2.position_name
										FROM
											tbl_qrt_composition t1
										LEFT JOIN tbl_qrtposition t2
										ON t1.qrt_position_id = t2.id
										WHERE qrt_team_id = '$id'
										ORDER BY
											t1.qrt_team_id ASC"
			);
			$data['members'] = $query1->result_array();

			return $data;

		}

		public function deleteQRTTeam($id){

			$this->db->trans_begin();

			$this->db->where('qrt_team_id', $id);
			$this->db->delete('tbl_qrt_composition');

			if($this->db->trans_status() === FALSE){
				 $this->db->trans_rollback();
				 return 0;
			}else{
			    $this->db->trans_commit();
			    return 1;
			}

		}

		public function deleteQRTTeamDriverStaff($id){

			$this->db->trans_begin();

			$this->db->where('id', $id);
			$this->db->delete('tbl_qrt_composition');

			if($this->db->trans_status() === FALSE){
				 $this->db->trans_rollback();
				 return 0;
			}else{
			    $this->db->trans_commit();
			    return 1;
			}

		}

		public function updateQRT($data){

			$this->db->trans_begin();

			$this->db->where('id',$data['leader']['id']);
			$this->db->update('tbl_qrt_composition',$data['leader']);

			$this->db->where('id',$data['statistician']['id']);
			$this->db->update('tbl_qrt_composition',$data['statistician']);

			$this->db->where('id',$data['smu']['id']);
			$this->db->update('tbl_qrt_composition',$data['smu']);

			$this->db->where('id',$data['aa']['id']);
			$this->db->update('tbl_qrt_composition',$data['aa']);


			for($i = 0 ; $i < count($data['qstaff']) ; $i++){
				$this->db->where('id',$data['qstaff'][$i]['id']);
				$this->db->update('tbl_qrt_composition',$data['qstaff'][$i]);
			}
			for($i = 0 ; $i < count($data['qdriver']) ; $i++){
				$this->db->where('id',$data['qdriver'][$i]['id']);
				$this->db->update('tbl_qrt_composition',$data['qdriver'][$i]);
			}

			if($this->db->trans_status() === FALSE){
				 $this->db->trans_rollback();
				 return 0;
			}else{
			    $this->db->trans_commit();
			    return 1;
			}
		}

		public function login($username,$password){

			$passwords = $password;
			$passwords = "\=45f=".md5($passwords)."==//87*1)";
			$passwords = sha1(md5($passwords));

			$query = $this->db->query("SELECT
										t1.*,
										t2.isdswd,
										t2.user_level_access,
										t2.regionid,
										t2.municipality_id,
										t2.provinceid,
										t2.issuperadmin
									FROM
										tbl_auth_user t1
									LEFT JOIN tbl_auth_user_profile t2 ON t1.username = t2.username
									WHERE
										t1.username = '$username'
									AND t1.password = '$passwords'
									AND t1.isactivated = 't'
					");

			if($query->num_rows() > 0){


				$arr = $query->result_array();
					
				session_start();

				$_SESSION['username'] 			= $username;
				$_SESSION['password'] 			= $password;

				$_SESSION['fullname'] 			= $arr[0]['fullname'];
				$_SESSION['isadmin'] 			= $arr[0]['isadmin'];

				$_SESSION['ishead'] 			= $arr[0]['ishead'];
				$_SESSION['isdswd'] 			= $arr[0]['isdswd'];

				$_SESSION['can_create_report'] 	=  $arr[0]['can_create_report'];

				$_SESSION['user_level_access'] 	=  $arr[0]['user_level_access'];

				$_SESSION['regionid'] 			=  $arr[0]['regionid'];
				$_SESSION['provinceid'] 		=  $arr[0]['provinceid'];
				$_SESSION['municipality_id'] 	=  $arr[0]['municipality_id'];

				$_SESSION['issuperadmin'] 		=  $arr[0]['issuperadmin'];


				$query1 = $this->db->where('id', $arr[0]['regionid']);
				$query1 = $this->db->get('tbl_regions');

				$arr1 = $query1->result_array();

				$_SESSION['region_name'] 		=  $arr1[0]['region_name'];

				$_SESSION['xcoordinates'] 		=  $arr1[0]['xcoordinates'];
				$_SESSION['ycoordinates'] 		=  $arr1[0]['ycoordinates'];
					
				return 1;

			}else{

				// $query1 = $this->db->query("SELECT * FROM tbl_auth_user_profile WHERE username = '$username' AND password_hash = '$passwords'");

				// if($query1->num_rows() > 0){

				// 	$arr = $query1->result_array();
					
				// 	session_start();

				// 	$_SESSION['username'] 	= $username;
				// 	$_SESSION['password'] 	= $password;

				// 	$_SESSION['fullname'] 	= strtoupper($arr[0]['firstname']) . " " . strtoupper($arr[0]['lastname']);
				// 	$_SESSION['isadmin'] 	= "f";

				// 	$_SESSION['ishead'] 	= "";

				// 	return 1;

				// }else{

				// 	return 0;

				// }

				return 0;


			}

			

		}

		public function getDashboardData(){

			session_start();

			$aff_family = 0;
			$aff_person = 0;
			$dswd_asst = 0;
			$aff_brgy = 0;
			$aff_familyinec = 0;
			$aff_familyoutec = 0;
			$aff_familys = array();
			$assts = 0;
			$title = "";
			$asst = array();
			$rs_asstdrills = array();

			$username = $_SESSION['username'];

			$query1 = $this->db->query("SELECT
											dromic_id,
											MAX (t1. ID) AS ID
										FROM
											(
												SELECT
													t1.dromic_id,
													t1. ID
												FROM
													tbl_disaster_title t1 --WHERE t1.id::integer > 12
												LEFT JOIN tbl_dromic t2 ON t1.dromic_id = t2. ID
												WHERE
													date_part(
														'year',
														t2.disaster_date :: DATE
													) = date_part('year', CURRENT_DATE)
												AND t2.created_by_user = '$username'
												ORDER BY
													t1.dromic_id ASC,
													t1.ddate DESC,
													t1. ID DESC
											) t1
										GROUP BY
											t1.dromic_id
			");

			if($query1){

				$data['rs'] = $query1->result_array();

				for($i = 0 ; $i < count($data['rs']) ; $i++){

					$id = $data['rs'][$i]['id'];

					$query2 = $this->db->query("SELECT
													SUM (t1.aff_family) AS aff_family
												FROM
													(
														SELECT
															SUM (t1.family_cum :: INTEGER) AS aff_family
														FROM
															tbl_evacuation_stats t1
														WHERE
															t1.disaster_title_id = $id
														UNION ALL
															(
																SELECT
																	SUM (t1.family_cum :: INTEGER) AS aff_family
																FROM
																	tbl_evac_outside_stats t1
																WHERE
																	t1.disaster_title_id = $id
															)
													) t1
					");

					$data['num_aff_family'] = $query2->result_array();
					for($j = 0 ; $j < count($data['num_aff_family']) ; $j++){
						$aff_family = (int) $aff_family + (int) $data['num_aff_family'][$j]['aff_family'];
					}

					$query3 = $this->db->query("SELECT
												SUM (t1.aff_person) AS aff_person
											FROM
												(
													SELECT
														SUM (t1.person_cum :: INTEGER) AS aff_person
													FROM
														tbl_evacuation_stats t1
													WHERE
														t1.disaster_title_id = $id
													UNION ALL
														(
															SELECT
																SUM (t1.person_cum :: INTEGER) AS aff_person
															FROM
																tbl_evac_outside_stats t1
															WHERE
																t1.disaster_title_id = $id
														)
												) t1
					");

					$data['num_aff_ind'] = $query3->result_array();
					for($j = 0 ; $j < count($data['num_aff_ind']) ; $j++){
						$aff_person = (int) $aff_person + (int) $data['num_aff_ind'][$j]['aff_person'];
					}

					$query4 = $this->db->query("SELECT
													t1.dswd_asst
												FROM
													tbl_casualty_asst t1
												WHERE
													t1.disaster_title_id = $id
					");

					$data['num_dswd_asst'] = $query4->result_array();
					for($j = 0 ; $j < count($data['num_dswd_asst']) ; $j++){
						$dswd_asst = (int) $dswd_asst + (int) $data['num_dswd_asst'][$j]['dswd_asst'];
					}

					$query6 = $this->db->query("SELECT
													SUM (t1.family_cum :: INTEGER) AS aff_familyinec
												FROM
													tbl_evacuation_stats t1
												WHERE
													t1.disaster_title_id = $id
					");

					$data['aff_familyinec'] = $query6->result_array();
					for($j = 0 ; $j < count($data['aff_familyinec']) ; $j++){
						$aff_familyinec = (int) $aff_familyinec + (int) $data['aff_familyinec'][$j]['aff_familyinec'];
					}

					$query7 = $this->db->query("SELECT
													SUM (t1.family_cum :: INTEGER) AS aff_familyoutec
												FROM
													tbl_evac_outside_stats t1
												WHERE
													t1.disaster_title_id = $id
					");

					$data['aff_familyoutec'] = $query7->result_array();
					for($j = 0 ; $j < count($data['aff_familyoutec']) ; $j++){
						$aff_familyoutec = (int) $aff_familyoutec + (int) $data['aff_familyoutec'][$j]['aff_familyoutec'];
					}

					$querya = $this->db->query("SELECT
													SUM (t1.aff_family) AS aff_family,
													t1.disaster_title
												FROM
													(
														SELECT
															SUM (t1.family_cum :: INTEGER) AS aff_family,
															t2.disaster_title
														FROM
															tbl_evacuation_stats t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
														WHERE t1.disaster_title_id = $id
														GROUP BY
															t2.disaster_title
														UNION ALL
															(
																SELECT
																	SUM (t1.family_cum :: INTEGER) AS aff_family,
																	t2.disaster_title
																FROM
																	tbl_evac_outside_stats t1
																LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																WHERE t1.disaster_title_id = $id
																GROUP BY
																	t2.disaster_title
															)
													) t1
												GROUP BY
													t1.disaster_title
					");

					$r = $querya->result_array();

					$chars = 'ABCDEF0123456789';
				    $colors = '#';
				    for ( $l = 0; $l < 6; $l++ ) {
				       $colors .= $chars[rand(0, strlen($chars) - 1)];
				    }

					if($querya->num_rows() > 0){

						$aff_familys[] = array(
							'name' 			=> $r[0]['disaster_title'],
							'y' 			=> $r[0]['aff_family'],
							'drilldown' 	=> $r[0]['disaster_title'],
							'color' 		=> $colors
		
						);
					}

					if($_SESSION['user_level_access'] != 'municipality'){

						$queryafffamilydrill = $this->db->query("SELECT
																	SUM(t1.family_cum::numeric) as family_cum,
																	t1.municipality_id,
																	t1.municipality_name,
																	t1.disaster_title
																FROM
																	(
																		SELECT
																			SUM(t1.family_cum::numeric) as family_cum,
																			t1.municipality_id,
																			t3.municipality_name,
																			t2.disaster_title
																		FROM
																			tbl_evacuation_stats t1
																		LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																		LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3.id
																		WHERE
																			t1.disaster_title_id = $id
																		GROUP BY
																			t1.municipality_id,t3.municipality_name,t2.disaster_title
																		UNION ALL
																			(
																				SELECT
																					SUM(t1.family_cum::numeric) as family_cum,
																					t1.municipality_id,
																					t3.municipality_name,
																					t2.disaster_title
																				FROM
																					tbl_evac_outside_stats t1
																				LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																				LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3.id
																				WHERE
																					t1.disaster_title_id = $id
																				GROUP BY
																					t1.municipality_id,t3.municipality_name,t2.disaster_title
																			)
																	) t1
																GROUP BY
																	t1.municipality_id,t1.municipality_name,t1.disaster_title
						");

						$rsafffamilydrill = $queryafffamilydrill->result_array();

						if($queryafffamilydrill->num_rows() > 0){

							$drilltitle = $rsafffamilydrill[0]['disaster_title'];

							for($f = 0 ; $f < count($rsafffamilydrill) ; $f++){
								$queryafffamilydrillcity[] = array(
									'name' 			=> $rsafffamilydrill[$f]['municipality_name'],
									'y' 			=> $rsafffamilydrill[$f]['family_cum']
								);
							}

							$queryafffamilydrills[] = array(
								'name' 			=> $drilltitle,
								'id' 			=> $drilltitle,
								'data' 			=> $queryafffamilydrillcity
							);

							$queryafffamilydrillcity = [];

						}

					}else{

						$queryafffamilydrill = $this->db->query("SELECT
																	t3.disaster_title,
																	t2.id,
																	t2.brgy_name,
																	t1.affected_family family_cum 
																FROM
																	tbl_damage_per_brgy t1
																	LEFT JOIN lib_barangay t2 ON t1.brgy_id = t2.ID 
																	LEFT JOIN tbl_disaster_title t3 ON t1.disaster_title_id = t3.id
																WHERE
																	t1.disaster_title_id = $id
						");

						$rsafffamilydrill = $queryafffamilydrill->result_array();

						if($queryafffamilydrill->num_rows() > 0){

							$drilltitle = $rsafffamilydrill[0]['disaster_title'];

							for($f = 0 ; $f < count($rsafffamilydrill) ; $f++){
								$queryafffamilydrillcity[] = array(
									'name' 			=> $rsafffamilydrill[$f]['brgy_name'],
									'y' 			=> $rsafffamilydrill[$f]['family_cum']
								);
							}

							$queryafffamilydrills[] = array(
								'name' 			=> $drilltitle,
								'id' 			=> $drilltitle,
								'data' 			=> $queryafffamilydrillcity
							);

							$queryafffamilydrillcity = [];

						}

					}
					
					$queryasst = $this->db->query("SELECT
													t1.dswd_asst,
													t1.disaster_title
												FROM
													(
														SELECT
															t1.dswd_asst,
															t2.disaster_title
														FROM
															tbl_casualty_asst t1
														LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
														WHERE
															t1.disaster_title_id = $id
														GROUP BY
															t1.dswd_asst, t2.disaster_title
													) t1
												GROUP BY t1.dswd_asst, t1.disaster_title
					");


					$ra = $queryasst->result_array();

					if($queryasst->num_rows() > 0){	
						for($g = 0 ; $g < count($ra) ; $g++){
							if($ra[$g]['dswd_asst'] != ""){
								$title = $ra[$g]['disaster_title'];
							}
							$assts = (int) $assts + (int) $ra[$g]['dswd_asst'];
						}

						if($assts == 0){

							$assts == null;

						}
						
						if($title != ""){
							$asst[] = array(
								'name' 			=> $title,
								'y' 			=> $assts,
								'drilldown' 	=> $title
							);
						}

						$title = "";
						$assts = null;

					}

					


					$queryasst_lgu = $this->db->query("SELECT
															t1.dswd_asst,
															t1.municipality_name,
															t1.disaster_title
														FROM
															(
																SELECT
																	t1.dswd_asst,
																	t3.municipality_name,
																	t2.disaster_title
																FROM
																	tbl_casualty_asst t1
																LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
																LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
																WHERE
																	t1.disaster_title_id = $id
																GROUP BY
																	t1.dswd_asst,
																	t3.municipality_name,
																	t2.disaster_title
															) t1
														WHERE t1.dswd_asst <> ''
														GROUP BY
															t1.dswd_asst,
															t1.municipality_name,
															t1.disaster_title
					");

					$rs_asstdrill = $queryasst_lgu->result_array();

					if($queryasst_lgu->num_rows() > 0){

						$drilltitle_asst = $rs_asstdrill[0]['disaster_title'];

						for($f = 0 ; $f < count($rs_asstdrill) ; $f++){
							$query_asstdrillcity[] = array(
								'name' 			=> $rs_asstdrill[$f]['municipality_name'],
								'y' 			=> $rs_asstdrill[$f]['dswd_asst']
							);
						}

						$rs_asstdrills[] = array(
							'name' 			=> $drilltitle,
							'id' 			=> $drilltitle,
							'data' 			=> $query_asstdrillcity
						);

						$query_asstdrillcity = [];

					}


					$query5 = $this->db->query("SELECT
													COUNT (*) as affbrgy
												FROM
													(
														SELECT DISTINCT
															ON (t1.municipality_id) t1.municipality_id
														FROM
															(
																SELECT DISTINCT
																	ON (t1.municipality_id) t1.municipality_id
																FROM
																	tbl_evacuation_stats t1
																WHERE
																	t1.disaster_title_id = $id
																UNION ALL
																	(
																		SELECT DISTINCT
																			ON (t2.municipality_id) t2.municipality_id
																		FROM
																			tbl_evac_outside_stats t2
																		WHERE
																			t2.disaster_title_id = $id
																	)
															) t1
													) t1
					");

					$data['aff_brgy'] = $query5->result_array();
					
					for($j = 0 ; $j < count($data['aff_brgy']) ; $j++){
						$aff_brgy = (int) $aff_brgy + (int) $data['aff_brgy'][$j]['affbrgy'];
					}

				}

			}

			$datas = array(
				'aff_family' 			=> $aff_family,
				'aff_person' 			=> $aff_person,
				'dswd_asst' 			=> $dswd_asst,
				'aff_brgy' 				=> $aff_brgy,
				'aff_familyinec' 		=> $aff_familyinec,
				'aff_familyoutec' 		=> $aff_familyoutec,
				'pie_aff_family' 		=> $aff_familys,
				'pie_dswd_asst' 		=> $asst,
				'pie_aff_family_drill' 	=> $queryafffamilydrills,
				'pie_asst_drill' 		=> $rs_asstdrills
			);

			return $datas;

		}

		public function get_fnfi(){

			$query = $this->db->query("SELECT * FROM tbl_fnfi WHERE fnfi_type <> '0'");

			return $query->result_array();

		}

		public function get_fnfi_cost($id){

			$query = $this->db->where('id',$id);
			$query = $this->db->get('tbl_fnfi');

			return $query->result_array();

		}

		public function saveFNFILIST($details,$fnfi_list,$date_aug){

			$this->db->trans_begin();

			$did = $details['disaster_title_id'];
			$mid = $details['municipality_id'];

			$q1 = $this->db->query("SELECT * FROM tbl_fnfi_assistance WHERE disaster_title_id = '$did' AND municipality_id = '$mid'");

			$arrs = $q1->result_array();
			$c = $q1->num_rows();

			if($c < 1){

				$this->db->insert('tbl_fnfi_assistance',$details);
				$insert_id = $this->db->insert_id();

				for($i = 0 ; $i < count($fnfi_list) ; $i++){
					$arr = array(
						'fnfi_assistance_id' 	=> $insert_id,
						'fnfi_name' 			=> $fnfi_list[$i]['fnfi_name'],
						'cost' 					=> $fnfi_list[$i]['fnfi_cost'],
						'quantity' 				=> $fnfi_list[$i]['fnfi_quantity'],
						'date_augmented' 		=> $date_aug,
						'fnfitype' 				=> $fnfi_list[$i]['fnfi_type'],
					);
					$this->db->insert('tbl_fnfi_assistance_list',$arr);
				}

				$q2 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$did' AND municipality_id = '$mid'");

				$arx = $q2->result_array();
				$cc = $q2->num_rows();

				$id = $insert_id;

				$tot = 0;
				$q3 = $this->db->query("SELECT * FROM tbl_fnfi_assistance_list WHERE fnfi_assistance_id = '$id'");
				$rsfnfi = $q3->result_array();

				for($h = 0 ; $h < count($rsfnfi) ; $h++){
					$tot = (int) $tot + (int) ($rsfnfi[$h]['cost'] * $rsfnfi[$h]['quantity']);
				}

				$data_asst = array(
					'disaster_title_id'   	=> $details['disaster_title_id'],
					'municipality_id'   	=> $details['municipality_id'],
					'provinceid' 		    => $details['provinceid'],
					'dswd_asst' 		    => $tot
				);

				if($cc < 1){
					
					$this->db->insert('tbl_casualty_asst',$data_asst);

				}else{

					$this->db->where('id',$arx[0]['id']);
					$this->db->update('tbl_casualty_asst',$data_asst);

				}

			}else{

				for($i = 0 ; $i < count($fnfi_list) ; $i++){
					$arr = array(
						'fnfi_assistance_id' 	=> $arrs[0]['id'],
						'fnfi_name' 			=> $fnfi_list[$i]['fnfi_name'],
						'cost' 					=> $fnfi_list[$i]['fnfi_cost'],
						'quantity' 				=> $fnfi_list[$i]['fnfi_quantity'],
						'date_augmented' 		=> $date_aug,
						'fnfitype' 				=> $fnfi_list[$i]['fnfi_type'],
					);
					$this->db->insert('tbl_fnfi_assistance_list',$arr);
				}

				$q2 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$did' AND municipality_id = '$mid'");
				$arx = $q2->result_array();
				$cc = $q2->num_rows();

				$id = $arrs[0]['id'];

				$tot = 0;
				$q3 = $this->db->query("SELECT * FROM tbl_fnfi_assistance_list WHERE fnfi_assistance_id = '$id'");
				$rsfnfi = $q3->result_array();

				for($h = 0 ; $h < count($rsfnfi) ; $h++){
					$tot = (int) $tot + (int) ($rsfnfi[$h]['cost'] * $rsfnfi[$h]['quantity']);
				}

				$data_asst = array(
					'disaster_title_id'   	=> $details['disaster_title_id'],
					'municipality_id'   	=> $details['municipality_id'],
					'provinceid' 		    => $details['provinceid'],
					'dswd_asst' 		    => $tot
				);

				if($cc < 1){
					
					$this->db->insert('tbl_casualty_asst',$data_asst);

				}else{

					$this->db->where('id',$arx[0]['id']);
					$this->db->update('tbl_casualty_asst',$data_asst);

				}

			}

			if($this->db->trans_status() == FALSE){
				$this->db->trans_rollback();
				return 0;
			}else{
				$this->db->trans_commit();
				return 1;
			}

		}

		public function get_dswd_assistance($id){

			session_start();

			$user_level_access = $_SESSION['user_level_access'];

			if($user_level_access == 'national' || $user_level_access == 'region'){

				$query = $this->db->query("
											SELECT
												t1.*, t2.*, t3.municipality_name, t4.region_psgc region
											FROM
												tbl_fnfi_assistance t1
											LEFT JOIN tbl_fnfi_assistance_list t2 ON t1. ID = t2.fnfi_assistance_id
											LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
											LEFT JOIN lib_provinces t4 ON t1.provinceid = t4.id
											WHERE
												t1.disaster_title_id = '$id'
											ORDER BY
												t1.municipality_id ASC,
												t2.date_augmented :: DATE DESC,
												CASE
												WHEN LOWER (t2.fnfi_name) LIKE LOWER ('family%') THEN
													1
												END ASC,
												t2.quantity ASC

				");

			}else if($user_level_access == 'province'){

				$provinceid = $_SESSION['provinceid'];

				$query = $this->db->query("
											SELECT
												t1.*, t2.*, t3.municipality_name, t4.region_psgc region
											FROM
												tbl_fnfi_assistance t1
											LEFT JOIN tbl_fnfi_assistance_list t2 ON t1. ID = t2.fnfi_assistance_id
											LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
											LEFT JOIN lib_provinces t4 ON t1.provinceid = t4.id
											WHERE
												t1.disaster_title_id = '$id'
												AND t1.provinceid = '$provinceid'
											ORDER BY
												t1.municipality_id ASC,
												t2.date_augmented :: DATE DESC,
												CASE
												WHEN LOWER (t2.fnfi_name) LIKE LOWER ('family%') THEN
													1
												END ASC,
												t2.quantity ASC

				");

			}else{

				$municipality_id = $_SESSION['municipality_id'];

				$query = $this->db->query("
											SELECT
												t1.*, t2.*, t3.municipality_name, t4.region_psgc region
											FROM
												tbl_fnfi_assistance t1
											LEFT JOIN tbl_fnfi_assistance_list t2 ON t1. ID = t2.fnfi_assistance_id
											LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
											LEFT JOIN lib_provinces t4 ON t1.provinceid = t4.id
											WHERE
												t1.disaster_title_id = '$id'
												AND t1.municipality_id = '$municipality_id'
											ORDER BY
												t1.municipality_id ASC,
												t2.date_augmented :: DATE DESC,
												CASE
												WHEN LOWER (t2.fnfi_name) LIKE LOWER ('family%') THEN
													1
												END ASC,
												t2.quantity ASC

				");

			}

			return $query->result_array();

		}

		public function get_damage_per_brgy($id){

			if(isset($_GET['id'])){

				$query = $this->db->query("SELECT
												t1.*, t3.municipality_name,
												t4.brgy_name,
												t5.region_psgc region
											FROM
												tbl_damage_per_brgy t1
											LEFT JOIN tbl_disaster_title t2 ON t1.disaster_title_id = t2. ID
											LEFT JOIN lib_municipality t3 ON t1.municipality_id = t3. ID
											LEFT JOIN lib_barangay t4 ON t1.brgy_id = t4. ID
											LEFT JOIN lib_provinces t5 ON t1.provinceid = t5.id
											WHERE
												t1.disaster_title_id = '$id'
											ORDER BY
												t1.municipality_id ASC, t4.brgy_name
				");

				return $query->result_array();
			}

		}

		public function get_teamleader(){

			session_start();

			$id = $_SESSION['ishead'];

			$query1 = $this->db->query("SELECT * FROM tbl_qrt_composition WHERE qrt_team_id = '$id'");

			$arr1 = $query1->result_array();

			if(count($arr1) > 0){
				return $query1->result_array();
			}else{
				return 0;
			}
		}

		public function get_assistancetype(){

			$query1 = $this->db->get("tbl_assistance_type");
			return $query1->result_array();
		}

		public function save_augmentation_assistance($data,$asstlist){

			$this->db->trans_begin();

			$query = $this->db->insert('tbl_augmentation_list',$data);

			$insert_id = $this->db->insert_id();

			for($i = 0 ; $i < count($asstlist) ; $i++){

				$datas = array(
					'augment_list_code' 	=> $asstlist[$i]['assistance_sub_gen'],
					'assistance_name' 		=> $asstlist[$i]['assistance_name'],
					'cost' 					=> $asstlist[$i]['cost'],
					'quantity' 				=> $asstlist[$i]['quantity'],
					'date_augmented' 		=> $asstlist[$i]['date_aug'],
					'augment_list_id' 		=> $insert_id
				);

				$query1 = $this->db->insert('tbl_augmentation_list_spec',$datas);

			}

			if($this->db->trans_status() === FALSE){
				 $this->db->trans_rollback();
				 return 0;
			}else{
			    $this->db->trans_commit();
			    return 1;
			}
			
		}

		public function get_augmentation_assistance($month,$year,$assttyperelief){

			if($assttyperelief == ""){

				$query1 = $this->db->query("SELECT
												t1.*, t2.provinceid,
												t2.municipality_id,
												t3.municipality_name,
												t4.assistance_name asst_type,
												t2.number_served,
												t2.remarks_particulars,
												t4. ID asst_id
											FROM
												tbl_augmentation_list_spec t1
											LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
											LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
											LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
											WHERE date_part('month',t1.date_augmented::date)::numeric = '$month'::numeric
											AND date_part('year',t1.date_augmented::date)::numeric = '$year'::numeric
											ORDER BY
												t2.municipality_id ASC,
												t1.date_augmented::date ASC,
												t4. ID ASC
				");
			}else{

				$query1 = $this->db->query("SELECT
												t1.*, t2.provinceid,
												t2.municipality_id,
												t3.municipality_name,
												t4.assistance_name asst_type,
												t2.number_served,
												t2.remarks_particulars,
												t4. ID asst_id
											FROM
												tbl_augmentation_list_spec t1
											LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
											LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
											LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
											WHERE date_part('month',t1.date_augmented::date)::numeric = '$month'::numeric
											AND date_part('year',t1.date_augmented::date)::numeric = '$year'::numeric
											AND t1.augment_list_code = '$assttyperelief'
											ORDER BY
												t2.municipality_id ASC,
												t1.date_augmented::date ASC,
												t4. ID ASC
				");

			}

			return $query1->result_array();
		}

		public function get_augmentation_assistance1($year){

			$arr = array();

			$query1 = $this->db->query("SELECT
											t1.*
										FROM
											(
												SELECT
													t1.*, t2.provinceid,
													t2.municipality_id,
													t3.municipality_name,
													t4.assistance_name asst_type,
													t2.number_served,
													t2.remarks_particulars,
													t4. ID asst_id
												FROM
													tbl_augmentation_list_spec t1
												LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
												LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
												LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
												WHERE
													t4. ID = 1
												AND date_part('year', t1.date_augmented) = $year
												ORDER BY
													t2.municipality_id ASC,
													t1.date_augmented :: DATE ASC,
													t4. ID ASC
											) t1
										ORDER BY 
										t1.municipality_id ASC,
													t1.date_augmented :: DATE ASC,
													t1. ID ASC,
										CASE WHEN lower(t1.assistance_name) LIKE lower('family%') then 1
										END ASC

			");

			$arr = $query1->result_array();

			return $arr;

		}

		public function get_augmentation_assistanceperd($year){

			$query2 = $this->db->query("SELECT
											t1.disaster_event,
											CASE
												WHEN t1.disaster_event = 'PARS' THEN 'Preparatory Activity for Rainy Season' 
												WHEN t1.disaster_event = 'PREP' THEN 'Preposition Goods'
												ELSE t1.disaster_name
											END disaster_name,
											t1.disaster_date
										FROM
											(
												SELECT
													*
												FROM
													(
														SELECT
															t1.*, t2.disaster_name,
															t2.disaster_date :: DATE
														FROM
															(
																SELECT DISTINCT
																	t1.disaster_event
																FROM
																	(
																		SELECT
																			t2.disaster_event,
																			t2.municipality_id,
																			t1.*
																		FROM
																			tbl_augmentation_list_spec t1
																		LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
																		GROUP BY
																			t2.disaster_event,
																			t2.municipality_id,
																			t1.augment_list_code,
																			t1. ID
																	) t1
																WHERE
																	date_part(
																		'YEAR',
																		t1.date_augmented :: DATE
																	) :: INTEGER = $year
																ORDER BY
																	t1.disaster_event DESC
															) t1
														LEFT JOIN tbl_dromic t2 ON t1.disaster_event :: CHARACTER VARYING = t2. ID :: CHARACTER VARYING
													) t1 -- UNION ALL
													-- 	(
													-- 		SELECT
													-- 			'PARS' disaster_event,
													-- 			'Preparatory Activities for Rainy Season' disaster_name,
													-- 			'01-01-1970' :: DATE
													-- 	)
													-- UNION ALL
													-- 	(
													-- 		SELECT
													-- 			'PREP' disaster_event,
													-- 			'Prepositioned Goods' disaster_name,
													-- 			'01-01-1970' :: DATE
													-- 	)
											) t1
										WHERE
											t1.disaster_event IS NOT NULL
											AND t1.disaster_event <> 'PREP'
										ORDER BY
											t1.disaster_date DESC
						");

			$arr['perd'] = $query2->result_array();

			$query3 = $this->db->query("SELECT
											t1.*
										FROM
											(
												SELECT
													t2.disaster_event,
													t4. ID provinceid,
													t4.province_name,
													t2.municipality_id,
													t2.number_served,
													t3.municipality_name,
													t1.*
												FROM
													tbl_augmentation_list_spec t1
												LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
												LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
												LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
												WHERE
													date_part(
														'YEAR',
														t1.date_augmented :: DATE
													) :: INTEGER = $year
												GROUP BY
													t2.disaster_event,
													t4. ID,
													t4.province_name,
													t2.municipality_id,
													t2.number_served,
													t3.municipality_name,
													t1.augment_list_code,
													t1. ID
												ORDER BY
													t1.date_augmented DESC
											) t1
										ORDER BY
											t1.municipality_id ASC,
											CASE
										WHEN t1.number_served > 0 THEN
											1
										END ASC,
										 t1.date_augmented DESC,
										 CASE
										WHEN LOWER (t1.assistance_name) LIKE LOWER ('family%') THEN
											1
										END ASC

								");

			$arr['asst'] = $query3->result_array();

			$query4 = $this->db->query("SELECT DISTINCT
											t1.municipality_id,
											t1.municipality_name,
											t1.disaster_event,
											t1.augment_list_code
										FROM
											(
												SELECT
													t1.*
												FROM
													(
														SELECT
															t2.disaster_event,
															t4. ID provinceid,
															t4.province_name,
															t2.municipality_id,
															t2.number_served,
															t3.municipality_name,
															t1.*
														FROM
															tbl_augmentation_list_spec t1
														LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
														LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
														LEFT JOIN lib_provinces t4 ON t3.provinceid = t4. ID
														WHERE
															date_part(
																'YEAR',
																t1.date_augmented :: DATE
															) :: INTEGER = $year
														GROUP BY
															t2.disaster_event,
															t4. ID,
															t4.province_name,
															t2.municipality_id,
															t2.number_served,
															t3.municipality_name,
															t1.augment_list_code,
															t1. ID
														ORDER BY
															t1.date_augmented DESC
													) t1
												ORDER BY
													t1.municipality_id ASC,
													CASE
												WHEN t1.number_served > 0 THEN
													1
												END ASC,
												t1.date_augmented DESC,
												CASE
											WHEN LOWER (t1.assistance_name) LIKE LOWER ('family%') THEN
												1
											END ASC
											) t1
										GROUP BY t1.municipality_id, t1.municipality_name, t1.augment_list_code, t1.disaster_event
										ORDER BY t1.municipality_id

								");


		
			$arr['muni'] = $query4->result_array();

			return $arr;

		}

		public function get_augmentation_assistanceffw($year){

			$query1 = $this->db->query("SELECT
											t1.*, t2.provinceid,
											t2.municipality_id,
											t3.municipality_name,
											t4.assistance_name asst_type,
											t2.number_served,
											t2.remarks_particulars,
											t4. ID asst_id
										FROM
											tbl_augmentation_list_spec t1
										LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
										LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
										LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
										WHERE t4. ID = 2
										AND date_part('year',t1.date_augmented) = $year
										ORDER BY
											t2.municipality_id ASC,
											t1.date_augmented::date ASC,
											t4. ID ASC
			");

			return $query1->result_array();
		}

		public function get_augmentation_assistanceesa($year){

			$query1 = $this->db->query("SELECT
											t1.*, t2.provinceid,
											t2.municipality_id,
											t3.municipality_name,
											t4.assistance_name asst_type,
											t2.number_served,
											t2.remarks_particulars,
											t4. ID asst_id
										FROM
											tbl_augmentation_list_spec t1
										LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
										LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
										LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
										WHERE
											(t4. ID = 5
										OR t4. ID = 6)
										AND date_part('year', t1.date_augmented) = $year
										ORDER BY
											t2.municipality_id ASC,
											t1.date_augmented :: DATE ASC,
											t4. ID ASC
			");

			return $query1->result_array();
		}

		public function get_augmentation_assistancecfw($year){

			$query1 = $this->db->query("SELECT
											t1.*, t2.provinceid,
											t2.municipality_id,
											t3.municipality_name,
											t4.assistance_name asst_type,
											t2.number_served,
											t2.remarks_particulars,
											t4. ID asst_id
										FROM
											tbl_augmentation_list_spec t1
										LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
										LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
										LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
										WHERE
											(t4. ID = 3
										OR t4. ID = 4)
										AND date_part('year', t1.date_augmented) = $year
										ORDER BY
											t2.municipality_id ASC,
											t1.date_augmented :: DATE ASC,
											t4. ID ASC
			");

			return $query1->result_array();
		}

		public function check_municipality_in_damass($id,$disaster_title_id){

			$query = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE municipality_id = '$id' AND disaster_title_id = '$disaster_title_id'");

			return $query->num_rows();
		}

		public function issuesfound($id){

			$query1 = $this->db->query("SELECT
											t1.brgy_located,
											SUM (t1.person_cum :: INTEGER) AS person_cum,
											t2.tot_population,
											t2. ID,
											t2.brgy_name
										FROM
											tbl_evacuation_stats t1
										LEFT JOIN lib_barangay t2 ON t1.brgy_located :: INTEGER = t2. ID :: INTEGER
										WHERE
											t1.disaster_title_id = $id
										GROUP BY
											t1.brgy_located,
											t2. ID
			");

			return $query1->result_array();
		}

		public function deleteDamAss($id){

			$queryfind = $this->db->where('id',$id);
			$queryfind = $this->db->get('tbl_casualty_asst');

			$result = $queryfind->result_array();

			$municipality 		= $result[0]['municipality_id'];
			$disaster_title_id 	= $result[0]['disaster_title_id'];

			$querydmgbrgy = $this->db->where('municipality_id',$municipality);
			$querydmgbrgy = $this->db->where('disaster_title_id',$disaster_title_id);
			$querydmgbrgy = $this->db->get('tbl_damage_per_brgy');

			$resultdmgbrgy = $querydmgbrgy->result_array();

			$queryasstlgu = $this->db->where('municipality_id',$municipality);
			$queryasstlgu = $this->db->where('disaster_title_id',$disaster_title_id);
			$queryasstlgu = $this->db->get('tbl_fnfi_assistance');

			$resultasstlgu = $queryasstlgu->result_array();

			if(count($querydmgbrgy->result_array()) > 0 || count($queryasstlgu->result_array()) > 0){

				return 2;

			}else{


				$query = $this->db->where('id',$id);
				$query = $this->db->delete('tbl_casualty_asst');

				if($query){
					return 1;
				}else{
					return 0;
				}

			}

		}

		public function deleteECS($id,$brgy_located,$disaster_title_id){

			$arr = array();
			$c = 0;

			$querys = $this->db->query("SELECT * FROM tbl_evacuation_stats WHERE id = '$id'");
			$arr = $querys->result_array();
			$ecid = $arr[0]['evacuation_name'];

			$this->db->trans_start();

			try{

				$query2 = $this->db->query("SELECT * FROM tbl_evacuation_stats WHERE evacuation_name = '$ecid'");

				$c = $query2->num_rows();

				$query = $this->db->where('id',$id);
				$query = $this->db->delete('tbl_evacuation_stats');

				if($c <= 1){
					$query3 = $this->db->where('id',$ecid);
					$query3 = $this->db->delete('tbl_activated_ec');
				}

				$this->db->trans_commit();

				$query2_a= $this->db->query("
												SELECT
													t1.brgy_located_ec,
													SUM ( t1.fam_cum :: INTEGER ) fam_cum,
													SUM ( t1.person_cum :: INTEGER ) person_cum 
												FROM
													(
													SELECT
														* 
													FROM
														(
														SELECT
															t2.brgy_located_ec,
															SUM ( t1.family_cum :: INTEGER ) fam_cum,
															SUM ( t1.person_cum :: INTEGER ) person_cum 
														FROM
															tbl_evacuation_stats t1
															LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
														WHERE
															t1.disaster_title_id = '$disaster_title_id' 
															AND t2.brgy_located_ec = '$brgy_located' 
														GROUP BY
															t2.brgy_located_ec 
														) t1 UNION ALL
														(
														SELECT
															t1.brgy_host,
															SUM ( t1.family_cum :: INTEGER ) fam_cum,
															SUM ( t1.person_cum :: INTEGER ) person_cum 
														FROM
															tbl_evac_outside_stats t1 
														WHERE
															t1.disaster_title_id = '$disaster_title_id' 
															AND t1.brgy_host = '$brgy_located' 
														GROUP BY
														t1.brgy_host 
													)) t1
													GROUP BY
															t1.brgy_located_ec 
				");

				$arr_a = $query2_a->result_array();

				if($query2_a->num_rows() > 0){

					$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND brgy_id = '$brgy_located'");
					$arr2_q = $q_2->result_array();

					$affected_family = 0;
					$affected_persons = 0;


					$affected_family = $arr_a[0]['fam_cum'];


					$affected_persons = $arr_a[0]['person_cum'];

					$data_ec_up = array(
						'affected_family' 	=> $affected_family,
						'affected_persons' 	=> $affected_persons
					);

					$q_a = $this->db->where('disaster_title_id', $disaster_title_id);
					$q_a = $this->db->where('brgy_id', $brgy_located);
					$q_a = $this->db->update('tbl_damage_per_brgy', $data_ec_up);

				}

				return 1;

			}catch(Exception $e){

				$this->db->trans_rollback();
				return 0;
			}

		}

		public function delFamOEC($id){

			$query = $this->db->where('id',$id);
			$query = $this->db->delete('tbl_evac_outside_stats');

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		public function deleteCAS($id){

			$query = $this->db->where('id',$id);
			$query = $this->db->delete('tbl_casualty');

			if($query){
				return 1;
			}else{
				return 0;
			}
		}

		public function getPictureCoordinates($id){

			$query = $this->db->where('id',$id);
			$query = $this->db->get('tbl_images');

			return $query->result_array();
		}

		public function saveDamageperBrgy($data){

			$did = $data['disaster_title_id'];
			$mid = $data['municipality_id'];
			$bid = $data['brgy_id'];

			$affected_family = $data['affected_family'];
			$affected_persons = $data['affected_persons'];



			$query2= $this->db->query("
											SELECT
												t1.brgy_located_ec,
												SUM ( t1.fam_cum :: INTEGER ) fam_cum,
												SUM ( t1.person_cum :: INTEGER ) person_cum 
											FROM
												(
												SELECT
													* 
												FROM
													(
													SELECT
														t2.brgy_located_ec,
														SUM ( t1.family_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														tbl_evacuation_stats t1
														LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
													WHERE
														t1.disaster_title_id = '$did' 
														AND t2.brgy_located_ec = '$bid' 
													GROUP BY
														t2.brgy_located_ec 
													) t1 UNION ALL
													(
													SELECT
														t1.brgy_host,
														SUM ( t1.family_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														tbl_evac_outside_stats t1 
													WHERE
														t1.disaster_title_id = '$did' 
														AND t1.brgy_host = '$bid' 
													GROUP BY
													t1.brgy_host 
												)) t1
												GROUP BY
														t1.brgy_located_ec 
			");

			$arr = $query2->result_array();

			if($query2->num_rows() > 0){

				$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$did' AND brgy_id = '$bid'");
				$arr2 = $q_2->result_array();

				if($q_2->num_rows() > 0){

					$tmp_fam = 0;
					$tmp_per = 0;

					for($r = 0 ; $r < count($arr2) ; $r++){
						$tmp_fam += $arr2[$r]["affected_family"];
						$tmp_per += $arr2[$r]["affected_persons"];
					}

					if($tmp_fam >= $data['affected_family']){
						$data['affected_family'] = $tmp_fam;
					}

					if($tmp_per >= $data['affected_persons']){
						$data['affected_persons'] = $tmp_per;
					}

				}else{

					if($arr[0]['fam_cum'] >= $data['affected_family']){
						$data['affected_family'] = $arr[0]['fam_cum'];
					}

					if($arr[0]['person_cum'] >= $data['affected_persons']){
						$data['affected_persons'] = $arr[0]['person_cum'];
					}

				}

				$this->db->trans_begin();

				$query1 = $this->db->query("
					SELECT * FROM tbl_damage_per_brgy t1 WHERE t1.disaster_title_id = '$did' AND t1.municipality_id = '$mid' and t1.brgy_id = '$bid'
				");

				if($query1->num_rows() < 1){

					$this->db->insert("tbl_damage_per_brgy",$data);

					$query2 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$did' AND municipality_id = '$mid'");

					$arx = $query2->result_array();

					$query3 = $this->db->query("
						SELECT * FROM tbl_damage_per_brgy t1 WHERE t1.disaster_title_id = '$did' AND t1.municipality_id = '$mid'
					");

					$tot 			= 0;
					$part 			= 0;
					$costasst_brgy 	= 0;
					$brgy_id 		= "";

					$arr = $query3->result_array();

					for($r = 0 ; $r < count($arr) ; $r++){

						$tot 		= (int) $tot + (int) $arr[$r]['totally_damaged'];
						$part 		= (int) $part + (int) $arr[$r]['partially_damaged'];

						if($r == 0){
							if((int) $arr[$r]['totally_damaged'] > 0 || (int) $arr[$r]['partially_damaged'] > 0){
								$brgy_id = $arr[$r]['brgy_id'];
							}
						}else{
							if((int) $arr[$r]['totally_damaged'] > 0 || (int) $arr[$r]['partially_damaged'] > 0){
								$brgy_id = $brgy_id."|".$arr[$r]['brgy_id'];
							}
						}

					}

					$data_tot = array(

						'disaster_title_id' 		=> $did,
						'municipality_id' 			=> $mid,
						'provinceid' 				=> $data['provinceid'],
						'totally_damaged' 			=> $tot,
						'partially_damaged' 		=> $part,
						'brgy_id' 					=> $brgy_id

					);

					if($query2->num_rows() < 1){
					
						$this->db->insert('tbl_casualty_asst',$data_tot);

					}else{

						$this->db->where('id',$arx[0]['id']);
						$this->db->update('tbl_casualty_asst',$data_tot);

					}

					if($this->db->trans_status() == FALSE){
						$this->db->trans_rollback();
						return 0;
					}else{
						$this->db->trans_commit();
						return 1;
					}

				}

			}else{


				if($affected_family < 1 || $affected_persons < 1){
					return 3;
				}else{

					$this->db->trans_begin();

					$query1 = $this->db->query("
						SELECT * FROM tbl_damage_per_brgy t1 WHERE t1.disaster_title_id = '$did' AND t1.municipality_id = '$mid' and t1.brgy_id = '$bid'
					");

					if($query1->num_rows() < 1){

						$this->db->insert("tbl_damage_per_brgy",$data);

						$query2 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$did' AND municipality_id = '$mid'");

						$arx = $query2->result_array();

						$query3 = $this->db->query("
							SELECT * FROM tbl_damage_per_brgy t1 WHERE t1.disaster_title_id = '$did' AND t1.municipality_id = '$mid'
						");

						$tot 			= 0;
						$part 			= 0;
						$costasst_brgy 	= 0;
						$brgy_id 		= "";

						$arr = $query3->result_array();

						for($r = 0 ; $r < count($arr) ; $r++){

							$tot 		= (int) $tot + (int) $arr[$r]['totally_damaged'];
							$part 		= (int) $part + (int) $arr[$r]['partially_damaged'];

							if($r == 0){
								if((int) $arr[$r]['totally_damaged'] > 0 || (int) $arr[$r]['partially_damaged'] > 0){
									$brgy_id = $arr[$r]['brgy_id'];
								}
							}else{
								if((int) $arr[$r]['totally_damaged'] > 0 || (int) $arr[$r]['partially_damaged'] > 0){
									$brgy_id = $brgy_id."|".$arr[$r]['brgy_id'];
								}
							}

						}

						$data_tot = array(

							'disaster_title_id' 		=> $did,
							'municipality_id' 			=> $mid,
							'provinceid' 				=> $data['provinceid'],
							'totally_damaged' 			=> $tot,
							'partially_damaged' 		=> $part,
							'brgy_id' 					=> $brgy_id

						);

						if($query2->num_rows() < 1){
						
							$this->db->insert('tbl_casualty_asst',$data_tot);

						}else{

							$this->db->where('id',$arx[0]['id']);
							$this->db->update('tbl_casualty_asst',$data_tot);

						}

						if($this->db->trans_status() == FALSE){
							$this->db->trans_rollback();
							return 0;
						}else{
							$this->db->trans_commit();
							return 1;
						}

					}
				}
			}


		}

		public function get_damage_per_brgy_details($id){

			$query = $this->db->where('id',$id);
			$query = $this->db->get('tbl_damage_per_brgy');

			$data['details'] = $query->result_array();
			$pid = $data['details'][0]['provinceid'];
			$mid = $data['details'][0]['municipality_id'];

			$q1 = $this->db->query("SELECT * FROM lib_municipality WHERE provinceid = '$pid'");
			$data['municipality'] = $q1->result_array();

			$q2 = $this->db->query("SELECT * FROM lib_barangay WHERE municipality_id = '$mid'");
			$data['barangay'] = $q2->result_array();

			return $data;


		}

		public function deletedamageperbrgy($id){

			$this->db->trans_begin();

			$query = $this->db->where('id',$id);
			$query = $this->db->get('tbl_damage_per_brgy');

			$data['details'] = $query->result_array();

			$mid 				= $data['details'][0]['municipality_id'];
			$disaster_title_id 	= $data['details'][0]['disaster_title_id'];
			$totally_damaged 	= $data['details'][0]['totally_damaged'];
			$partially_damaged 	= $data['details'][0]['partially_damaged'];

			$affected_family 	= $data['details'][0]['affected_family'];
			$affected_persons 	= $data['details'][0]['affected_persons'];

			$brgyid 			= $data['details'][0]['brgy_id'];

			$query2= $this->db->query("
											SELECT
												t1.brgy_located_ec,
												SUM ( t1.fam_cum :: INTEGER ) fam_cum,
												SUM ( t1.person_cum :: INTEGER ) person_cum 
											FROM
												(
												SELECT
													* 
												FROM
													(
													SELECT
														t2.brgy_located_ec,
														SUM ( t1.family_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														tbl_evacuation_stats t1
														LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
													WHERE
														t1.disaster_title_id = '$disaster_title_id' 
														AND t2.brgy_located_ec = '$brgyid' 
													GROUP BY
														t2.brgy_located_ec 
													) t1 UNION ALL
													(
													SELECT
														t1.brgy_host,
														SUM ( t1.family_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														tbl_evac_outside_stats t1 
													WHERE
														t1.disaster_title_id = '$disaster_title_id' 
														AND t1.brgy_host = '$brgyid' 
													GROUP BY
													t1.brgy_host 
												)) t1
												GROUP BY
														t1.brgy_located_ec 
			");

			$arr = $query2->result_array();

			$brgys2 = "";

			if($query2->num_rows() > 0){

				return 0;

			}else{

				$q1 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$disaster_title_id' AND municipality_id = '$mid'");

				$data['asst'] = $q1->result_array();


				$asstid = "";
				$totally_damaged_tot = 0;
				$partially_damaged_tot = 0;

				if(count($data['asst']) > 0){

					$asstid 				= $data['asst'][0]['id'];
					$totally_damaged_tot 	= (int) $data['asst'][0]['totally_damaged'] - (int) $totally_damaged;
					$partially_damaged_tot 	= (int) $data['asst'][0]['partially_damaged'] - (int) $partially_damaged;

				}

				$q2_1 = $this->db->where('id',$id);
				$q2_1 = $this->db->delete('tbl_damage_per_brgy');

				$q2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND municipality_id = '$mid'");

				$arr2 = $q2->result_array();

				for($r = 0 ; $r < count($arr2) ; $r++){

					if($r == 0){
						if((int) $arr2[$r]['totally_damaged'] > 0 || (int) $arr2[$r]['partially_damaged'] > 0){
							$brgys2 = $arr2[$r]['brgy_id'];
						}
					}else{
						if($brgys2 == ""){
							if((int) $arr2[$r]['totally_damaged'] > 0 || (int) $arr2[$r]['partially_damaged'] > 0){
								$brgys2 = $arr2[$r]['brgy_id'];
							}
						}else{
							if((int) $arr2[$r]['totally_damaged'] > 0 || (int) $arr2[$r]['partially_damaged'] > 0){
								$brgys2 = $brgys2."|".$arr2[$r]['brgy_id'];
							}
						}
					}
				}

				$dataup = array(
					'totally_damaged' 	=> $totally_damaged_tot,
					'partially_damaged' => $partially_damaged_tot,
					'brgy_id' 			=> $brgys2
				);

				$q3 = $this->db->where('id',$asstid);
				$q3 = $this->db->update('tbl_casualty_asst',$dataup);

				$this->db->trans_commit();
				return 1;

			}

		}

		public function updatedamageperbrgy($id,$disaster_title_id,$municipality_id,$brgy_dam_per_brgy,$provinceid,$data){

			$totally_damaged 	= 0;
			$partially_damaged 	= 0;
			$brgy_id 			= "";

			$affected_family = $data['affected_family'];
			$affected_persons = $data['affected_persons'];

			$bid = $brgy_dam_per_brgy;


			$query2= $this->db->query("
											SELECT
												t1.brgy_located_ec,
												SUM ( t1.fam_cum :: INTEGER ) fam_cum,
												SUM ( t1.person_cum :: INTEGER ) person_cum 
											FROM
												(
												SELECT
													* 
												FROM
													(
													SELECT
														t2.brgy_located_ec,
														SUM ( t1.family_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														tbl_evacuation_stats t1
														LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
													WHERE
														t1.disaster_title_id = '$disaster_title_id' 
														AND t2.brgy_located_ec = '$bid' 
													GROUP BY
														t2.brgy_located_ec 
													) t1 UNION ALL
													(
													SELECT
														t1.brgy_host,
														SUM ( t1.family_cum :: INTEGER ) fam_cum,
														SUM ( t1.person_cum :: INTEGER ) person_cum 
													FROM
														tbl_evac_outside_stats t1 
													WHERE
														t1.disaster_title_id = '$disaster_title_id' 
														AND t1.brgy_host = '$bid' 
													GROUP BY
													t1.brgy_host 
												)) t1
												GROUP BY
														t1.brgy_located_ec 
			");

			$arr = $query2->result_array();

			if($query2->num_rows() > 0){

				$this->db->trans_begin();

				try{

					$q_2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND brgy_id = '$bid'");
					$arr2 = $q_2->result_array();

					$bool_fam = ($arr[0]['fam_cum'] > $data['affected_family']);
						
					$bool_person = ($arr[0]['person_cum'] > $data['affected_persons']);


					if($bool_fam == TRUE || $bool_person == TRUE){
						return 2;
					}

					$brgys2 = "";	

					$q1 = $this->db->where('id',$id);
					$q1 = $this->db->update('tbl_damage_per_brgy',$data);

					if($q1){

						$q2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND municipality_id = '$municipality_id'");
						$arr = $q2->result_array();

						for($i = 0 ; $i < count($arr) ; $i++){

							$totally_damaged 	= (int) $totally_damaged + (int) $arr[$i]['totally_damaged'];
							$partially_damaged 	= (int) $partially_damaged + (int) $arr[$i]['partially_damaged'];

							if($i == 0){
								if((int) $arr[$i]['totally_damaged'] > 0 || (int) $arr[$i]['partially_damaged'] > 0){
									$brgys2 = $arr[$i]['brgy_id'];
								}
							}else{
								if($brgys2 == ""){
									if((int) $arr[$i]['totally_damaged'] > 0 || (int) $arr[$i]['partially_damaged'] > 0){
										$brgys2 = $arr[$i]['brgy_id'];
									}
								}else{
									if((int) $arr[$i]['totally_damaged'] > 0 || (int) $arr[$i]['partially_damaged'] > 0){
										$brgys2 = $brgys2."|".$arr[$i]['brgy_id'];
									}
								}
							}

						}

						$dataup = array(
							'disaster_title_id' => $disaster_title_id,
							'provinceid' 		=> $provinceid,
							'municipality_id' 	=> $municipality_id,
							'totally_damaged' 	=> $totally_damaged,
							'partially_damaged' => $partially_damaged,
							'brgy_id'			=> $brgys2
						);

						$q3 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$disaster_title_id' AND municipality_id = '$municipality_id'");
						$arx = $q3->result_array();

						if($q3->num_rows() > 0){

							$cid = $arx[0]['id'];

							$q4 = $this->db->where('id',$cid);
							$q4 = $this->db->update('tbl_casualty_asst',$dataup);

						}else{

							$q4 = $this->db->insert('tbl_casualty_asst',$dataup);

						}

					}

					$this->db->trans_commit();
					return 1;

				}catch(Exception $e){

					$this->db->trans_rollback();
					return 0; 

				}


			}else{

				$this->db->trans_begin();

				try{

					$q1 = $this->db->where('id',$id);
					$q1 = $this->db->update('tbl_damage_per_brgy',$data);

					$brgys2 = "";

					if($q1){

						$q2 = $this->db->query("SELECT * FROM tbl_damage_per_brgy WHERE disaster_title_id = '$disaster_title_id' AND municipality_id = '$municipality_id'");
						$arr = $q2->result_array();

						for($i = 0 ; $i < count($arr) ; $i++){

							$totally_damaged 	= (int) $totally_damaged + (int) $arr[$i]['totally_damaged'];
							$partially_damaged 	= (int) $partially_damaged + (int) $arr[$i]['partially_damaged'];

							if($i == 0){
								if((int) $arr[$i]['totally_damaged'] > 0 || (int) $arr[$i]['partially_damaged'] > 0){
									$brgys2 = $arr[$i]['brgy_id'];
								}
							}else{
								if($brgys2 == ""){
									if((int) $arr[$i]['totally_damaged'] > 0 || (int) $arr[$i]['partially_damaged'] > 0){
										$brgys2 = $arr[$i]['brgy_id'];
									}
								}else{
									if((int) $arr[$i]['totally_damaged'] > 0 || (int) $arr[$i]['partially_damaged'] > 0){
										$brgys2 = $brgys2."|".$arr[$i]['brgy_id'];
									}
								}
							}

						}


						$dataup = array(
							'disaster_title_id' => $disaster_title_id,
							'provinceid' 		=> $provinceid,
							'municipality_id' 	=> $municipality_id,
							'totally_damaged' 	=> $totally_damaged,
							'partially_damaged' => $partially_damaged,
							'brgy_id'			=> $brgys2
						);

						$q3 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$disaster_title_id' AND municipality_id = '$municipality_id'");
						$arx = $q3->result_array();

						if($q3->num_rows() > 0){

							$cid = $arx[0]['id'];

							$q4 = $this->db->where('id',$cid);
							$q4 = $this->db->update('tbl_casualty_asst',$dataup);

						}else{

							$q4 = $this->db->insert('tbl_casualty_asst',$dataup);

						}

					}
						
					$this->db->trans_commit();
					return 1;

				}catch(Exception $e){

					$this->db->trans_rollback();
					return 0;

				}

			}

		}

		public function get_spec_assistance($id){

			$query = $this->db->query("
										SELECT
											t1.*, t2.provinceid,
											t2.municipality_id,
											t2.family_served
										FROM
											tbl_fnfi_assistance_list t1
										LEFT JOIN tbl_fnfi_assistance t2 ON t1.fnfi_assistance_id = t2. ID
										WHERE
											t1. ID = '$id'
			");

			$data['rs'] = $query->result_array();

			$pid = $data['rs'][0]['provinceid'];
			$mid = $data['rs'][0]['municipality_id'];

			$query2 = $this->db->where('provinceid',$pid);
			$query2 = $this->db->get('lib_municipality');

			$data['city'] = $query2->result_array();

			$query3 = $this->db->where('municipality_id',$mid);
			$query3 = $this->db->get('lib_barangay');

			$data['brgy'] = $query3->result_array();

			return $data;

		}

		public function save_affected($obj){

			$query = $this->db->where('municipality_id', $obj['municipality_id']);
			$query = $this->db->where('disaster_title_id', $obj['disaster_title_id']);
			$query = $this->db->get('tbl_affected');


			if(count($query->result_array()) > 0){

				return 2;

			}else{

				$this->db->trans_begin(); 

				$this->db->insert('tbl_affected', $obj);

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    return 0;
				}
				else
				{
				    $this->db->trans_commit();
				    return 1;
				}

			}

		}

		public function save_affected2($obj){

			$array = array(
				'fam_no' 			=> $obj['fam_no'],
				'person_no' 		=> $obj['person_no'],
				'brgy_affected' 	=> $obj['brgy_affected']
			);

			$this->db->trans_begin(); 

			$query = $this->db->where('municipality_id', $obj['municipality_id']);
			$query = $this->db->where('disaster_title_id', $obj['disaster_title_id']);
			$query = $this->db->update('tbl_affected', $array);

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();
			    return 1;
			}
		}

		public function delete_affected($municipality_id, $disaster_title_id){

			$this->db->trans_begin(); 

			$query = $this->db->where('municipality_id', $municipality_id);
			$query = $this->db->where('disaster_title_id', $disaster_title_id);
			$query = $this->db->delete('tbl_affected');

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();
			    return 1;
			}
		}

		public function del_spec_assistance($id){

			$this->db->trans_begin();

			$dswd_asst = 0;

			$query1 = $this->db->query("
										SELECT
											t1.*, t2.provinceid,
											t2.municipality_id,
											t2.disaster_title_id,
											t2.family_served
										FROM
											tbl_fnfi_assistance_list t1
										LEFT JOIN tbl_fnfi_assistance t2 ON t1.fnfi_assistance_id = t2. ID
										WHERE
											t1. ID = '$id'
			");

			$data['rs'] = $query1->result_array();

			$fnfi_assistance_id = $data['rs'][0]['fnfi_assistance_id'];

			$disaster_title_id 	= $data['rs'][0]['disaster_title_id'];
			$municipality_id 	= $data['rs'][0]['municipality_id'];

			if($query1){

				$query2 = $this->db->where('id',$id);
				$query2 = $this->db->delete('tbl_fnfi_assistance_list');

				if($query2){

					$query3 = $this->db->query("
												SELECT
													t1.*
												FROM
													tbl_fnfi_assistance_list t1
												WHERE
													t1.fnfi_assistance_id = '$fnfi_assistance_id'
					");

					$data['tot'] = $query3->result_array();

					for($i = 0 ; $i < count($data['tot']) ; $i++){
						$dswd_asst = (int) $dswd_asst + (int) ($data['tot'][$i]['cost'] * $data['tot'][$i]['quantity']);
					}

					$query4 = $this->db->query("SELECT * FROM tbl_casualty_asst WHERE disaster_title_id = '$disaster_title_id' AND municipality_id = '$municipality_id'");
					$data['asst'] = $query4->result_array();

					$aid = $data['asst'][0]['id'];

					$dataup = array(
						'dswd_asst' => $dswd_asst
					);

					$query5 = $this->db->where('id',$aid);
					$query5 = $this->db->update('tbl_casualty_asst',$dataup);

					$w = $this->db->where('fnfi_assistance_id',$fnfi_assistance_id);
					$w = $this->db->get('tbl_fnfi_assistance_list');

					if($w->num_rows() < 1){
						$query2 = $this->db->where('id',$fnfi_assistance_id);
						$query2 = $this->db->delete('tbl_fnfi_assistance');
					}

				}

			}

			if($this->db->trans_status() == FALSE){
				$this->db->trans_rollback();
				return 0;
			}else{
				$this->db->trans_commit();
				return 1;
			}

			
		}

		public function get_assistancetype_li(){

			$query = $this->db->get("tbl_assistance_type");
			return $query->result_array();

		}

		public function get_congressional($month,$year){

			$querycity = $this->db->query("SELECT
											t2.province_name,
											t1.district,
											t1.municipality_name,
											t1. ID AS municipality_id
										FROM
											lib_municipality t1
										LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
										WHERE
											t1.district IS NOT NULL
										ORDER BY
											t1.district ASC,
											t1. ID ASC
			");

			$data['city'] = $querycity->result_array();

			$querycfw2 = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																date_part(
																	'month',
																	t1.date_augmented :: DATE
																) = '$month'::numeric
															AND date_part(
																'year',
																t1.date_augmented :: DATE
															) = '$year'::numeric
															AND t4.assistance_type_gen = 'cfw'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['cfw2'] = $querycfw2->result_array();

			$queryesa = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																date_part(
																	'month',
																	t1.date_augmented :: DATE
																) = '$month'::numeric
															AND date_part(
																'year',
																t1.date_augmented :: DATE
															) = '$year'::numeric
															AND t4.assistance_type_gen = 'esa'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['esa'] = $queryesa->result_array();

			$queryffw = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																date_part(
																	'month',
																	t1.date_augmented :: DATE
																) = '$month'::numeric
															AND date_part(
																'year',
																t1.date_augmented :: DATE
															) = '$year'::numeric
															AND t4.assistance_type_gen = 'aug_ffw'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['ffw'] = $queryffw->result_array();

			$queryaug = $this->db->query("SELECT
											t1.municipality_id,
											SUM (t1.number_served :: NUMERIC) serve,
											SUM (t1.amount :: NUMERIC) amount
										FROM
											(
												SELECT
													t1.municipality_id,
													t1.municipality_name,
													t1.amount,
													t1.number_served
												FROM
													(
														SELECT
															t1.*, t2.number_served,
															t2.municipality_id,
															t3.municipality_name,
															t4.assistance_type_gen,
															t2.amount
														FROM
															tbl_augmentation_list_spec t1
														LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
														LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
														LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
														WHERE
															date_part(
																'month',
																t1.date_augmented :: DATE
															) = '$month'::numeric
														AND date_part(
															'year',
															t1.date_augmented :: DATE
														) = '$year'::numeric
														AND t4.assistance_type_gen = 'aug'
														ORDER BY
															t2.municipality_id ASC,
															t1.date_augmented ASC
													) t1
												GROUP BY
													t1.municipality_name,
													t1.municipality_id,
													t1.date_augmented,
													t1.number_served,
													t1.amount
											) t1
										GROUP BY
											t1.municipality_id
			");

			$data['aug'] = $queryaug->result_array();

			return $data;

		}

		public function get_congressional_quart($quarter,$year){

			$querycity = $this->db->query("SELECT
											t2.province_name,
											t1.district,
											t1.municipality_name,
											t1. ID AS municipality_id
										FROM
											lib_municipality t1
										LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
										WHERE
											t1.district IS NOT NULL
										ORDER BY
											t1.district ASC,
											t1. ID ASC
			");

			$data['city'] = $querycity->result_array();

			$querycfw2 = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																EXTRACT (
																	QUARTER
																	FROM
																		t1.date_augmented :: DATE
																) = $quarter :: NUMERIC
															AND date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'cfw'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['cfw2'] = $querycfw2->result_array();

			$queryesa = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																EXTRACT (
																	QUARTER
																	FROM
																		t1.date_augmented :: DATE
																) = $quarter :: NUMERIC
															AND date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'esa'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['esa'] = $queryesa->result_array();

			$queryffw = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																EXTRACT (
																	QUARTER
																	FROM
																		t1.date_augmented :: DATE
																) = $quarter :: NUMERIC
															AND date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'aug_ffw'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['ffw'] = $queryffw->result_array();

			$queryaug = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																EXTRACT (
																	QUARTER
																	FROM
																		t1.date_augmented :: DATE
																) = $quarter :: NUMERIC
															AND date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'aug'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['aug'] = $queryaug->result_array();

			return $data;

		}

		public function get_congressional_yearly($year){

			$querycity = $this->db->query("SELECT
											t2.province_name,
											t1.district,
											t1.municipality_name,
											t1. ID AS municipality_id
										FROM
											lib_municipality t1
										LEFT JOIN lib_provinces t2 ON t1.provinceid = t2. ID
										WHERE
											t1.district IS NOT NULL
										ORDER BY
											t1.district ASC,
											t1. ID ASC
			");

			$data['city'] = $querycity->result_array();

			$querycfw2 = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'cfw'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['cfw2'] = $querycfw2->result_array();

			$queryesa = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'esa'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['esa'] = $queryesa->result_array();

			$queryffw = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'aug_ffw'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['ffw'] = $queryffw->result_array();

			$queryaug = $this->db->query("SELECT
												t1.municipality_id,
												SUM (t1.number_served :: NUMERIC) serve,
												SUM (t1.amount :: NUMERIC) amount
											FROM
												(
													SELECT
														t1.municipality_id,
														t1.municipality_name,
														t1.amount,
														t1.number_served
													FROM
														(
															SELECT
																t1.*, t2.number_served,
																t2.municipality_id,
																t3.municipality_name,
																t4.assistance_type_gen,
																t2.amount
															FROM
																tbl_augmentation_list_spec t1
															LEFT JOIN tbl_augmentation_list t2 ON t1.augment_list_id = t2. ID
															LEFT JOIN lib_municipality t3 ON t2.municipality_id = t3. ID
															LEFT JOIN tbl_assistance_type t4 ON t1.augment_list_code = t4.assistance_type_sub_gen
															WHERE
																date_part(
																'year',
																t1.date_augmented :: DATE
															) = $year :: NUMERIC
															AND t4.assistance_type_gen = 'aug'
															ORDER BY
																t2.municipality_id ASC,
																t1.date_augmented ASC
														) t1
													GROUP BY
														t1.municipality_name,
														t1.municipality_id,
														t1.date_augmented,
														t1.number_served,
														t1.amount
												) t1
											GROUP BY
												t1.municipality_id
			");

			$data['aug'] = $queryaug->result_array();

			return $data;

		}

		public function get_disaster_events(){

			$d_events = $this->db->query("SELECT
												*
											FROM
												(
													SELECT
														t1. ID,
														t1.disaster_name,
														t1.disaster_date :: DATE
													FROM
														tbl_dromic t1
													ORDER BY
														t1. ID
												) t1
											ORDER BY
												t1.disaster_date DESC
										");

			return $d_events->result_array();

		}

		public function get_unique_lgus($year){

			$d_events = $this->db->query("SELECT
												COUNT (*)
											FROM
												(
													SELECT DISTINCT
														(t1.municipality_id)
													FROM
														tbl_augmentation_list t1
													LEFT JOIN tbl_augmentation_list_spec t2 ON t1.id = t2.augment_list_id
													WHERE extract(year from t2.date_augmented) = '$year'
												) t1
										");

			return $d_events->result_array();

		}

		public function getDromic(){

			$d_events = $this->db->query("SELECT * FROM tbl_dromic ORDER BY disaster_date DESC");

			return $d_events->result_array();

		}

		public function savetoDisasterReport($data){

			$etype = $data['message'][0];

			$dromic_id = $data['dromic_id'];

			$query1 = $this->db->query("SELECT MAX(id) as maxid FROM tbl_disaster_title WHERE dromic_id = '$dromic_id'");

			if($query1->num_rows() > 0){

				$id = $query1->result_array();
				$id = $id[0]["maxid"];

				if($etype == "E"){

					$municipality_name = $data['message'][2];

					$query2 = $this->db->query("SELECT id FROM lib_municipality WHERE municipality_name = '$municipality_name'");

					$municipality_id = $query2->result_array();
					$municipality_id = $municipality_id[0]["id"];

					$query3 = $this->db->query("SELECT * FROM tbl_evacuation_stats WHERE disaster_title_id = '$id' AND municipality_id = '$municipality_id'");

					
				}


			}else{
				return 0;
			}

		}

		public function signup_user($data){

			$password 	= "\=45f=".md5($data['password'])."==//87*1)";
			$password 	= sha1(md5($password));

			$datas = array(
				'firstname' 		=> $data['firstname'],
				'middlename' 		=> $data['middlename'],
				'lastname' 			=> $data['lastname'],
				'regionid' 			=> $data['regionid'],
				'provinceid' 		=> $data['provinceid'],
				'municipality_id' 	=> $data['municipality_id'],
				'address' 			=> $data['address'],
				'agency' 			=> $data['agency'],
				'designation' 		=> $data['position'],
				'emailaddress' 		=> $data['emailaddress'],
				'mobile' 			=> $data['mobile'],
				'username' 			=> $data['username'],
				'password_hash' 	=> $password,
				'isdswd' 			=> 'f'
			);

			$username = $data['username'];


			$query1 = $this->db->query("SELECT * FROM tbl_auth_user_profile WHERE username = '$username'");

			if($query1->num_rows() > 0){

				return 2;

			}else{

				$query = $this->db->insert('tbl_auth_user_profile',$datas);

				if($query){

					$datains = array(
						'fullname' 				=> strtoupper($data['firstname']) . " " . strtoupper($data['lastname']),
						'position' 				=> strtoupper($data['position']),
						'username' 				=> $data['username'],
						'password' 				=> $password,
						'isadmin' 				=> 'f',
						'ishead' 				=> 'f',
						'isactivated' 			=> 'f',
						'can_create_report' 	=> 'f'
					);

					$query2 = $this->db->insert('tbl_auth_user',$datains);

					return 1;

				}else{

					return 0;

				}

			}


		}

		public function save_reports_assignment($disaster_reports,$users_list,$username,$can_edit){


			$this->db->trans_begin(); 

			$arr = array();

			for($i = 0 ; $i < count($disaster_reports) ; $i++){

				for($j = 0 ; $j < count($users_list) ; $j++){

					$arr = array(
						'dromic_id' 			=> $disaster_reports[$i]['dromic_id'],
						'can_access_username' 	=> $users_list[$j]['can_access_username'],
						'assigned_by_username' 	=> $username,
						'can_edit' 				=> $can_edit
					);

					$query1 = $this->db->insert('tbl_reports_assignment',$arr);

				}

			}

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();
			    return 1;
			}


		}

		public function get_can_edit($id,$username){


			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

			$arr = $query->result_array();

			$ids = $arr[0]['dromic_id'];

			$query2 = $this->db->query("SELECT * FROM tbl_dromic WHERE id = '$ids'");

			$arr2 = $query2->result_array();

			if($username == $arr2[0]['created_by_user']){

				return 1;

			}else{

				$query3 = $this->db->query("SELECT * FROM tbl_reports_assignment WHERE dromic_id = '$ids' AND can_access_username = '$username'");

				$arr3 = $query3->result_array();

				if($arr3[0]['can_edit'] == 't'){
					return 1;
				}else{
					return 0;
				}

			}


		}


		public function save_report_comment($id, $msg, $username){

			

			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

			$arr = $query->result_array();

			$ids = $arr[0]['dromic_id'];

			$data = array(
				'disaster_title_id' 	=> $ids,
				'msg' 					=> $msg,
				'by_user' 				=> $username
			);

			$this->db->trans_begin(); 

			$query1 = $this->db->insert('tbl_comments',$data);

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();
			    return 1;
			}
			

		}

		public function get_comments($id){

			$arr2 = array();


			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

			$arr = $query->result_array();

			$ids = $arr[0]['dromic_id'];

			$query1 = $this->db->query("SELECT * FROM tbl_comments t1 WHERE t1.disaster_title_id = '$ids' ORDER BY t1.date DESC, t1.time DESC");

			$arr2['comment'] = $query1->result_array();

			$query2 = $this->db->query("SELECT * FROM tbl_replies t1 WHERE t1.dromic_id = '$ids' ORDER BY t1.date_added ASC, t1.time ASC");

			$arr2['reply'] = $query2->result_array();

			return $arr2;

		}

		public function get_can_view($id,$username){


			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

			$arr = $query->result_array();

			$ids = $arr[0]['dromic_id'];

			$query2 = $this->db->query("SELECT * FROM tbl_dromic WHERE id = '$ids'");

			$arr2 = $query2->result_array();

			if($username == $arr2[0]['created_by_user']){

				return 1;

			}else{

				$query3 = $this->db->query("SELECT * FROM tbl_reports_assignment WHERE dromic_id = '$ids' AND can_access_username = '$username'");

				if($query3->num_rows() >= 1){
					return 1;
				}else{
					return 0;
				}

			}


		}

		public function getmunicipality($id){


			$data = [];

			$query = $this->db->where('id',$id);
			$query = $this->db->get('lib_municipality');

			$arr = $query->result_array();

			$provinceid = $arr[0]['provinceid'];

			$query1 = $this->db->where('provinceid',$provinceid);
			$query1 = $this->db->get('lib_municipality');

			$data = $query1->result_array();

			$query2 = $this->db->where('provinceid',$provinceid);
			$query2 = $this->db->get('lib_barangay');

			$data['brgy'] = $query2->result_array();

			return $data;

		}

		public function getbrgy($brgyid, $disaster_title_id){


			$query = $this->db->where('brgy_id', $brgyid);
			$query = $this->db->where('disaster_title_id', $disaster_title_id);
			$query = $this->db->get('tbl_damage_per_brgy');

			$arr = $query->result_array();

			if(count($arr) > 0){

				$data['rs'] = $arr;

				$provinceid = $arr[0]['provinceid'];
				$municipality_id = $arr[0]['municipality_id'];

				$query1 = $this->db->where('provinceid',$provinceid);
				$query1 = $this->db->get('lib_municipality');

				$data['municipality'] = $query1->result_array();

				$query2 = $this->db->where('municipality_id',$municipality_id);
				$query2 = $this->db->get('lib_barangay');

				$data['brgy'] = $query2->result_array();

				return $data;

			}else{

				$query = $this->db->where('id', $brgyid);
				$query = $this->db->get('lib_barangay');

				$arr = $query->result_array();

				$provinceid = $arr[0]['provinceid'];
				$municipality_id = $arr[0]['municipality_id'];

				$query1 = $this->db->where('provinceid',$provinceid);
				$query1 = $this->db->get('lib_municipality');

				$data['municipality'] = $query1->result_array();

				$query2 = $this->db->where('municipality_id',$municipality_id);
				$query2 = $this->db->get('lib_barangay');

				$data['brgy'] = $query2->result_array();

				$data['rs'] = [];

				$data['ismunicipal'] = [$municipality_id];

				return $data;

			}

		}

		public function save_reply($id, $msg, $comment_id, $username){

			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

			$arr = $query->result_array();

			$ids = $arr[0]['dromic_id'];

			$data = array(
				'dromic_id' 			=> $ids,
				'msg' 					=> nl2br($msg),
				'comment_id' 			=> $comment_id,
				'by_user' 				=> $username
			);

			$this->db->trans_begin(); 

			$query1 = $this->db->insert('tbl_replies',$data);

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();
			    return 1;
			}
			

		}


		public function upload_file($data){


			$this->db->trans_begin(); 

			$query1 = $this->db->insert('tbl_narrative_report', $data);

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 0;
			}
			else
			{
			    $this->db->trans_commit();
			    return 1;
			}
			

		}

		public function get_if_narrative($id){

			$c = 0;

			$query = $this->db->query("SELECT * FROM tbl_narrative_report WHERE  disaster_title_id = '$id'");

			$arr = array();

			$arr = $query->result_array();

			for ($i = 0; $i < count($arr); $i++) { 
				$c += 1;
			}

			return $c;
			

		}

		public function get_map_region($id,$regionid){

			$query = $this->db->query("SELECT
											row_to_json (fc) AS features
										FROM
											(
												SELECT
													'FeatureCollection' AS TYPE,
													array_to_json (ARRAY_AGG(f)) AS features
												FROM
													(
														SELECT
															'Feature' AS TYPE,
															t1.mun_code AS ID,
															row_to_json (t2) properties,
															st_asgeojson (st_union(t1.geom)) :: json geometry
														FROM
															lib_municipality_boundaries t1
														LEFT JOIN (
															SELECT
																t1.mun_code municipality_id,
																t1.mun_name municipality_name,
																t3.province_name,
																COALESCE (t2.fam_cum, 0) density -- 	st_asgeojson (st_union(t1.geom)) :: json geometry
															FROM
																lib_municipality_boundaries t1
															LEFT JOIN (
																SELECT
																	t1.*
																FROM
																	(
																		SELECT
																			t1.municipality_id,
																			SUM (t1.fam_cum) fam_cum
																		FROM
																			(
																				SELECT
																					t1.*
																				FROM
																					(
																						SELECT
																							t1.municipality_id,
																							SUM (t1.family_cum :: INTEGER) AS fam_cum
																						FROM
																							tbl_evacuation_stats t1
																						LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
																						WHERE
																							t1.disaster_title_id = '$id'
																						GROUP BY
																							t1.municipality_id
																					) t1
																				UNION
																					(
																						SELECT
																							t2.municipality_id,
																							SUM (t2.family_cum :: INTEGER) AS fam_cum
																						FROM
																							tbl_evac_outside_stats t2
																						LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
																						WHERE
																							t2.disaster_title_id = '$id'
																						GROUP BY
																							t2.municipality_id
																					)
																			) t1
																		GROUP BY
																			t1.municipality_id
																	) t1
															) t2 ON t1.mun_code = t2.municipality_id
															LEFT JOIN lib_provinces t3 ON t1.pro_code = t3. ID
															GROUP BY
																t1.mun_code,
																t1.mun_name,
																t3.province_name,
																t2.fam_cum
														) t2 ON t1.mun_code = t2.municipality_id
														WHERE t1.reg_code = '$regionid'
														GROUP BY
															t2.*, t1.mun_code
													) f
											) AS fc
										");

			$arr = array();

			$arr = $query->result_array();

			$str = "";

			$str = $arr[0]['features'];

			return json_decode($str);
			
		}
		
		public function getsexdata($id){

			session_start();

			$user_level_access = $_SESSION['user_level_access'];
			$provinceid = $_SESSION['provinceid'];
			$municipality_id = $_SESSION['municipality_id'];

			if($user_level_access == "region" || $user_level_access == "national"){

				$query_id = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

				$arr = $query_id->result_array();

				$dromic_id = $arr[0]["dromic_id"];

				$query = $this->db->query("SELECT
												* 
											FROM
												(
												SELECT 
													(SUM ( NULLIF ( infant_male_cum, '' ) :: INTEGER )) + (SUM ( NULLIF ( infant_female_cum, '' ) :: INTEGER )) infant,
													(SUM ( NULLIF ( toddler_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( toddler_female_cum, '' ) :: INTEGER )) toddler,
													(SUM ( NULLIF ( preschooler_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( preschooler_female_cum, '' ) :: INTEGER )) preschooler,
													(SUM ( NULLIF ( schoolage_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( schoolage_female_cum, '' ) :: INTEGER )) schoolage,
													(SUM ( NULLIF ( teenage_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( teenage_female_cum, '' ) :: INTEGER )) teenage,
													(SUM ( NULLIF ( adult_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( adult_female_cum, '' ) :: INTEGER )) adult,
													(SUM ( NULLIF ( senior_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( senior_female_cum, '' ) :: INTEGER )) senior,
													SUM ( NULLIF ( pregnant_cum, '' ) :: INTEGER ) pregnant_cum,
													SUM ( NULLIF ( lactating_cum, '' ) :: INTEGER ) lactating_cum,
													(SUM ( NULLIF ( disable_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( disable_female_cum, '' ) :: INTEGER )) disabled,
													SUM ( NULLIF ( solo_cum, '' ) :: INTEGER ) solo_cum,
													SUM ( NULLIF ( ip_cum, '' ) :: INTEGER ) ip_cum 
												FROM
													tbl_sex_gender_data t1 
												WHERE
												disaster_title_id = '$id' 
												) t1"
				);

				$arr = $query->result_array();

				$infant 		= $arr[0]['infant'];
				$toddler 		= $arr[0]['toddler'];
				$preschooler 	= $arr[0]['preschooler'];
				$schoolage 		= $arr[0]['schoolage'];
				$teenage 		= $arr[0]['teenage'];
				$adult 			= $arr[0]['adult'];
				$senior 		= $arr[0]['senior'];
				$pregnant_cum 	= $arr[0]['pregnant_cum'];
				$lactating_cum 	= $arr[0]['lactating_cum'];
				$disabled 		= $arr[0]['disabled'];
				$solo_cum 		= $arr[0]['solo_cum'];
				$ip_cum 		= $arr[0]['ip_cum'];

				if(!is_null($infant)){

					$data['all'][] = array(
						'name' 			=> 'Infant',
						'y' 			=> (int)$infant,
					);

				}

				if(!is_null($toddler)){

					$data['all'][] = array(
						'name' 			=> 'Toddler',
						'y' 			=> (int)$toddler,
					);

				}

				if(!is_null($preschooler)){

					$data['all'][] = array(
						'name' 			=> 'Preschooler',
						'y' 			=> (int)$preschooler,
					);

				}

				if(!is_null($schoolage)){

					$data['all'][] = array(
						'name' 			=> 'Schoolage',
						'y' 			=> (int)$schoolage,
					);

				}

				if(!is_null($teenage)){

					$data['all'][] = array(
						'name' 			=> 'Teenage',
						'y' 			=> (int)$teenage,
					);

				}

				if(!is_null($adult)){

					$data['all'][] = array(
						'name' 			=> 'Adult',
						'y' 			=> (int)$adult,
					);

				}

				if(!is_null($senior)){

					$data['all'][] = array(
						'name' 			=> 'Senior Citizen',
						'y' 			=> (int)$senior,
					);

				}

				if(!is_null($pregnant_cum)){

					$data['all'][] = array(
						'name' 			=> 'Pregnant Women',
						'y' 			=> (int)$pregnant_cum,
					);

				}

				if(!is_null($lactating_cum)){

					$data['all'][] = array(
						'name' 			=> 'Lactating Women',
						'y' 			=> (int)$lactating_cum,
					);

				}

				if(!is_null($disabled)){

					$data['all'][] = array(
						'name' 			=> 'Disabled',
						'y' 			=> (int)$disabled,
					);

				}

				if(!is_null($solo_cum)){

					$data['all'][] = array(
						'name' 			=> 'Solo Parents',
						'y' 			=> (int)$solo_cum,
					);

				}

				if(!is_null($ip_cum)){

					$data['all'][] = array(
						'name' 			=> 'Indigenous Persons',
						'y' 			=> (int)$ip_cum,
					);

				}

				$query1 = $this->db->query("SELECT
												* 
											FROM
												(
												SELECT 
													SUM ( NULLIF ( infant_male_cum, '' ) :: INTEGER ) infant_male_cum,
													SUM ( NULLIF ( infant_female_cum, '' ) :: INTEGER ) infant_female_cum,
													SUM ( NULLIF ( toddler_male_cum, '' ) :: INTEGER ) toddler_male_cum,
													SUM ( NULLIF ( toddler_female_cum, '' ) :: INTEGER ) toddler_female_cum,
													SUM ( NULLIF ( preschooler_male_cum, '' ) :: INTEGER ) preschooler_male_cum, 
													SUM ( NULLIF ( preschooler_female_cum, '' ) :: INTEGER ) preschooler_female_cum,
													SUM ( NULLIF ( schoolage_male_cum, '' ) :: INTEGER ) schoolage_male_cum, 
													SUM ( NULLIF ( schoolage_female_cum, '' ) :: INTEGER ) schoolage_female_cum,
													SUM ( NULLIF ( teenage_male_cum, '' ) :: INTEGER ) teenage_male_cum, 
													SUM ( NULLIF ( teenage_female_cum, '' ) :: INTEGER ) teenage_female_cum,
													SUM ( NULLIF ( adult_male_cum, '' ) :: INTEGER ) adult_male_cum, 
													SUM ( NULLIF ( adult_female_cum, '' ) :: INTEGER ) adult_female_cum,
													SUM ( NULLIF ( senior_male_cum, '' ) :: INTEGER ) senior_male_cum, 
													SUM ( NULLIF ( senior_female_cum, '' ) :: INTEGER ) senior_female_cum,
													SUM ( NULLIF ( pregnant_cum, '' ) :: INTEGER ) pregnant_cum,
													SUM ( NULLIF ( lactating_cum, '' ) :: INTEGER ) lactating_cum,
													SUM ( NULLIF ( disable_male_cum, '' ) :: INTEGER ) disable_male_cum, 
													SUM ( NULLIF ( disable_female_cum, '' ) :: INTEGER ) disable_female_cum,
													SUM ( NULLIF ( solo_cum, '' ) :: INTEGER ) solo_cum,
													SUM ( NULLIF ( ip_cum, '' ) :: INTEGER ) ip_cum 
												FROM
													tbl_sex_gender_data t1 
												WHERE
												disaster_title_id = '$id'
												) t1"
				);

				$arr1 = $query1->result_array();

				$data['categories'] = array();
				$data['male'] = array();
				$data['female'] = array();
				$data['solo'] = array();
				$data['ip'] = array();
				
				$infant_male_cum 			= $arr1[0]['infant_male_cum'];
				$infant_female_cum 			= $arr1[0]['infant_female_cum'];
				$toddler_male_cum 			= $arr1[0]['toddler_male_cum'];
				$toddler_female_cum 		= $arr1[0]['toddler_female_cum'];
				$preschooler_male_cum 		= $arr1[0]['preschooler_male_cum'];
				$preschooler_female_cum 	= $arr1[0]['preschooler_female_cum'];
				$schoolage_male_cum 		= $arr1[0]['schoolage_male_cum'];
				$schoolage_female_cum 		= $arr1[0]['schoolage_female_cum'];
				$teenage_male_cum 			= $arr1[0]['teenage_male_cum'];
				$teenage_female_cum 		= $arr1[0]['teenage_female_cum'];
				$adult_male_cum 			= $arr1[0]['adult_male_cum'];
				$adult_female_cum 			= $arr1[0]['adult_female_cum'];
				$senior_male_cum 			= $arr1[0]['senior_male_cum'];
				$senior_female_cum 			= $arr1[0]['senior_female_cum'];
				$pregnant_cum 				= $arr1[0]['pregnant_cum'];
				$lactating_cum 				= $arr1[0]['lactating_cum'];
				$disable_male_cum 			= $arr1[0]['disable_male_cum'];
				$disable_female_cum 		= $arr1[0]['disable_female_cum'];
				$solo_cum 					= $arr1[0]['solo_cum'];
				$ip_cum 					= $arr1[0]['ip_cum'];

				if(!is_null($infant_male_cum) || !is_null($infant_female_cum)){
					array_push($data['categories'],"Infant"); 

					if(!is_null($infant_male_cum)){
						array_push($data['male'],(int)$infant_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($infant_female_cum)){
						array_push($data['female'],(int)$infant_female_cum); 
					}else{
						array_push($data['female'],0);
					}

					array_push($data['solo'],0);
					array_push($data['ip'],0); 

				}

				if(!is_null($toddler_male_cum) || !is_null($toddler_female_cum)){
					array_push($data['categories'],"Toddler"); 

					if(!is_null($toddler_male_cum)){
						array_push($data['male'],(int)$toddler_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($toddler_female_cum)){
						array_push($data['female'],(int)$toddler_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($preschooler_male_cum) || !is_null($preschooler_female_cum)){
					array_push($data['categories'],"Preschooler"); 

					if(!is_null($preschooler_male_cum)){
						array_push($data['male'],(int)$preschooler_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($preschooler_female_cum)){
						array_push($data['female'],(int)$preschooler_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($schoolage_male_cum) || !is_null($schoolage_female_cum)){
					array_push($data['categories'],"Schoolage"); 

					if(!is_null($schoolage_male_cum)){
						array_push($data['male'],(int)$schoolage_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($schoolage_female_cum)){
						array_push($data['female'],(int)$schoolage_female_cum); 
					}else{
						array_push($data['female'],0);
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($teenage_male_cum) || !is_null($teenage_female_cum)){
					array_push($data['categories'],"Teenage"); 

					if(!is_null($teenage_male_cum)){
						array_push($data['male'],(int)$teenage_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($teenage_female_cum)){
						array_push($data['female'],(int)$teenage_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($adult_male_cum) || !is_null($adult_female_cum)){
					array_push($data['categories'],"Adult");

					if(!is_null($adult_male_cum)){
						array_push($data['male'],(int)$adult_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($adult_female_cum)){
						array_push($data['female'],(int)$adult_female_cum); 
					}else{
						array_push($data['female'],0);
					}
					array_push($data['solo'],0); 
					array_push($data['ip'],0); 
				}

				if(!is_null($senior_male_cum) || !is_null($senior_female_cum)){
					array_push($data['categories'],"Senior Citizen"); 

					if(!is_null($senior_male_cum)){
						array_push($data['male'],(int)$senior_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($senior_female_cum)){
						array_push($data['female'],(int)$senior_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($pregnant_cum)){
					array_push($data['categories'],"Pregnant Women"); 

					array_push($data['male'],0);

					if(!is_null($pregnant_cum)){
						array_push($data['female'],(int)$pregnant_cum); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($lactating_cum)){
					array_push($data['categories'],"Lactating Women"); 

					array_push($data['male'],0);

					if(!is_null($lactating_cum)){
						array_push($data['female'],(int)$lactating_cum); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($disable_male_cum) || !is_null($disable_female_cum)){
					array_push($data['categories'],"Disabled"); 

					if(!is_null($disable_male_cum)){
						array_push($data['male'],(int)$disable_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($disable_female_cum)){
						array_push($data['female'],(int)$disable_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($solo_cum)){
					array_push($data['categories'],"Solo Parent"); 

					array_push($data['solo'],(int)$solo_cum); 
				}

				if(!is_null($ip_cum)){
					array_push($data['categories'],"Indigenous Persons"); 

						array_push($data['ip'],(int)$ip_cum); 
				}

				return $data;

			}else if($user_level_access == "province"){

				$query_id = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

				$arr = $query_id->result_array();

				$dromic_id = $arr[0]["dromic_id"];

				$query = $this->db->query("SELECT
												* 
											FROM
												(
												SELECT 
													(SUM ( NULLIF ( infant_male_cum, '' ) :: INTEGER )) + (SUM ( NULLIF ( infant_female_cum, '' ) :: INTEGER )) infant,
													(SUM ( NULLIF ( toddler_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( toddler_female_cum, '' ) :: INTEGER )) toddler,
													(SUM ( NULLIF ( preschooler_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( preschooler_female_cum, '' ) :: INTEGER )) preschooler,
													(SUM ( NULLIF ( schoolage_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( schoolage_female_cum, '' ) :: INTEGER )) schoolage,
													(SUM ( NULLIF ( teenage_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( teenage_female_cum, '' ) :: INTEGER )) teenage,
													(SUM ( NULLIF ( adult_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( adult_female_cum, '' ) :: INTEGER )) adult,
													(SUM ( NULLIF ( senior_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( senior_female_cum, '' ) :: INTEGER )) senior,
													SUM ( NULLIF ( pregnant_cum, '' ) :: INTEGER ) pregnant_cum,
													SUM ( NULLIF ( lactating_cum, '' ) :: INTEGER ) lactating_cum,
													(SUM ( NULLIF ( disable_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( disable_female_cum, '' ) :: INTEGER )) disabled,
													SUM ( NULLIF ( solo_cum, '' ) :: INTEGER ) solo_cum,
													SUM ( NULLIF ( ip_cum, '' ) :: INTEGER ) ip_cum 
												FROM
													tbl_sex_gender_data t1 
												WHERE
												disaster_title_id = '$id' 
												AND t1.province_id = '$provinceid'
												) t1"
				);

				$arr = $query->result_array();

				$infant 		= $arr[0]['infant'];
				$toddler 		= $arr[0]['toddler'];
				$preschooler 	= $arr[0]['preschooler'];
				$schoolage 		= $arr[0]['schoolage'];
				$teenage 		= $arr[0]['teenage'];
				$adult 			= $arr[0]['adult'];
				$senior 		= $arr[0]['senior'];
				$pregnant_cum 	= $arr[0]['pregnant_cum'];
				$lactating_cum 	= $arr[0]['lactating_cum'];
				$disabled 		= $arr[0]['disabled'];
				$solo_cum 		= $arr[0]['solo_cum'];
				$ip_cum 		= $arr[0]['ip_cum'];

				if(!is_null($infant)){

					$data['all'][] = array(
						'name' 			=> 'Infant',
						'y' 			=> (int)$infant,
					);

				}

				if(!is_null($toddler)){

					$data['all'][] = array(
						'name' 			=> 'Toddler',
						'y' 			=> (int)$toddler,
					);

				}

				if(!is_null($preschooler)){

					$data['all'][] = array(
						'name' 			=> 'Preschooler',
						'y' 			=> (int)$preschooler,
					);

				}

				if(!is_null($schoolage)){

					$data['all'][] = array(
						'name' 			=> 'Schoolage',
						'y' 			=> (int)$schoolage,
					);

				}

				if(!is_null($teenage)){

					$data['all'][] = array(
						'name' 			=> 'Teenage',
						'y' 			=> (int)$teenage,
					);

				}

				if(!is_null($adult)){

					$data['all'][] = array(
						'name' 			=> 'Adult',
						'y' 			=> (int)$adult,
					);

				}

				if(!is_null($senior)){

					$data['all'][] = array(
						'name' 			=> 'Senior Citizen',
						'y' 			=> (int)$senior,
					);

				}

				if(!is_null($pregnant_cum)){

					$data['all'][] = array(
						'name' 			=> 'Pregnant Women',
						'y' 			=> (int)$pregnant_cum,
					);

				}

				if(!is_null($lactating_cum)){

					$data['all'][] = array(
						'name' 			=> 'Lactating Women',
						'y' 			=> (int)$lactating_cum,
					);

				}

				if(!is_null($disabled)){

					$data['all'][] = array(
						'name' 			=> 'Disabled',
						'y' 			=> (int)$disabled,
					);

				}

				if(!is_null($solo_cum)){

					$data['all'][] = array(
						'name' 			=> 'Solo Parents',
						'y' 			=> (int)$solo_cum,
					);

				}

				if(!is_null($ip_cum)){

					$data['all'][] = array(
						'name' 			=> 'Indigenous Persons',
						'y' 			=> (int)$ip_cum,
					);

				}

				$query1 = $this->db->query("SELECT
												* 
											FROM
												(
												SELECT 
													SUM ( NULLIF ( infant_male_cum, '' ) :: INTEGER ) infant_male_cum,
													SUM ( NULLIF ( infant_female_cum, '' ) :: INTEGER ) infant_female_cum,
													SUM ( NULLIF ( toddler_male_cum, '' ) :: INTEGER ) toddler_male_cum,
													SUM ( NULLIF ( toddler_female_cum, '' ) :: INTEGER ) toddler_female_cum,
													SUM ( NULLIF ( preschooler_male_cum, '' ) :: INTEGER ) preschooler_male_cum, 
													SUM ( NULLIF ( preschooler_female_cum, '' ) :: INTEGER ) preschooler_female_cum,
													SUM ( NULLIF ( schoolage_male_cum, '' ) :: INTEGER ) schoolage_male_cum, 
													SUM ( NULLIF ( schoolage_female_cum, '' ) :: INTEGER ) schoolage_female_cum,
													SUM ( NULLIF ( teenage_male_cum, '' ) :: INTEGER ) teenage_male_cum, 
													SUM ( NULLIF ( teenage_female_cum, '' ) :: INTEGER ) teenage_female_cum,
													SUM ( NULLIF ( adult_male_cum, '' ) :: INTEGER ) adult_male_cum, 
													SUM ( NULLIF ( adult_female_cum, '' ) :: INTEGER ) adult_female_cum,
													SUM ( NULLIF ( senior_male_cum, '' ) :: INTEGER ) senior_male_cum, 
													SUM ( NULLIF ( senior_female_cum, '' ) :: INTEGER ) senior_female_cum,
													SUM ( NULLIF ( pregnant_cum, '' ) :: INTEGER ) pregnant_cum,
													SUM ( NULLIF ( lactating_cum, '' ) :: INTEGER ) lactating_cum,
													SUM ( NULLIF ( disable_male_cum, '' ) :: INTEGER ) disable_male_cum, 
													SUM ( NULLIF ( disable_female_cum, '' ) :: INTEGER ) disable_female_cum,
													SUM ( NULLIF ( solo_cum, '' ) :: INTEGER ) solo_cum,
													SUM ( NULLIF ( ip_cum, '' ) :: INTEGER ) ip_cum 
												FROM
													tbl_sex_gender_data t1 
												WHERE
												disaster_title_id = '$id'
												AND t1.province_id = '$provinceid'
												) t1"
				);

				$arr1 = $query1->result_array();

				$data['categories'] = array();
				$data['male'] = array();
				$data['female'] = array();
				$data['solo'] = array();
				$data['ip'] = array();
				
				$infant_male_cum 			= $arr1[0]['infant_male_cum'];
				$infant_female_cum 			= $arr1[0]['infant_female_cum'];
				$toddler_male_cum 			= $arr1[0]['toddler_male_cum'];
				$toddler_female_cum 		= $arr1[0]['toddler_female_cum'];
				$preschooler_male_cum 		= $arr1[0]['preschooler_male_cum'];
				$preschooler_female_cum 	= $arr1[0]['preschooler_female_cum'];
				$schoolage_male_cum 		= $arr1[0]['schoolage_male_cum'];
				$schoolage_female_cum 		= $arr1[0]['schoolage_female_cum'];
				$teenage_male_cum 			= $arr1[0]['teenage_male_cum'];
				$teenage_female_cum 		= $arr1[0]['teenage_female_cum'];
				$adult_male_cum 			= $arr1[0]['adult_male_cum'];
				$adult_female_cum 			= $arr1[0]['adult_female_cum'];
				$senior_male_cum 			= $arr1[0]['senior_male_cum'];
				$senior_female_cum 			= $arr1[0]['senior_female_cum'];
				$pregnant_cum 				= $arr1[0]['pregnant_cum'];
				$lactating_cum 				= $arr1[0]['lactating_cum'];
				$disable_male_cum 			= $arr1[0]['disable_male_cum'];
				$disable_female_cum 		= $arr1[0]['disable_female_cum'];
				$solo_cum 					= $arr1[0]['solo_cum'];
				$ip_cum 					= $arr1[0]['ip_cum'];

				if(!is_null($infant_male_cum) || !is_null($infant_female_cum)){
					array_push($data['categories'],"Infant"); 

					if(!is_null($infant_male_cum)){
						array_push($data['male'],(int)$infant_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($infant_female_cum)){
						array_push($data['female'],(int)$infant_female_cum); 
					}else{
						array_push($data['female'],0);
					}

					array_push($data['solo'],0);
					array_push($data['ip'],0); 

				}

				if(!is_null($toddler_male_cum) || !is_null($toddler_female_cum)){
					array_push($data['categories'],"Toddler"); 

					if(!is_null($toddler_male_cum)){
						array_push($data['male'],(int)$toddler_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($toddler_female_cum)){
						array_push($data['female'],(int)$toddler_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($preschooler_male_cum) || !is_null($preschooler_female_cum)){
					array_push($data['categories'],"Preschooler"); 

					if(!is_null($preschooler_male_cum)){
						array_push($data['male'],(int)$preschooler_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($preschooler_female_cum)){
						array_push($data['female'],(int)$preschooler_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($schoolage_male_cum) || !is_null($schoolage_female_cum)){
					array_push($data['categories'],"Schoolage"); 

					if(!is_null($schoolage_male_cum)){
						array_push($data['male'],(int)$schoolage_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($schoolage_female_cum)){
						array_push($data['female'],(int)$schoolage_female_cum); 
					}else{
						array_push($data['female'],0);
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($teenage_male_cum) || !is_null($teenage_female_cum)){
					array_push($data['categories'],"Teenage"); 

					if(!is_null($teenage_male_cum)){
						array_push($data['male'],(int)$teenage_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($teenage_female_cum)){
						array_push($data['female'],(int)$teenage_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($adult_male_cum) || !is_null($adult_female_cum)){
					array_push($data['categories'],"Adult");

					if(!is_null($adult_male_cum)){
						array_push($data['male'],(int)$adult_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($adult_female_cum)){
						array_push($data['female'],(int)$adult_female_cum); 
					}else{
						array_push($data['female'],0);
					}
					array_push($data['solo'],0); 
					array_push($data['ip'],0); 
				}

				if(!is_null($senior_male_cum) || !is_null($senior_female_cum)){
					array_push($data['categories'],"Senior Citizen"); 

					if(!is_null($senior_male_cum)){
						array_push($data['male'],(int)$senior_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($senior_female_cum)){
						array_push($data['female'],(int)$senior_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($pregnant_cum)){
					array_push($data['categories'],"Pregnant Women"); 

					array_push($data['male'],0);

					if(!is_null($pregnant_cum)){
						array_push($data['female'],(int)$pregnant_cum); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($lactating_cum)){
					array_push($data['categories'],"Lactating Women"); 

					array_push($data['male'],0);

					if(!is_null($lactating_cum)){
						array_push($data['female'],(int)$lactating_cum); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($disable_male_cum) || !is_null($disable_female_cum)){
					array_push($data['categories'],"Disabled"); 

					if(!is_null($disable_male_cum)){
						array_push($data['male'],(int)$disable_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($disable_female_cum)){
						array_push($data['female'],(int)$disable_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($solo_cum)){
					array_push($data['categories'],"Solo Parent"); 

					array_push($data['solo'],(int)$solo_cum); 
				}

				if(!is_null($ip_cum)){
					array_push($data['categories'],"Indigenous Persons"); 

						array_push($data['ip'],(int)$ip_cum); 
				}

				return $data;

			}else{

				$query_id = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$id'");

				$arr = $query_id->result_array();

				$dromic_id = $arr[0]["dromic_id"];

				$query = $this->db->query("SELECT
												* 
											FROM
												(
												SELECT 
													(SUM ( NULLIF ( infant_male_cum, '' ) :: INTEGER )) + (SUM ( NULLIF ( infant_female_cum, '' ) :: INTEGER )) infant,
													(SUM ( NULLIF ( toddler_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( toddler_female_cum, '' ) :: INTEGER )) toddler,
													(SUM ( NULLIF ( preschooler_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( preschooler_female_cum, '' ) :: INTEGER )) preschooler,
													(SUM ( NULLIF ( schoolage_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( schoolage_female_cum, '' ) :: INTEGER )) schoolage,
													(SUM ( NULLIF ( teenage_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( teenage_female_cum, '' ) :: INTEGER )) teenage,
													(SUM ( NULLIF ( adult_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( adult_female_cum, '' ) :: INTEGER )) adult,
													(SUM ( NULLIF ( senior_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( senior_female_cum, '' ) :: INTEGER )) senior,
													SUM ( NULLIF ( pregnant_cum, '' ) :: INTEGER ) pregnant_cum,
													SUM ( NULLIF ( lactating_cum, '' ) :: INTEGER ) lactating_cum,
													(SUM ( NULLIF ( disable_male_cum, '' ) :: INTEGER ) + SUM ( NULLIF ( disable_female_cum, '' ) :: INTEGER )) disabled,
													SUM ( NULLIF ( solo_cum, '' ) :: INTEGER ) solo_cum,
													SUM ( NULLIF ( ip_cum, '' ) :: INTEGER ) ip_cum 
												FROM
													tbl_sex_gender_data t1 
												WHERE
												disaster_title_id = '$id' 
												AND t1.municipality_id = '$municipality_id'
												) t1"
				);

				$arr = $query->result_array();

				$infant 		= $arr[0]['infant'];
				$toddler 		= $arr[0]['toddler'];
				$preschooler 	= $arr[0]['preschooler'];
				$schoolage 		= $arr[0]['schoolage'];
				$teenage 		= $arr[0]['teenage'];
				$adult 			= $arr[0]['adult'];
				$senior 		= $arr[0]['senior'];
				$pregnant_cum 	= $arr[0]['pregnant_cum'];
				$lactating_cum 	= $arr[0]['lactating_cum'];
				$disabled 		= $arr[0]['disabled'];
				$solo_cum 		= $arr[0]['solo_cum'];
				$ip_cum 		= $arr[0]['ip_cum'];

				if(!is_null($infant)){

					$data['all'][] = array(
						'name' 			=> 'Infant',
						'y' 			=> (int)$infant,
					);

				}

				if(!is_null($toddler)){

					$data['all'][] = array(
						'name' 			=> 'Toddler',
						'y' 			=> (int)$toddler,
					);

				}

				if(!is_null($preschooler)){

					$data['all'][] = array(
						'name' 			=> 'Preschooler',
						'y' 			=> (int)$preschooler,
					);

				}

				if(!is_null($schoolage)){

					$data['all'][] = array(
						'name' 			=> 'Schoolage',
						'y' 			=> (int)$schoolage,
					);

				}

				if(!is_null($teenage)){

					$data['all'][] = array(
						'name' 			=> 'Teenage',
						'y' 			=> (int)$teenage,
					);

				}

				if(!is_null($adult)){

					$data['all'][] = array(
						'name' 			=> 'Adult',
						'y' 			=> (int)$adult,
					);

				}

				if(!is_null($senior)){

					$data['all'][] = array(
						'name' 			=> 'Senior Citizen',
						'y' 			=> (int)$senior,
					);

				}

				if(!is_null($pregnant_cum)){

					$data['all'][] = array(
						'name' 			=> 'Pregnant Women',
						'y' 			=> (int)$pregnant_cum,
					);

				}

				if(!is_null($lactating_cum)){

					$data['all'][] = array(
						'name' 			=> 'Lactating Women',
						'y' 			=> (int)$lactating_cum,
					);

				}

				if(!is_null($disabled)){

					$data['all'][] = array(
						'name' 			=> 'Disabled',
						'y' 			=> (int)$disabled,
					);

				}

				if(!is_null($solo_cum)){

					$data['all'][] = array(
						'name' 			=> 'Solo Parents',
						'y' 			=> (int)$solo_cum,
					);

				}

				if(!is_null($ip_cum)){

					$data['all'][] = array(
						'name' 			=> 'Indigenous Persons',
						'y' 			=> (int)$ip_cum,
					);

				}

				$query1 = $this->db->query("SELECT
												* 
											FROM
												(
												SELECT 
													SUM ( NULLIF ( infant_male_cum, '' ) :: INTEGER ) infant_male_cum,
													SUM ( NULLIF ( infant_female_cum, '' ) :: INTEGER ) infant_female_cum,
													SUM ( NULLIF ( toddler_male_cum, '' ) :: INTEGER ) toddler_male_cum,
													SUM ( NULLIF ( toddler_female_cum, '' ) :: INTEGER ) toddler_female_cum,
													SUM ( NULLIF ( preschooler_male_cum, '' ) :: INTEGER ) preschooler_male_cum, 
													SUM ( NULLIF ( preschooler_female_cum, '' ) :: INTEGER ) preschooler_female_cum,
													SUM ( NULLIF ( schoolage_male_cum, '' ) :: INTEGER ) schoolage_male_cum, 
													SUM ( NULLIF ( schoolage_female_cum, '' ) :: INTEGER ) schoolage_female_cum,
													SUM ( NULLIF ( teenage_male_cum, '' ) :: INTEGER ) teenage_male_cum, 
													SUM ( NULLIF ( teenage_female_cum, '' ) :: INTEGER ) teenage_female_cum,
													SUM ( NULLIF ( adult_male_cum, '' ) :: INTEGER ) adult_male_cum, 
													SUM ( NULLIF ( adult_female_cum, '' ) :: INTEGER ) adult_female_cum,
													SUM ( NULLIF ( senior_male_cum, '' ) :: INTEGER ) senior_male_cum, 
													SUM ( NULLIF ( senior_female_cum, '' ) :: INTEGER ) senior_female_cum,
													SUM ( NULLIF ( pregnant_cum, '' ) :: INTEGER ) pregnant_cum,
													SUM ( NULLIF ( lactating_cum, '' ) :: INTEGER ) lactating_cum,
													SUM ( NULLIF ( disable_male_cum, '' ) :: INTEGER ) disable_male_cum, 
													SUM ( NULLIF ( disable_female_cum, '' ) :: INTEGER ) disable_female_cum,
													SUM ( NULLIF ( solo_cum, '' ) :: INTEGER ) solo_cum,
													SUM ( NULLIF ( ip_cum, '' ) :: INTEGER ) ip_cum 
												FROM
													tbl_sex_gender_data t1 
												WHERE
												disaster_title_id = '$id'
												AND t1.municipality_id = '$municipality_id'
												) t1"
				);

				$arr1 = $query1->result_array();

				$data['categories'] = array();
				$data['male'] = array();
				$data['female'] = array();
				$data['solo'] = array();
				$data['ip'] = array();
				
				$infant_male_cum 			= $arr1[0]['infant_male_cum'];
				$infant_female_cum 			= $arr1[0]['infant_female_cum'];
				$toddler_male_cum 			= $arr1[0]['toddler_male_cum'];
				$toddler_female_cum 		= $arr1[0]['toddler_female_cum'];
				$preschooler_male_cum 		= $arr1[0]['preschooler_male_cum'];
				$preschooler_female_cum 	= $arr1[0]['preschooler_female_cum'];
				$schoolage_male_cum 		= $arr1[0]['schoolage_male_cum'];
				$schoolage_female_cum 		= $arr1[0]['schoolage_female_cum'];
				$teenage_male_cum 			= $arr1[0]['teenage_male_cum'];
				$teenage_female_cum 		= $arr1[0]['teenage_female_cum'];
				$adult_male_cum 			= $arr1[0]['adult_male_cum'];
				$adult_female_cum 			= $arr1[0]['adult_female_cum'];
				$senior_male_cum 			= $arr1[0]['senior_male_cum'];
				$senior_female_cum 			= $arr1[0]['senior_female_cum'];
				$pregnant_cum 				= $arr1[0]['pregnant_cum'];
				$lactating_cum 				= $arr1[0]['lactating_cum'];
				$disable_male_cum 			= $arr1[0]['disable_male_cum'];
				$disable_female_cum 		= $arr1[0]['disable_female_cum'];
				$solo_cum 					= $arr1[0]['solo_cum'];
				$ip_cum 					= $arr1[0]['ip_cum'];

				if(!is_null($infant_male_cum) || !is_null($infant_female_cum)){
					array_push($data['categories'],"Infant"); 

					if(!is_null($infant_male_cum)){
						array_push($data['male'],(int)$infant_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($infant_female_cum)){
						array_push($data['female'],(int)$infant_female_cum); 
					}else{
						array_push($data['female'],0);
					}

					array_push($data['solo'],0);
					array_push($data['ip'],0); 

				}

				if(!is_null($toddler_male_cum) || !is_null($toddler_female_cum)){
					array_push($data['categories'],"Toddler"); 

					if(!is_null($toddler_male_cum)){
						array_push($data['male'],(int)$toddler_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($toddler_female_cum)){
						array_push($data['female'],(int)$toddler_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($preschooler_male_cum) || !is_null($preschooler_female_cum)){
					array_push($data['categories'],"Preschooler"); 

					if(!is_null($preschooler_male_cum)){
						array_push($data['male'],(int)$preschooler_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($preschooler_female_cum)){
						array_push($data['female'],(int)$preschooler_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($schoolage_male_cum) || !is_null($schoolage_female_cum)){
					array_push($data['categories'],"Schoolage"); 

					if(!is_null($schoolage_male_cum)){
						array_push($data['male'],(int)$schoolage_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($schoolage_female_cum)){
						array_push($data['female'],(int)$schoolage_female_cum); 
					}else{
						array_push($data['female'],0);
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($teenage_male_cum) || !is_null($teenage_female_cum)){
					array_push($data['categories'],"Teenage"); 

					if(!is_null($teenage_male_cum)){
						array_push($data['male'],(int)$teenage_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($teenage_female_cum)){
						array_push($data['female'],(int)$teenage_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($adult_male_cum) || !is_null($adult_female_cum)){
					array_push($data['categories'],"Adult");

					if(!is_null($adult_male_cum)){
						array_push($data['male'],(int)$adult_male_cum); 
					}else{
						array_push($data['male'],0); 
					}
					if(!is_null($adult_female_cum)){
						array_push($data['female'],(int)$adult_female_cum); 
					}else{
						array_push($data['female'],0);
					}
					array_push($data['solo'],0); 
					array_push($data['ip'],0); 
				}

				if(!is_null($senior_male_cum) || !is_null($senior_female_cum)){
					array_push($data['categories'],"Senior Citizen"); 

					if(!is_null($senior_male_cum)){
						array_push($data['male'],(int)$senior_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($senior_female_cum)){
						array_push($data['female'],(int)$senior_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($pregnant_cum)){
					array_push($data['categories'],"Pregnant Women"); 

					array_push($data['male'],0);

					if(!is_null($pregnant_cum)){
						array_push($data['female'],(int)$pregnant_cum); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($lactating_cum)){
					array_push($data['categories'],"Lactating Women"); 

					array_push($data['male'],0);

					if(!is_null($lactating_cum)){
						array_push($data['female'],(int)$lactating_cum); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($disable_male_cum) || !is_null($disable_female_cum)){
					array_push($data['categories'],"Disabled"); 

					if(!is_null($disable_male_cum)){
						array_push($data['male'],(int)$disable_male_cum); 
					}else{
						array_push($data['male'],0);
					}
					if(!is_null($disable_female_cum)){
						array_push($data['female'],(int)$disable_female_cum); 
					}else{
						array_push($data['female'],0); 
					}
					array_push($data['solo'],0);
					array_push($data['ip'],0); 
				}

				if(!is_null($solo_cum)){
					array_push($data['categories'],"Solo Parent"); 

					array_push($data['solo'],(int)$solo_cum); 
				}

				if(!is_null($ip_cum)){
					array_push($data['categories'],"Indigenous Persons"); 

						array_push($data['ip'],(int)$ip_cum); 
				}

				return $data;

			}

		}


		public function get_map($id){

			session_start();

			$regionid = $_SESSION['regionid'];
			$municipality_id = $_SESSION['municipality_id'];

			$user_level_access = $_SESSION['user_level_access'];

			if($user_level_access == 'national'){

				$query = $this->db->query("SELECT
												row_to_json (fc) AS features
											FROM
												(
													SELECT
														'FeatureCollection' AS TYPE,
														array_to_json (ARRAY_AGG(f)) AS features
													FROM
														(
															SELECT
																'Feature' AS TYPE,
																t1.mun_code AS ID,
																row_to_json (t2) properties,
																st_asgeojson (st_union(t1.geom)) :: json geometry
															FROM
																lib_municipality_boundaries t1
															LEFT JOIN (
																SELECT
																	t1.mun_code municipality_id,
																	t1.mun_name municipality_name,
																	t3.province_name,
																	COALESCE (t2.fam_cum, 0) density -- 	st_asgeojson (st_union(t1.geom)) :: json geometry
																FROM
																	lib_municipality_boundaries t1
																LEFT JOIN (
																	SELECT
																		t1.*
																	FROM
																		(
																			SELECT
																				t1.municipality_id,
																				SUM (t1.fam_cum) fam_cum
																			FROM
																				(
																					SELECT
																						t1.*
																					FROM
																						(
																							SELECT
																								t1.municipality_id,
																								SUM (t1.family_cum :: INTEGER) AS fam_cum
																							FROM
																								tbl_evacuation_stats t1
																							LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
																							WHERE
																								t1.disaster_title_id = '$id'
																							GROUP BY
																								t1.municipality_id
																						) t1
																					UNION
																						(
																							SELECT
																								t2.municipality_id,
																								SUM (t2.family_cum :: INTEGER) AS fam_cum
																							FROM
																								tbl_evac_outside_stats t2
																							LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
																							WHERE
																								t2.disaster_title_id = '$id'
																							GROUP BY
																								t2.municipality_id
																						)
																				) t1
																			GROUP BY
																				t1.municipality_id
																		) t1
																) t2 ON t1.mun_code = t2.municipality_id
																LEFT JOIN lib_provinces t3 ON t1.pro_code = t3. ID
																GROUP BY
																	t1.mun_code,
																	t1.mun_name,
																	t3.province_name,
																	t2.fam_cum
															) t2 ON t1.mun_code = t2.municipality_id
															GROUP BY
																t2.*, t1.mun_code
														) f
												) AS fc
											");

				$arr = array();

				$arr = $query->result_array();

				$str = "";

				$str = $arr[0]['features'];

				return json_decode($str);

			}else if($user_level_access == "region" || $user_level_access == "province"){

				$query = $this->db->query("SELECT
												row_to_json (fc) AS features
											FROM
												(
													SELECT
														'FeatureCollection' AS TYPE,
														array_to_json (ARRAY_AGG(f)) AS features
													FROM
														(
															SELECT
																'Feature' AS TYPE,
																t1.mun_code AS ID,
																row_to_json (t2) properties,
																st_asgeojson (st_union(t1.geom)) :: json geometry
															FROM
																lib_municipality_boundaries t1
															LEFT JOIN (
																SELECT
																	t1.mun_code municipality_id,
																	t1.mun_name municipality_name,
																	t3.province_name,
																	COALESCE (t2.fam_cum, 0) density -- 	st_asgeojson (st_union(t1.geom)) :: json geometry
																FROM
																	lib_municipality_boundaries t1
																LEFT JOIN (
																	SELECT
																		t1.*
																	FROM
																		(
																			SELECT
																				t1.municipality_id,
																				SUM (t1.fam_cum) fam_cum
																			FROM
																				(
																					SELECT
																						t1.*
																					FROM
																						(
																							SELECT
																								t1.municipality_id,
																								SUM (t1.family_cum :: INTEGER) AS fam_cum
																							FROM
																								tbl_evacuation_stats t1
																							LEFT JOIN lib_provinces t3 ON t1.provinceid = t3. ID
																							WHERE
																								t1.disaster_title_id = '$id'
																							GROUP BY
																								t1.municipality_id
																						) t1
																					UNION
																						(
																							SELECT
																								t2.municipality_id,
																								SUM (t2.family_cum :: INTEGER) AS fam_cum
																							FROM
																								tbl_evac_outside_stats t2
																							LEFT JOIN lib_provinces t3 ON t2.provinceid = t3. ID
																							WHERE
																								t2.disaster_title_id = '$id'
																							GROUP BY
																								t2.municipality_id
																						)
																				) t1
																			GROUP BY
																				t1.municipality_id
																		) t1
																) t2 ON t1.mun_code = t2.municipality_id
																LEFT JOIN lib_provinces t3 ON t1.pro_code = t3. ID
																GROUP BY
																	t1.mun_code,
																	t1.mun_name,
																	t3.province_name,
																	t2.fam_cum
															) t2 ON t1.mun_code = t2.municipality_id
															WHERE t1.reg_code = '$regionid'
															GROUP BY
																t2.*, t1.mun_code
														) f
												) AS fc
											");

				$arr = array();

				$arr = $query->result_array();

				$str = "";

				$str = $arr[0]['features'];

				return json_decode($str);

			}else if($user_level_access == "municipality"){

				$data = array();

				$query1 = $this->db->query("SELECT
												 regexp_split_to_table(regexp_replace( st_astext ( st_centroid ( st_union ( geom ))), '[^0-9. ]+', '', 'g' ), E'\\s+') coordinates
												FROM
													lib_municipality_boundaries t1 
												WHERE
													t1.mun_code = '$municipality_id'"
										);

				$data["coordinates"] = $query1->result_array();

				$query2 = $this->db->query("SELECT
												row_to_json ( t1 ) AS features 
											FROM
												(
												SELECT
													'FeatureCollection' AS TYPE,
													array_to_json (
													ARRAY_AGG ( t1 )) AS features 
												FROM
													(
													SELECT
														t1.TYPE,
														t1.ID,
														--row_to_json ( t1 ) AS properties,
														t1.geometry
													FROM
														( SELECT 'Feature' AS TYPE, t1.gid AS ID, st_asgeojson ( t1.geom ) :: json geometry FROM country t1 ) t1 
													) t1 
												) t1"
										);


				$arr1 = array();

				$arr1 = $query2->result_array();

				$str1 = "";

				$str1 = $arr1[0]['features'];

				$data["ph"] = json_decode($str1);

				$query = $this->db->query("SELECT
												row_to_json ( fc ) AS features 
												FROM
													(
													SELECT
														'FeatureCollection' AS TYPE,
														array_to_json (
														ARRAY_AGG ( f )) AS features 
													FROM
														(
														SELECT
															t1.TYPE,
															t1.ID,
															row_to_json ( t2 ) AS properties,
															t1.geometry 
														FROM
															(
															SELECT
																'Feature' AS TYPE,
																t1.bgy_code AS ID,
																st_asgeojson ( t1.geom ) :: json geometry 
															FROM
																tbl_barangay_boundaries t1 
															WHERE
																t1.mun_code = '$municipality_id' 
															) t1
															LEFT JOIN (
															SELECT
																t1.municipality_id,
																t1.municipality_name,
																t1.pro_name,
																t1.bgy_code,
																t1.brgy_name,
																COALESCE ( t2.fam_cum, 0 ) density 
															FROM
																(
																SELECT
																	t1.mun_code municipality_id,
																	t1.mun_name municipality_name,
																	t1.pro_name,
																	t1.bgy_code,
																	UPPER ( t1.bgy_name ) brgy_name 
																FROM
																	tbl_barangay_boundaries t1 
																WHERE
																	t1.mun_code = '$municipality_id' 
																) t1
																LEFT JOIN (
																SELECT
																	* 
																FROM
																	(
																	SELECT
																		t1.municipality_id,
																		t1.brgy_id,
																		SUM ( t1.fam_cum ) fam_cum 
																	FROM
																		(
																		SELECT
																			* 
																		FROM
																			(
																			SELECT
																				t2.municipality_id :: INTEGER,
																				t2.brgy_located_ec :: INTEGER brgy_id,
																				SUM ( t1.family_cum :: INTEGER ) fam_cum 
																			FROM
																				tbl_evacuation_stats t1
																				LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID 
																			WHERE
																				t1.disaster_title_id = '$id' 
																			GROUP BY
																				t2.municipality_id :: INTEGER,
																				t2.brgy_located_ec 
																			) t1 UNION
																			(
																			SELECT
																				t1.municipality_id,
																				t1.brgy_host :: INTEGER brgy_id,
																				SUM ( t1.family_cum :: INTEGER ) 
																			FROM
																				tbl_evac_outside_stats t1 
																			WHERE
																				t1.disaster_title_id = '$id' 
																			GROUP BY
																				t1.municipality_id,
																				t1.brgy_host 
																			)) t1 
																	GROUP BY
																		t1.municipality_id,
																		t1.brgy_id 
																	) t1 
																) t2 ON t1.bgy_code = t2.brgy_id 
															) t2 ON t1.ID = t2.bgy_code 
														) f 
													) fc"
				);

				$arr = array();

				$arr = $query->result_array();

				$str = "";

				$str = $arr[0]['features'];

				$data["features"] = json_decode($str);

				return $data;

			}
			
		}

		public function get_feature_info_brgy($id, $brgy_id){

			$query = $this->db->query("SELECT * FROM tbl_evacuation_stats WHERE disaster_title_id = '$id'");

			$arr = $query->result_array();

			$dromic_id = $arr[0]["dromic_ids"];

			$query1 = $this->db->query("SELECT * FROM tbl_evac_outside_stats WHERE disaster_title_id = '$id' and brgy_host = '$brgy_id'");

			$data["out"] = $query1->result_array();

			$query2 = $this->db->query("SELECT
											t2.ec_name,
											t1.family_cum,
											t1.person_cum,
											t2.brgy_located_ec
											FROM
												tbl_evacuation_stats t1
												LEFT JOIN tbl_activated_ec t2 ON t1.evacuation_name :: INTEGER = t2.ID
												WHERE t1.disaster_title_id = '$id'
												AND t2.brgy_located_ec = '$brgy_id'"
										);

			$data["inside"] = $query2->result_array();

			$query3 = $this->db->query("SELECT
												t1.*
											FROM
												tbl_damage_per_brgy t1 where t1.disaster_title_id = '$id'
												AND t1.brgy_id = '$brgy_id'"
										);

			$data["damages"] = $query3->result_array();

			return $data;

		}


		public function get_feature_info($id, $municipality_id){

			$arr 		= array();

			$query 		= $this->db->query("SELECT sum(t1.family_cum::integer) as fam_cum FROM tbl_evacuation_stats t1 WHERE t1.disaster_title_id = '$id' AND t1.municipality_id = '$municipality_id'");

			$arr['inside'] = $query->result_array();

			$query2 	= $this->db->query("SELECT sum(t1.family_cum::integer) as fam_cum FROM tbl_evac_outside_stats t1 WHERE t1.disaster_title_id = '$id' AND t1.municipality_id = '$municipality_id'");

			if($query2->num_rows() < 1){

				$arr['outside'][] = array(
					'fam_cum' 	 => 0
				);

			}else{

				$arr['outside'] = $query2->result_array();

			}

			$query3 	= $this->db->query("SELECT
												t1.totally_damaged,
												t1.partially_damaged,
												t1.dswd_asst
											FROM
												tbl_casualty_asst t1
											WHERE t1.disaster_title_id = '$id'
											AND t1.municipality_id = '$municipality_id'
										");

			if($query3->num_rows() < 1){

				$arr['dam_asst'][] = array(
					'totally_damaged' 	 => 0,
					'partially_damaged'  => 0,
					'dswd_asst' 		 => 0
				);

			}else{

				$arr['dam_asst'] = $query3->result_array();

			}

			return $arr;

		}


		public function get_mobile_user(){

			$query 	= $this->db->query("SELECT * FROM tbl_mobile_user_a t1 ORDER BY t1.id DESC");

			return $query->result_array();


		}

		public function activateuser($users){

			$data = array();

			for($i = 0 ; $i < count($users) ; $i++){

				$id = $users[$i]['id'];

				$data = array(
					'isactivated' => 't'
				);

				$query = $this->db->where('id', $id);
				$query = $this->db->update('tbl_mobile_user_a', $data);

			}
			

			return 1;

		}

		public function deactivateuser($users){

			$data = array();

			for($i = 0 ; $i < count($users) ; $i++){

				$id = $users[$i]['id'];

				$data = array(
					'isactivated' => 'f'
				);

				$query = $this->db->where('id', $id);
				$query = $this->db->update('tbl_mobile_user_a', $data);

			}
			

			return 1;

		}

		public function get_web_user(){

			$query 	= $this->db->query("SELECT
											t1.*,
											t2.issuperadmin,
											t2.agency
										FROM
											tbl_auth_user t1
										LEFT JOIN tbl_auth_user_profile t2 ON t1.username = t2.username
										-- WHERE t2.issuperadmin != 't'
										ORDER BY t1.id DESC
										");

			return $query->result_array();


		}

		public function deactivatewebuser($users){

			$data = array();

			for($i = 0 ; $i < count($users) ; $i++){

				$id = $users[$i]['id'];

				$data = array(
					'isactivated' 			=> 'f',
					'can_create_report' 	=> 'f',
					'isadmin' 				=> 'f'
				);

				$query = $this->db->where('id', $id);
				$query = $this->db->update('tbl_auth_user', $data);

				$query1 = $this->db->where('id', $id);
				$query1 = $this->db->get('tbl_auth_user');

				$arr = $query1->result_array();

				$username = $arr[0]['username'];

				$datas = array(
					'issuperadmin' 		=> 'f'
				);

				$query2 = $this->db->where('username', $username);
				$query2 = $this->db->update('tbl_auth_user_profile', $datas);

			}
			

			return 1;

		}

		public function activatewebuser($users,$isadminpriv,$iscancreatepriv,$isdswd,$access_level,$issuperadminpriv){

			$data = array();

			$isadmin = "f";
			$iscancreate = "f";

			$isdswds = ($isdswd == 'true' ? 't' : 'f');

			$issuperadminpriv = ($issuperadminpriv == 'true' ? 't' : 'f');

			if($isadminpriv == "true" && $iscancreatepriv == "true"){
				$isadmin = "t";
				$iscancreate = "t";
			}

			if($iscancreatepriv == "true" && $isadminpriv == "false"){
				$isadmin = "f";
				$iscancreate = "t";
			}

			if($iscancreatepriv == "false" && $isadminpriv == "false"){
				$isadmin = "f";
				$iscancreate = "f";
			}

			for($i = 0 ; $i < count($users) ; $i++){

				$id = $users[$i]['id'];

				$data = array(
					'isactivated' 			=> 't',
					'can_create_report' 	=>  $iscancreate,
					'isadmin' 				=> 	$isadmin
				);

				$query = $this->db->where('id', $id);
				$query = $this->db->update('tbl_auth_user', $data);

				$query1 = $this->db->where('id', $id);
				$query1 = $this->db->get('tbl_auth_user');

				$arr = $query1->result_array();

				$username = $arr[0]['username'];

				$datas = array(
					'isdswd' 			=> $isdswds,
					'user_level_access' => $access_level,
					'issuperadmin' 		=> $issuperadminpriv
				);

				$query2 = $this->db->where('username', $username);
				$query2 = $this->db->update('tbl_auth_user_profile', $datas);

			}
			

			return 1;

		}

		public function saveProfileData($data){

			$evac_id = $data['evac_id'];

			$province_id 		= $data['province_id']; 
			$municipality_id 	= $data['municipality_id']; 
			$disaster_title_id 	= $data['disaster_title_id']; 

			$dromic_id = "";

			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$disaster_title_id'");

			$arr = $query->result_array();

			$dromic_id = $arr[0]["dromic_id"];
 
			$query1 = $this->db->query("SELECT * FROM tbl_sex_gender_data WHERE evac_id = '$evac_id' AND province_id = '$province_id' AND municipality_id = '$municipality_id' AND disaster_title_id = '$disaster_title_id' AND dromic_id = '$dromic_id'");

			if($query1->num_rows() > 0){

				$dataup = array(
					'infant_male_cum' 		 	=> $data['infant_male_cum'], 
					'infant_male_now' 		 	=> $data['infant_male_now'], 
					'infant_female_cum' 		=> $data['infant_female_cum'], 
					'infant_female_now' 		=> $data['infant_female_now'], 
					'toddler_male_cum' 		 	=> $data['toddler_male_cum'], 
					'toddler_male_now' 		 	=> $data['toddler_male_now'], 
					'toddler_female_cum' 		=> $data['toddler_female_cum'], 
					'toddler_female_now' 		=> $data['toddler_female_now'], 
					'preschooler_male_cum' 	 	=> $data['preschooler_male_cum'], 
					'preschooler_male_now' 	 	=> $data['preschooler_male_now'], 
					'preschooler_female_cum' 	=> $data['preschooler_female_cum'], 
					'preschooler_female_now' 	=> $data['preschooler_female_now'], 
					'schoolage_male_cum' 		=> $data['schoolage_male_cum'], 
					'schoolage_male_now' 		=> $data['schoolage_male_now'], 
					'schoolage_female_cum' 	 	=> $data['schoolage_female_cum'], 
					'schoolage_female_now' 	 	=> $data['schoolage_female_now'], 
					'teenage_male_cum' 		 	=> $data['teenage_male_cum'], 
					'teenage_male_now' 		 	=> $data['teenage_male_now'], 
					'teenage_female_cum' 		=> $data['teenage_female_cum'], 
					'teenage_female_now' 		=> $data['teenage_female_now'], 
					'adult_male_cum' 			=> $data['adult_male_cum'], 
					'adult_male_now' 			=> $data['adult_male_now'], 
					'adult_female_cum' 		 	=> $data['adult_female_cum'], 
					'adult_female_now' 		 	=> $data['adult_female_now'], 
					'senior_male_cum' 		 	=> $data['senior_male_cum'], 
					'senior_male_now' 		 	=> $data['senior_male_now'], 
					'senior_female_cum' 		=> $data['senior_female_cum'], 
					'senior_female_now' 		=> $data['senior_female_now'], 
					'pregnant_cum' 			 	=> $data['pregnant_cum'], 
					'pregnant_now' 			 	=> $data['pregnant_now'], 
					'lactating_cum' 			=> $data['lactating_cum'], 
					'lactating_now' 			=> $data['lactating_now'], 
					'solo_cum' 		 			=> $data['solo_cum'], 
					'solo_now' 		 			=> $data['solo_now'], 
					'ip_cum' 		 			=> $data['ip_cum'], 
					'ip_now' 		 			=> $data['ip_now'], 
					'disable_male_cum' 			=> $data['disable_male_cum'], 
					'disable_male_now' 			=> $data['disable_male_now'], 
					'disable_female_cum' 		=> $data['disable_female_cum'], 
					'disable_female_now' 		=> $data['disable_female_now']
				);

				$this->db->trans_begin();

				$query3 = $this->db->where('province_id', (string) $province_id);
				$query3 = $this->db->where('municipality_id', (string) $municipality_id);
				$query3 = $this->db->where('disaster_title_id', (string) $disaster_title_id);
				$query3 = $this->db->where('dromic_id', (string) $dromic_id);
				$query3 = $this->db->where('evac_id', $evac_id);
				$query3 = $this->db->update('tbl_sex_gender_data', $dataup);

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    return 0;
				}
				else
				{
				    $this->db->trans_commit();
				    return 1;
				}

			}else{

				$datas = array(
					'province_id' 				=> $data['province_id'], 
					'municipality_id' 			=> $data['municipality_id'], 
					'disaster_title_id' 		=> $data['disaster_title_id'], 
					'dromic_id' 				=> $dromic_id, 
					'evac_id' 					=> $data['evac_id'], 
					'infant_male_cum' 		 	=> $data['infant_male_cum'], 
					'infant_male_now' 		 	=> $data['infant_male_now'], 
					'infant_female_cum' 		=> $data['infant_female_cum'], 
					'infant_female_now' 		=> $data['infant_female_now'], 
					'toddler_male_cum' 		 	=> $data['toddler_male_cum'], 
					'toddler_male_now' 		 	=> $data['toddler_male_now'], 
					'toddler_female_cum' 		=> $data['toddler_female_cum'], 
					'toddler_female_now' 		=> $data['toddler_female_now'], 
					'preschooler_male_cum' 	 	=> $data['preschooler_male_cum'], 
					'preschooler_male_now' 	 	=> $data['preschooler_male_now'], 
					'preschooler_female_cum' 	=> $data['preschooler_female_cum'], 
					'preschooler_female_now' 	=> $data['preschooler_female_now'], 
					'schoolage_male_cum' 		=> $data['schoolage_male_cum'], 
					'schoolage_male_now' 		=> $data['schoolage_male_now'], 
					'schoolage_female_cum' 	 	=> $data['schoolage_female_cum'], 
					'schoolage_female_now' 	 	=> $data['schoolage_female_now'], 
					'teenage_male_cum' 		 	=> $data['teenage_male_cum'], 
					'teenage_male_now' 		 	=> $data['teenage_male_now'], 
					'teenage_female_cum' 		=> $data['teenage_female_cum'], 
					'teenage_female_now' 		=> $data['teenage_female_now'], 
					'adult_male_cum' 			=> $data['adult_male_cum'], 
					'adult_male_now' 			=> $data['adult_male_now'], 
					'adult_female_cum' 		 	=> $data['adult_female_cum'], 
					'adult_female_now' 		 	=> $data['adult_female_now'], 
					'senior_male_cum' 		 	=> $data['senior_male_cum'], 
					'senior_male_now' 		 	=> $data['senior_male_now'], 
					'senior_female_cum' 		=> $data['senior_female_cum'], 
					'senior_female_now' 		=> $data['senior_female_now'], 
					'pregnant_cum' 			 	=> $data['pregnant_cum'], 
					'pregnant_now' 			 	=> $data['pregnant_now'], 
					'lactating_cum' 			=> $data['lactating_cum'], 
					'lactating_now' 			=> $data['lactating_now'], 
					'solo_cum' 		 			=> $data['solo_cum'], 
					'solo_now' 		 			=> $data['solo_now'], 
					'ip_cum' 		 			=> $data['ip_cum'], 
					'ip_now' 		 			=> $data['ip_now'], 
					'disable_male_cum' 			=> $data['disable_male_cum'], 
					'disable_male_now' 			=> $data['disable_male_now'], 
					'disable_female_cum' 		=> $data['disable_female_cum'], 
					'disable_female_now' 		=> $data['disable_female_now']
				);

				$this->db->trans_begin(); 

				$this->db->insert("tbl_sex_gender_data",$datas);

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    return 0;
				}
				else
				{
				    $this->db->trans_commit();
				    return 1;
				}
			}

		}

		public function saveFacilityData($data){

			$evac_id = $data['evac_id'];

			$province_id 		= $data['province_id']; 
			$municipality_id 	= $data['municipality_id']; 
			$disaster_title_id 	= $data['disaster_title_id']; 

			$dromic_id = "";

			$query = $this->db->query("SELECT * FROM tbl_disaster_title WHERE id = '$disaster_title_id'");

			$arr = $query->result_array();

			$dromic_id = $arr[0]["dromic_id"];
 
			$query1 = $this->db->query("SELECT * FROM tbl_ec_facilities WHERE evac_id = '$evac_id' AND province_id = '$province_id' AND municipality_id = '$municipality_id' AND disaster_title_id = '$disaster_title_id' AND dromic_id = '$dromic_id'");

			if($query1->num_rows() > 0){

				$dataup = array(
					'province_id' 				=> $data['province_id'],
					'municipality_id'			=> $data['municipality_id'],
					'disaster_title_id' 		=> $data['disaster_title_id'],
					'evac_id' 					=> $data['evac_id'],
					'bathing_cubicles_male' 	=> $data['bathing_cubicles_male'],
					'bathing_cubicles_female' 	=> $data['bathing_cubicles_female'],
					'compost_pit' 				=> $data['compost_pit'],
					'sealed'					=> $data['sealed'],
					'portalets_male' 			=> $data['portalets_male'],
					'portalets_female' 			=> $data['portalets_female'],
					'portalets_common' 			=> $data['portalets_common'],
					'bathing_cubicles_common' 	=> $data['bathing_cubicles_common'],
					'child_space' 				=> $data['child_space'],
					'women_space' 				=> $data['women_space'],
					'couple_room' 				=> $data['couple_room'],
					'prayer_room' 				=> $data['prayer_room'],
					'community_kitchen' 		=> $data['community_kitchen'],
					'wash' 						=> $data['wash'],
					'ramps' 					=> $data['ramps'],
					'help_desk' 				=> $data['help_desk'],
					'capacity' 					=> $data['capacity'],
					'no_of_rooms' 				=> $data['no_of_rooms']
				);

				$this->db->trans_begin();

				$query3 = $this->db->where('province_id', (string) $province_id);
				$query3 = $this->db->where('municipality_id', (string) $municipality_id);
				$query3 = $this->db->where('disaster_title_id', (string) $disaster_title_id);
				$query3 = $this->db->where('dromic_id', (string) $dromic_id);
				$query3 = $this->db->where('evac_id', $evac_id);
				$query3 = $this->db->update('tbl_ec_facilities', $dataup);

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    return 0;
				}
				else
				{
				    $this->db->trans_commit();
				    return 1;
				}

			}else{

				$datas = array(
					'province_id' 				=> $data['province_id'],
					'municipality_id'			=> $data['municipality_id'],
					'disaster_title_id' 		=> $data['disaster_title_id'],
					'evac_id' 					=> $data['evac_id'],
					'dromic_id' 				=> $dromic_id,
					'bathing_cubicles_male' 	=> $data['bathing_cubicles_male'],
					'bathing_cubicles_female' 	=> $data['bathing_cubicles_female'],
					'compost_pit' 				=> $data['compost_pit'],
					'sealed'					=> $data['sealed'],
					'portalets_male' 			=> $data['portalets_male'],
					'portalets_female' 			=> $data['portalets_female'],
					'portalets_common' 			=> $data['portalets_common'],
					'bathing_cubicles_common' 	=> $data['bathing_cubicles_common'],
					'child_space' 				=> $data['child_space'],
					'women_space' 				=> $data['women_space'],
					'couple_room' 				=> $data['couple_room'],
					'prayer_room' 				=> $data['prayer_room'],
					'community_kitchen' 		=> $data['community_kitchen'],
					'wash' 						=> $data['wash'],
					'ramps' 					=> $data['ramps'],
					'help_desk' 				=> $data['help_desk'],
					'capacity' 					=> $data['capacity'],
					'no_of_rooms' 				=> $data['no_of_rooms']
				);

				$this->db->trans_begin(); 

				$this->db->insert("tbl_ec_facilities",$datas);

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    return 0;
				}
				else
				{
				    $this->db->trans_commit();
				    return 1;
				}
			}

		}

		public function updatebrgy(){

			$id = "";
			$psgc = "";

			$query = $this->db->query("SELECT * FROM lib_municipality ORDER BY id");

			$arr = $query->result_array();

			for($i = 0 ; $i < count($arr) ; $i++){

				$id = $arr[$i]['id'];
				$psgc = $arr[$i]['provinceid'];

				$data = array(
					'provinceid' => $psgc
				);

				$query1 = $this->db->where('municipality_id',$id);
				$query1 = $this->db->update('lib_barangay',$data);

			}



		}


		// public function isavailabletoclose($ec_name){

		// 	$query = $this->db->query("SELECT * FROM tbl_evacuation_stats WHERE evacuation_name = '$ec_name' AND (family_now = '0' || person_now = '0')");

		// 	return $query->num_rows();

		// }

		public function get_spec_assistances($id){

			$query = $this->db->query("SELECT
											t1.*,
											to_char(t1.date_augmented, 'MM/DD/YYYY') augmented_date,
											t2.provinceid,
											t2.municipality_id,
											t2.family_served,
											t2.remarks,
											t3.province_name,
											t4.municipality_name
										FROM
											tbl_fnfi_assistance_list t1
										LEFT JOIN tbl_fnfi_assistance t2 ON t1.fnfi_assistance_id = t2.id
										LEFT JOIN lib_provinces t3 ON t2.provinceid = t3.id
										LEFT JOIN lib_municipality t4 on t2.municipality_id = t4.id
										WHERE t1.id = '$id'
									");

			$arr = $query->result_array();

			$data['rs'] = $query->result_array();

			$provinceid = $arr[0]['provinceid'];

			$query1 = $this->db->query("SELECT
											*
										FROM
											lib_municipality t1
										WHERE t1.provinceid = '$provinceid'
										ORDER BY
											t1.municipality_name ASC
									");

			$data['munis'] = $query1->result_array();

			return $data;

		}

		public function edit_spec_assistance($id, $data){

			$total = 0;

			$query_get = $this->db->where('id', $id);
			$query_get = $this->db->get('tbl_fnfi_assistance_list');

			$arr = $query_get->result_array();

			$fnfi_assistance_id = $arr[0]['fnfi_assistance_id'];

			$query_get1 = $this->db->where('id', $fnfi_assistance_id);
			$query_get1 = $this->db->get('tbl_fnfi_assistance');

			$arr1 = $query_get1->result_array();

			$municipality_id = $arr1[0]['municipality_id'];
			$disaster_title_id = $arr1[0]['disaster_title_id'];

			$this->db->trans_start();

			try{

				$query_up = $this->db->where('id',$id);
				$query_up = $this->db->update('tbl_fnfi_assistance_list',$data);


				$query_get2 = $this->db->where('fnfi_assistance_id', $fnfi_assistance_id);
				$query_get2 = $this->db->get('tbl_fnfi_assistance_list');

				$arr3 = $query_get2->result_array();

				for($j = 0 ; $j < count($arr3) ; $j++){

					$total += $arr3[$j]['cost'] * $arr3[$j]['quantity'];

				}

				$datas = array(
					'dswd_asst' => $total
				);

				$query_up1 = $this->db->where('disaster_title_id',$disaster_title_id);
				$query_up1 = $this->db->where('municipality_id',$municipality_id);
				$query_up1 = $this->db->update('tbl_casualty_asst',$datas);

				$this->db->trans_commit();

				return 1;

			}catch(Exception $e){

				$this->db->trans_rollback();

				return 0;

			}

		}

		public function deleteFNDS($id, $municipality_id){

			$this->db->trans_start();

			try{

				$this->db->where('disaster_title_id', $id);
				$this->db->where('municipality_id', $municipality_id);
				$this->db->delete('tbl_not_displaced_served');

				$this->db->trans_commit();
				return 1;

			}catch(Exception $e){

				$this->db->trans_rollback();
				return 0;

			}
		}

		public function saveasnewFNDS($id, $data){

			$municipality_id = $data["municipality_id"];

			$query = $this->db->query("SELECT * FROM tbl_not_displaced_served WHERE municipality_id = '$municipality_id' AND disaster_title_id = '$id'");

			$arr = $query->result_array();

			if(count($arr) > 0){

				$this->db->trans_start();

				$datas = array(
					'families_served_cum' 	=> $data['families_served_cum'],
					'persons_served_cum' 	=> $data['persons_served_cum'],
					'families_served_now' 	=> $data['families_served_now'],
					'persons_served_now' 	=> $data['persons_served_now']
				);

				try{

					$query_up1 = $this->db->where('disaster_title_id', $id);
					$query_up1 = $this->db->where('municipality_id', $municipality_id);
					$query_up1 = $this->db->update("tbl_not_displaced_served", $data);

					$this->db->trans_commit();

					return 1;

				}catch(Exception $e){

					$this->db->trans_rollback();

					return 0;

				}

			}else{

				$this->db->trans_start();

				try{

					$this->db->insert("tbl_not_displaced_served", $data);

					$this->db->trans_commit();

					return 1;

				}catch(Exception $e){

					$this->db->trans_rollback();

					return 0;

				}

			}

		}

		public function getFNDS($id, $municipality_id){

			$mun_id = $municipality_id;

			$query = $this->db->query("SELECT * FROM tbl_not_displaced_served WHERE municipality_id = '$mun_id' AND disaster_title_id = '$id'");

			$data["rs"] = $query->result_array();

			$provinceid = $data["rs"][0]["provinceid"];

			$query1 = $this->db->query("SELECT * FROM lib_municipality WHERE provinceid = '$provinceid'");

			$data["city"] = $query1->result_array();

			return $data;

		}

}