<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this -> load -> database();
		$this -> load -> model('common_model');
		$this -> load -> helper(array('url', 'date', 'form'));
	}



	public function index(){


		// 직접 불러올 수도 있습니다.
		$sql = "select * from test order by num desc";
		// QUERY
		$query = $this -> db -> query($sql);
		// 결과
		$result = $query -> result();
		// VIEW 로 보내기
		$data['direct_list'] = $result;


		$this->load->view('web/index', $data);

	}


    // C
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

	
    // R
    function view() {

        // 데이터베이스에서 불러오기 (모델)
		$data['dl'] = $this -> common_model -> rowfinder("test","*","order by num desc limit 1");
        // 게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
        $data['views'] = $this -> common_model -> get_view($this -> uri -> segment(3), $this -> uri -> segment(4));
 
        // view 호출
        $this -> load -> view('web/view_v', $data);
    }


    // U
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        
        if ( $_POST ) {
            $modify_data = array(
                'table' => 'test',
                'num' => $this->uri->segment(3),
                'subject' => $this->input->post('subject', TRUE),
                'content' => $this->input->post('content', TRUE)
            );
            
            $result = $this->common_model->modify_board($modify_data);
            
            if ( $result ) {
                echo "<script>alert('수정 완료');</script>";
            }
        } else {
            $data['views'] = $this->common_model->get_view($this->uri->segment(3));
            
            $this->load->view('web/modify_v', $data);
        }
    }


    // D
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        // $this->load->helper('alert');
        
        $return = $this->common_model->delete_content($this->uri->segment(3));
        
        if ( $return ) {
            echo "<script>alert('삭제되었습니다.');</script>";
        } 
    }
 
    function url_explode($url, $key) {
        $cnt = count($url);
 
        for ($i = 0; $cnt > $i; $i++) {
            if ($url[$i] == $key) {
                $k = $i + 1;
                return $url[$k];
            }
        }
    }
 
 
    function segment_explode($seg) {

        // 세그먼트 앞 뒤 "/" 제거 후 uri를 배열로 반환
        $len = strlen($seg);
 
        if (substr($seg, 0, 1) == '/') {
            $seg = substr($seg, 1, $len);
        }
 
        $len = strlen($seg);
 
        if (substr($seg, -1) == '/') {
            $seg = substr($seg, 0, $len - 1);
        }
 
        $seg_exp = explode("/", $seg);
        return $seg_exp;
    }
}