<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
	
	function __construct(){
    	parent::__construct();
    }

	

	public function addimage($data) {
	
		$affected_rows = $this -> db -> insert ('images', $data);
		return $affected_rows;
	}



	public function search($search)
	{
		$this->db->select('*');
		$this->db->from('test');
		$this->db->like('num',$search);

		if ($_POST['category'] == 'name'){
			$this->db->or_like('name',$search);
		}
		if ($_POST['category'] == 'subject'){
			$this->db->or_like('subject',$search);
		}
		if ($_POST['category'] == 'content'){
			$this->db->or_like('content',$search);

		}
		$query = $this->db->get();
		return $query->result();
	}


	// 각종 이름 찾아주는
	public function rowfinder($table ='test', $columns= '', $search=''){
		
		// $columns = $_GET['category'];
        // $search = $_GET['search'];
		
		$sql = "select $columns from $table $search";
		$query = $this -> db -> query($sql);
		$row = $query -> row();
		return($row);
	}

	
	// 각종 리스트 뽑아주는
	public function make_list($table ='test', $columns= '', $search = ''){
	
		$sql = "select $columns from $table $search";
		$query = $this -> db -> query($sql);
		$result = $query -> result();
		return($result);
	}

	
	// 각종 갯수 뽑아주는
	public function count_list($table ='test', $columns= '', $search = ''){
	
		$sql = "select $columns from $table $search";
		$query = $this -> db -> query($sql);
		$count = $query -> num_rows();
		return($count);
	}
	

	public function addrow($table = 'test', $cols ='', $vals = ''){
		$sql = "insert into $table ($cols) values ($vals)";
		$query = $this -> db -> query($sql);
		return($query);
	}
	
	
	// 조회수 
	public function uphit($table = 'test', $cols ='', $num =''){
		
		$sql = "select $cols from $table where num = $num";
		$query = $this -> db -> query($sql);
		$row = $query -> row();
		$hit = $row -> hits;
		
		$new_hit = $hit + 1;
		
		$sql = "update $table set $cols = $new_hit where num = $num ";
		$query = $this -> db -> query($sql);
		return($query);
	}	


	function get_list($table = '', $type = '', $offset = '', $limit = '', $search_query='') {
		$limit_query = '';
	   
		if ($limit != '' OR $offset != '') {
		    // 페이징이 있을 경우 처리
		    $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
		}
	   
		$sql = "SELECT * FROM " . 'test' . $search_query." ORDER BY " . 'num' . " DESC " . $limit_query;
        $query = $this -> db -> query($sql);
	   
		if ($type == 'count') {
		    $result = $query -> num_rows();
		} else {
		    $result = $query -> result();
		}
	   
		return $result;
	}


    function get_view($id) {
        // 조횟수 증가
        $sql0 = "UPDATE " . 'test' . " SET hits = hits + 1 WHERE num='" . $id . "'";
        $this -> db -> query($sql0);
 
        $sql = "SELECT * FROM " . 'test' . " WHERE num = '" . $id . "'";
        $query = $this -> db -> query($sql);
 
        // 게시물 내용 반환
        $result = $query -> row();
 
        return $result;
    }


	function get_msg($table='test') {
        
        // 전체조회 sql
        $sql = "select * from $table order by num desc";
        
        // sql 구문을 통한 query 실행
        $query = $this->db->query($sql);
        
        // query 실행 결과를 result 변수에 담아서 return 합니다. 
        $result = $query->result();
        return $result;
    }


    function modify_board($arrays) {
        $modify_array = array(
            'subject' => $arrays['subject'],
            'content' => $arrays['content']
        );
        
        $where = array(
            'num' => $arrays['num']
        );
        
        $result = $this->db->update('test', $modify_array, $where);
        
        return $result;
    }

	
    function delete_content($no) {
        $delete_array = array(
            'num' => $no
        );
        
        $result = $this->db->delete('test', $delete_array);
        
        return $result;
    }

}
