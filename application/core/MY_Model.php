<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Model
 *
 * 
 */
class MY_Model extends CI_Model {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        
//        $this->db = $this->load->database( $this->session->userdata('portal') , TRUE); 
    }
    
    
    protected $table = "";
    protected $id = "";
    
    public function save($data, $where = array(), $unescape = array())
    {
        $dataValid = is_array($data) && count($data) > 0;
        $whereValid = count($where) > 0 && is_array($where);
        
        if( count( $where ) == 0 && $dataValid )
        {
            foreach ($data as $key => $value) {
                $this->db->set($key, $value, !in_array($key, $unescape));
            }
            
            $this->db->insert($this->mTable);
            
            return $this->db->insert_id();
        }
        else if( $whereValid && $dataValid )
        {
            foreach ($data as $key => $value) {
                $this->db->set($key, $value, !in_array($key, $unescape));
            }
            $this->db->where($where);
            $this->db->update($this->mTable);
            
            return $this->db->affected_rows();
        }
        
        return 0;
    }
    
    public function delete($id)
    {
        $this->db->where($this->id,$id);
        return $this->db->delete($this->table);
    }


    public function getAll( $where = array(), $fieldList = "" )
    {
        return $this->getAllWhere( $where, false, $fieldList );
    }
    
    /**
     * Get the first row that match the condition
     * @param array() $where for query
     * @return array
     */
    public function get($where, $fieldList = "")
    {
        return $this->getAllWhere( $where, true, $fieldList );
    }
    
    /**
     * Get all records that match the conditions
     * @param array $where query conditions
     * @param bool $row true if only one row is need
     * @return array
     */
    public function getAllWhere($where, $row = false, $fieldList = "")
    {
        if( !empty( $fieldList ) )
            $this->db->select($fieldList);
        
        if( count( $where ) > 0 )
            $this->db->where($where);
        
        $return = $this->db->get($this->mTable);
        
        if( $row )
            return $return->row_array();
        else
            return $return->result_array();
    }
    
    function selectAll($use_array = TRUE, $table = "") {
        if($table != ""){
            $this->table = $table;
        }
        if ($use_array) {
            $query = $this->db->get($this->table);
            return $query->result();
        } else {
            return $this->db->get($this->table);
        }
    }

    function select($id, $table = "") {
        if($table != ""){
            $this->table = $table;
        }
        
        $this->db->where($this->id, $id);
        $query = $this->db->get($this->table);
        return $query->row();
    } 

    function create($_array, $table = "") {
        if($table != ""){
            $this->table = $table;
        }
        $this->db->insert($this->table, $_array);
        return $this->db->insert_id();
    }
    
    function insert($_array, $table = ""){
        if($table != ""){
            $this->table = $table;
        }
        return $this->db->insert($this->table, $_array);
    }
    
    function update($id, $_array, $table = "", $nameIdColumn = "") {
        if($table != ""){
            $this->table = $table;
        }
        if($nameIdColumn != ""){
            $this->id = $nameIdColumn;
        }
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $_array);
    }
    
    function updateRow($id, $array, $table = ""){
        if($table != ""){
            $this->table = $table;
        }
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $array);
        return $this->db->affected_rows();
    }

//    function delete($id) {
//        $this->db->where($this->id, $id);
//        return $this->db->delete($this->table);
//    }
    
    function lastQuery(){
        return $this->db->last_query();
    }
    
    function selectColumns($columns, $returnList = TRUE){
        $select = "";
        if(is_array($columns)){
            $counter = count($columns);
            foreach ($columns as $column){
                if($counter > 1){
                    $select .= $column." ,";
                } else{
                    $select = $column;
                }
            }
            if($counter > 1){
                $select = substr_replace($select, "", -2);
            }
            
        } else{
            $select = $columns;
        }
        $this->db->select($select);
        $this->db->from($this->table);
        $result = $this->db->get();
        
        if($returnList){
            return $result->result();
        } else{
            return $result->row();
        }
    }
    
    function selectColumnsById($id, $columns, $returnList = TRUE){
        $select = "";
        if(is_array($columns)){
            $counter = count($columns);
            foreach ($columns as $column){
                if($counter > 1){
                    $select .= $column." ,";
                } else{
                    $select = $column;
                }
            }
            if($counter > 1){
                $select = substr_replace($select, "", -2);
            }
            
        } else{
            $select = $columns;
        }
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        $result = $this->db->get();
        if($returnList){
            return $result->result();
        } else{
            return $result->row();
        }
    }
    
    /**
     * Retorna un objeto en base a username que se le coloque
     * el segundo parametro identifica si pertenece a Mayacaptive o Radius
     * @param type text
     * @param type boolean
     * @return object
     */
    function selectByUsername($username, $isMayacaptive = TRUE){
        $column = "";
        if($isMayacaptive){
            $column = "vis_correo";
        } else{
            $column = "username";
        }
        $this->db->where($column, $username);
        $result = $this->db->get($this->table);
        return $result->row();
    }
    
}
