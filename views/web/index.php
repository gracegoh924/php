<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <title>CodeIgniter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#search_btn").click(function() {
                    if ($("#q").val() == '') {
                        alert("검색어를 입력하세요!");
                        return false;
                    } else {
                        var act = "/index.php/web/index/test/q/" + $("#q").val() + "/page/1";
                        $("#bd_search").attr('action', act).submit();
                    }
                });
            });
 
            function board_search_enter(form) {
                var keycode = window.event.keyCode;
                if (keycode == 13)
                    $("#search_btn").click();
            }
       </script>
    </head>
    <body>
      * 글쓰기
      <form action="insert" name="form_test" method="post" enctype="application/x-www-form-urlencoded">
        <input type="text" name="name" placeholder="이름" />
        <input type="text" name="subject" placeholder="제목" />
        <input type="text" name="content" placeholder="글쓰기" />
        <input type="submit" />
      </form>
      <br />


      * 파일 첨부
      <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="myfile">
        <input type="submit" name="action" value="Upload">
      </form>
      <?php
        if(isset($_POST['action'])){
          $uploaded_file_name_tmp = $_FILES[ 'myfile' ][ 'tmp_name' ];
          $uploaded_file_name = $_FILES[ 'myfile' ][ 'name' ];
          $upload_folder = "uploads/";
          move_uploaded_file( $uploaded_file_name_tmp, $upload_folder . $uploaded_file_name );
          echo "<p>" . $uploaded_file_name . "을(를) 업로드하였습니다.</p>";
        }
      ?>


      <?php
        if(isset($_POST['action'])){
          print_r( $_FILES[ 'myfile' ] );
          echo "<br>";
          echo $_FILES[ 'myfile' ][ 'name' ];
          echo "<br>";
          echo $_FILES[ 'myfile' ][ 'type' ];
          echo "<br>";
          echo $_FILES[ 'myfile' ][ 'size' ];
          echo "<br>";
          echo $_FILES[ 'myfile' ][ 'tmp_name' ];
          echo "<br>";
          echo $_FILES[ 'myfile' ][ 'error' ];
        }
      ?>



      <article id="board_area">
        <table cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">번호</th>
              <th scope="col">제목</th>
              <th scope="col">내용</th>
              <th scope="col">이름</th>
              <th scope="col">조회수</th>
            </tr>
          </thead>
          <div>
            <form id="bd_search" method="post">
              <br />
              <input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" placeholder="검색하기" />
              <input type="button" value="검색" name="" id="search_btn" />
            </form>
          </div>
          <br />
          <tbody>
            1<?php echo $this -> uri -> segment(1); ?>
            2<?php echo $this -> uri -> segment(2); ?>
            3<?php echo $this -> uri -> segment(3); ?>
            4<?php echo $this -> uri -> segment(4); ?>
            5<?php echo $this -> uri -> segment(5); ?>
            6<?php echo $this -> uri -> segment(6); ?>
            7<?php echo $this -> uri -> segment(7); ?> </ br>
            * direct_list <br />
            <?php
              foreach($direct_list as $dl){
            ?>
              <tr>
                <th scope="row"><?php echo $dl -> num;?></th>
                <!-- segment(3)이 안 들어오는 문제 있음 -->
                
                <td><a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $dl -> num; ?>"> <?php echo $dl -> subject;?></a></td>
                            
                <td><?php echo $dl -> content;?></td>
                <td><?php echo $dl -> name;?></td>
                <td><?php echo $dl -> hits;?></td>
              </tr>
            <?php
              }     
            ?>
            <div style="background-color:gold">

            </div>

          </tbody>
          <tfoot>
              <tr>
                  <th colspan="5"><?php echo $pagination;?></th>
              </tr>
          </tfoot>

        </table>
        <br />

      </article>
    </body>
</html>
