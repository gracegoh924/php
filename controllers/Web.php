<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('common_model');
		$this -> load -> helper(array('url', 'date', 'form'));
	}



	public function index(){

		// 데이터베이스에서 불러오기 (모델)
		$data['list'] = $this -> common_model -> rowfinder("test_table","*","order by num desc limit 1");

		// 직접 불러올 수도 있습니다.
		$sql = "select * from test_table order by num desc limit 4";
		// QUERY
		$query = $this -> db -> query($sql);
		// 결과
		$result = $query -> result();
		// VIEW 로 보내기
		$data['direct_list'] = $result;


		$this->load->view('web/index', $data);

	}

	function insert(){
		$name = $_POST['name'];

		// SQL
		$sql = "insert into test_table (name) values ('$name')";

		// QUERY
		$this -> db -> query($sql);

		// 원래 페이지로 이동
		echo "
			<script>
				alert('저장완료');
				location.href='/web/index';
			</script>
		";

	}


}
