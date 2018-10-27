<?php
/**
 * Common Model
 * @package Osiz Technologies Pvt Ltd
 * @subpackage Bit4Value
 * @category Models
 * @author Muthus
 * @version 1.0
 * @link http://osiztechnologies.com/
 * 
 */
 class Wallet_model extends CI_Model {
 	// Constructor 
 	function __construct()
	{
		parent::__construct();
	}
	/**
	 * INSERT data into table model
	 * 
	 * @access Public
	 * @param $tableName - Name of the table(required)
	 * @param $data - Specifies the insert data(required)
	 * @return Last insert ID
	 */
	public function insertTableData($tableName = '', $data = array())
	{
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
	/**
	 * DELETE data from table
	 * 
	 * @access Public
	 * @param $tableName - Name of the table(required)
	 * @param $where - Specifies the which row will be delete(optional)
	 * @return Affected rows
	 */
	public function deleteTableData($tableName = '', $where = array())
	{
		if ((is_array($where)) && (count($where) > 0)) {
			$this->db->where($where);
		}
		$this->db->delete($tableName);
		return $this->db->affected_rows();
	}
	/**
	 * UPDATE data to table
	 * 
	 * @access Public
	 * @param $tableName - Name of the table(required)
	 * @param $where - Specifies the where to update(optional)
	 * @param $data - Modified data(required) 
	 * @return Affected rows
	 */
	public function updateTableData($tableName = '', $where = array(), $data = array())
	{
		if ((is_array($where)) && (count($where) > 0)) {
			$this->db->where($where);
		}
		return $this->db->update($tableName, $data);
	}
	/**
	 * SELECT data from table
	 * 
	 * @access Public
	 * @param $tableName - Name of the table(required)
	 * @param $where - Specifies the where to update(optional)
	 * @param $data - Modified data(required) 
	 * @return Affected rows
	 */
	public function getTableData($tableName = '', $where = array(), $selectFields = '', $like = array(), $where_or = array(), $like_or = array(), $offset = '', $limit = '', $orderBy = array(), $groupBy = array())
	{
		// WHERE AND conditions
		if ((is_array($where)) && (count($where) > 0)) {
			$this->db->where($where);
		}
		// WHERE OR conditions
		if ((is_array($where_or)) && (count($where_or) > 0)) {
			$this->db->or_where($where_or);
		}
		//LIKE AND 
		if ((is_array($like)) && (count($like) > 0)) {
			$this->db->like($like);
		}
		//LIKE OR 
		if ((is_array($like_or)) && (count($like_or) > 0)) {
			$this->db->or_like($like_or);
		}
		//SELECT fields
		if ($selectFields != '') {
			$this->db->select($selectFields);
		}
		//Group By
		if (is_array($groupBy) && (count($groupBy) > 0)) {
			$this->db->group_by($groupBy[0]);
		}
		//Order By
		if (is_array($orderBy) && (count($orderBy) > 0)) {
			$this->db->order_by($orderBy[0], $orderBy[1]);
		}
		//OFFSET with LIMIT
		if($limit != '' && $offset != ''){
			$this->db->limit($limit, $offset);
		}
		// LIMIT
		if($limit != '' && $offset == ''){
			$this->db->limit($limit);
		}
		
		return $this->db->get($tableName);
	}  

	
	/**
	 * CUSTOM SQL query
	 * 
	 * @access Public
	 * @param SQL query
	 * @return Response  
	 */
	public function customQuery($query) {
		return $this->db->query($query);
	}
	
	//select records from joined tables
	public function getJoinedTableData($tableName = '', $joins = array(),  $where = array(),$groupBy = array(), $selectFields = '', $like = array(), $where_or = array(), $like_or = array(), $offset = '', $limit = '', $orderBy = array())
	{
		
		$this->db->from($tableName);		
		//join tables list
		if ((is_array($joins)) && (count($joins) > 0)) {
			foreach($joins as $jointb=>$joinON){
				$this->db->join($jointb, $joinON);
			}
		}
		
		// WHERE AND conditions
		if ((is_array($where)) && (count($where) > 0)) {
			$this->db->where($where);
		}
		// WHERE OR conditions
		if ((is_array($where_or)) && (count($where_or) > 0)) {
			$this->db->or_where($where_or);
		}
		//LIKE AND 
		if ((is_array($like)) && (count($like) > 0)) {
			$this->db->like($like);
		}
		//LIKE OR 
		if ((is_array($like_or)) && (count($like_or) > 0)) {
			$this->db->or_like($like_or);
		}
		//SELECT fields
		if ($selectFields != '') {
			$this->db->select($selectFields, false);
		}
		//Order By
		if (is_array($orderBy) && (count($orderBy) > 0)) {
			$this->db->order_by($orderBy[0], $orderBy[1]);
		}
		//OFFSET with LIMIT
		if($limit != '' && $offset != ''){
			$this->db->limit($limit, $offset);
		}
		// LIMIT
		if($limit != '' && $offset == ''){
			$this->db->limit($limit);
		}

		//Group By
		if (is_array($groupBy) && (count($groupBy) > 0)) {
			$this->db->group_by($groupBy[0]);
		}
		
		return $this->db->get();
		
	} 
	
	//select records from joined tables
	public function getleftJoinedTableData($tableName = '', $joins = array(),  $where = array(), $selectFields = '', $like = array(), $where_or = array(), $like_or = array(), $offset = '', $limit = '', $orderBy = array())
	{
		
		$this->db->from($tableName);		
		//join tables list
		if ((is_array($joins)) && (count($joins) > 0)) {
			foreach($joins as $jointb=>$joinON){
				$this->db->join($jointb, $joinON, 'LEFT');
			}
		}
		
		// WHERE AND conditions
		if ((is_array($where)) && (count($where) > 0)) {
			$this->db->where($where);
		}
		// WHERE OR conditions
		if ((is_array($where_or)) && (count($where_or) > 0)) {
			$this->db->or_where($where_or);
		}
		//LIKE AND 
		if ((is_array($like)) && (count($like) > 0)) {
			$this->db->like($like);
		}
		//LIKE OR 
		if ((is_array($like_or)) && (count($like_or) > 0)) {
			$this->db->or_like($like_or);
		}
		//SELECT fields
		if ($selectFields != '') {
			$this->db->select($selectFields);
		}
		//Order By
		if (is_array($orderBy) && (count($orderBy) > 0)) {
			$this->db->order_by($orderBy[0], $orderBy[1]);
		}
		//OFFSET with LIMIT
		if($limit != '' && $offset != ''){
			$this->db->limit($limit, $offset);
		}
		// LIMIT
		if($limit != '' && $offset == ''){
			$this->db->limit($limit);
		}
		
		return $this->db->get();
		
	} 
	
	
	
    function getuseremail($user_id)
    {
    	$userdata = $this->db->where('user_id', $user_id)->get(USERS)->row();
    	if ($userdata) {
		
		$first_field = insep_decode($userdata->first_field);
		$second_field = $userdata->second_field;
		$user_email = $first_field."@".$second_field;
		return $user_email;
	} else {
		return 'example';	
	}
    }
  
	
 }
 
/*
 * End of the file Wallet_model.php
 * Location: application/models/Wallet_model.php
 */
