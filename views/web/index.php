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
                        rowfinder()

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
          <br />

          <div style="background-color: lavender; padding: 10px;">
           

            <form action="search_page" method="post">
              <select name="category">
                <option value="subject">제목</option>
                <option value="content">내용</option>
                <option value="name">이름</option>
              </select>
              <input type="text" name="search" class="form-control" placeholder="Search">
              <input type="submit" value="search" name="save"/>
            </form>
          </div>
          <br />
          <?php

            echo "* 최신순 리스트";

            echo "<br />" ;
            print_r($direct_list);

            echo "<br /><br />";

            echo "* 역순(오래된순) 리스트";
            echo "<br />" ;
            $result_reverse = array_reverse ( $direct_list );
            print_r($result_reverse);

            ?>
          <br /><br />
          <tbody>
            * direct_list
            <form action="" method="post">
              <select name="order">
                <option value="latest">최신순</option>
                <option value="reverse">오래된순</option>
              </select>
              <button type="submit">정렬</button></p>
            </form>

            <?php 
              if ($_POST['order'] == "reverse"){
                foreach($result_reverse as $rr){
            ?>
                  <tr>
                    <th scope="row"><?php echo $rr -> num;?></th>
                    <!-- segment(3)이 안 들어오는 문제 있음 -->
                    <td><a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $rr -> num; ?>"> <?php echo $rr -> subject;?></a></td>                            
                    <td><?php echo $rr -> content;?></td>
                    <td><?php echo $rr -> name;?></td>
                    <td><?php echo $rr -> hits;?></td>
                  </tr>
            <?php
                }
              } else {
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
            }
            ?>
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
