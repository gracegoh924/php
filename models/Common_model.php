<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
	
	function __construct(){
    	parent::__construct();
    }
	
	// 각종 이름 찾아주는
	public function rowfinder($table ='', $columns= '', $search=''){
		
		$sql = "select $columns from $table $search";
		$query = $this -> db -> query($sql);
		$row = $query -> row();
		return($row);
	}
	
	// 각종 리스트 뽑아주는
	
	public function make_list($table ='', $columns= '', $search = ''){
	
		$sql = "select $columns from $table $search";
		$query = $this -> db -> query($sql);
		$result = $query -> result();
		return($result);
	}
	
	
	
	// 각종 갯수 뽑아주는
	
	public function count_list($table ='', $columns= '', $search = ''){
	
		$sql = "select $columns from $table $search";
		$query = $this -> db -> query($sql);
		$count = $query -> num_rows();
		return($count);
		
	}
	
	public function addrow($table = '', $cols ='', $vals = ''){
		$sql = "insert into $table ($cols) values ($vals)";
		$query = $this -> db -> query($sql);
		return($query);
	}
	
	
	// 조회수 
	public function uphit($table = '', $cols ='', $num =''){
		
		$sql = "select $cols from $table where num = $num";
		$query = $this -> db -> query($sql);
		$row = $query -> row();
		$hit = $row -> hits;
		
		$new_hit = $hit + 1;
		
		$sql = "update $table set $cols = $new_hit where num = $num ";
		$query = $this -> db -> query($sql);
		return($query);
	}	

}
