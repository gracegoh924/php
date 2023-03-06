* 글쓰기
<form action="insert" name="form_test" method="post" enctype="application/x-www-form-urlencoded">
  <input type="text" name="name" placeholder="이름" />
  <input type="text" name="subject" placeholder="제목" />
  <input type="text" name="content" placeholder="글쓰기" />
  <input type="submit" />
</form>


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
        <input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" placeholder="검색하기" />
        <input type="button" value="검색" id="search_btn" />
      </form>
    </div>
    <br />
    <tbody>
      * direct_list <br />
      <?php
        foreach($direct_list as $dl){
      ?>
        <tr>
          <th scope="row"><?php echo $dl -> num;?></th>
          <td><a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $dl -> num; ?>"> <?php echo $dl -> subject;?></a></td>
          <td><?php echo $dl -> content;?></td>
          <td><?php echo $dl -> name;?></td>
          <td><?php echo $dl -> hits;?></td>
        </tr>
      <?php
        }     
      ?>
    </tbody>

  </table>
  <br />

</article>
