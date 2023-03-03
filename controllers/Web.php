<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('common_model');
		$this -> load -> helper(array('url', 'date', 'form'));
	}



	public function index(){


		// 직접 불러올 수도 있습니다.
		$sql = "select * from test order by num desc limit 20";
		// QUERY
		$query = $this -> db -> query($sql);
		// 결과
		$result = $query -> result();
		// VIEW 로 보내기
		$data['direct_list'] = $result;


		$this->load->view('web/index', $data);

	}

    public function view(){

		// 데이터베이스에서 불러오기 (모델)
		$data['list'] = $this -> common_model -> rowfinder("test","*","order by num desc limit 1");

		$this->load->view('web/view_v', $data);
    }
    
	function insert(){
		$name = $_POST['name'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];

		// SQL
		$sql = "insert into test (name, subject, content) values ('$name', '$subject', '$content')";

		// QUERY
		$this -> db -> query($sql);

		// 원래 페이지로 이동
		echo "
			<script>
				alert('저장 완료');
				location.href='index';
			</script>
		";

	}


}
