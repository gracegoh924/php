<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this -> load -> database();
		$this -> load -> model('common_model');
		$this -> load -> helper(array('url', 'date', 'form'));

        $this->load->view('inc/header_v');
    }


	public function index() {

        // $this -> output -> enable_profiler(TRUE);

        // 검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 5;
 
        // 주소 중에서 q(검색어) 세그먼트가 있는 지 검사하기 위해 주소를 배열로 반환
        $uri_array = $this -> segment_explode($this -> uri -> uri_string());
 
        if (in_array('q', $uri_array)) {
            // 주소에 검색어가 있을 경우 처리
            $search_word = urldecode($this -> url_explode($uri_array, 'q'));
 
            // 페이지네이션 용 주소
            $page_url = '/q/' . $search_word;
 
            $uri_segment = 7;
        }
 
        // 페이지네이션 라이브러리 로딩
        $this -> load -> library('pagination');
 
        // 페이지 네이션 설정
        $config['base_url'] = '/index.php/web/index/test/page';
        // 페이징 주소
        $config['total_rows'] = $this -> common_model -> get_list($this -> uri -> segment(3), 'count');
        // 게시물 전체 개수
        $config['per_page'] = 5;
        // 한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment;
        // 페이지 번호가 위치한 세그먼트
 
        // 페이지네이션 초기화
        $this -> pagination -> initialize($config);
        // 페이지 링크를 생성하여 view에서 사용하 변수에 할당
        $data['pagination'] = $this -> pagination -> create_links();
 
        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $page = $this -> uri -> segment($uri_segment, 1);
        $page_int = (int)$page;
 
        if ($page_int > 1) {
            $start = (($page_int / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page_int - 1) * $config['per_page'];
        }
 
        $limit = $config['per_page'];
 
        $data['direct_list'] = $this -> common_model -> get_list($this -> uri -> segment(3), '', $start, $limit, isset($search_query));

        $this -> load -> view('web/index', $data);
    }

	
    public function search_page() {

        $this->load->model('common_model');
        $search = $this->input->post('search');
        $data['test'] =  $this->common_model->search($search);
        $this->load->view('/web/index_search', $data);
    }


    // C
	// function insert() {
	// 	$name = $_POST['name'];
    //     $subject = $_POST['subject'];
    //     $content = $_POST['content'];

	// 	// SQL
	// 	$sql = "insert into test (name, subject, content) values ('$name', '$subject', '$content')";

	// 	// QUERY
	// 	$this -> db -> query($sql);

    //     echo "
	// 		<script>
	// 			alert('글이 등록되었습니다');
	// 			location.href='/index.php/web';
	// 		</script>
	// 	";

	// }

	
    // R
    function view() {

        // 데이터베이스에서 불러오기 (모델)
		// $data['dl'] = $this -> common_model -> rowfinder("test","*","order by num desc limit 1");
 
        // 게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
        $data['views'] = $this -> common_model -> get_view($this -> uri -> segment(3), $this -> uri -> segment(4));
 
        // view 호출
        $this -> load -> view('web/view_v', $data);
    }


    // U
    public function modify() {
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
                echo "
                <script>
                alert('수정 완료');
                location.href='/index.php/web';
                </script>
                ";
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
 

    // HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꿔 리턴한다.
    // @param String 대상이 되는 문자열
    // @return string[]
 
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


    function insert_cmt(){
        print_r($_POST);


        $name = $_POST['name'];
        $body = $_POST['body'];
        $bbs = $_POST['bbs'];

        $sql = "insert into `test_comment` (bbs, name, body) values ('$bbs', '$name', '$body')";
        echo $sql;

        // QUERY
		$this -> db -> query($sql);

        
    
    }


    // function insert2() {
	// 	$name = $_POST['name'];
    //     $subject = $_POST['subject'];
    //     $content = $_POST['content'];

	// 	// SQL
	// 	$sql = "insert into test (name, subject, content) values ('$name', '$subject', '$content')";

	// 	// QUERY
	// 	$this -> db -> query($sql);

    //     echo "
	// 		<script>
	// 			alert('글이 등록되었습니다');
	// 			location.href='/index.php/web';
	// 		</script>
	// 	";

    // 	}


        public function uploadimage() {

            // 글
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            $content = $_POST['content'];
    
            // 이미지
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            // $config['max_size'] = 100;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('thumb_image')) {

                $uploadData = $this->upload->data();
                // print_r($uploadData); die;
                $images1='http://localhost/'.'uploads/'.$uploadData['file_name'];

                $data = array('thumb_image'=>$images1);
                $this->load->model('common_model');


                // $this->imagemodel->addimage($data);
                if ($this->common_model->addimage($data)) {
                    // $this->session->set_flashdata('feedback', 'Image added');

                    echo "
                        <script>
                            alert('이미지가 등록되었습니다.');
                        </script>
                    ";
                    

                } else {
                    // $this->session->set_flashdata('feedback', 'Image not added');
                    echo "Image not added";
                }

                // print_r($images1);
                // print_r($uploadData);
                echo "<br />";


                $src = $data['thumb_image'];

                echo "
                <div style='display:flex; flex-direction:column;'>
                    <div class='container' style='display:flex; flex-direction:row; margin:20px; gap:50px;'>
                        <div class='foto'>
                            <img src=". $src ." height='400'>
                        </div>
                        <div class='article'>";
                echo $src;
                echo "<br /><br />";
                echo "이름 : ".$name;
                echo "<br />";
                echo "제목 : ".$subject;
                echo "<br />";
                echo "내용 : ".$content;
                echo "
                        </div>
                    </div>
                    <div></div>
                </div>
                ";



                

                               // SQL
                $sql = "insert into test (name, subject, content, thumb_image) values ('$name', '$subject', '$content', '$src')";
    
                // QUERY
                $this -> db -> query($sql);
                // print_r($sql);


                // $this->load->view('imageupload_v');
                // $this -> load-> view('')

            // save this img to DB / create DB and table
            } else {
                echo "오류";
                print_r($sql);

            }

        

        
  
    }
}