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
<style>
    .btn {
        background-color: lightcyan;
        border: none;

    }
    input {
        margin: 10px 0px;
    }
    .row {
        margin: 30px;
    }

</style>
<body>
    <div class="row" style="display:flex; flex-direction:column; gap:30px;">
        <?php $this->load->view('web/imageupload_v'); ?>
    


        <form style="background:whitesmoke; padding:15px;" action="" method="POST" enctype="multipart/form-data">
            php로 파일첨부하기
            <input class="form-control" type="file" name="myfile">
            <input class="btn" type="submit" name="action" value="Upload">
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
    </form>

    </div>



    <div class="row" id="board_area">
        
        <div style="background-color: whitesmoke; padding: 10px;">
            <form action="/index.php/web/search_page" method="post">
                <select name="category">
                    <option value="subject">제목</option>
                    <option value="content">내용</option>
                    <option value="name">이름</option>
                </select>
                <input type="text" name="search" class="" placeholder="검색">
                <input type="submit" class="btn" value="search" name="save"/>
            </form>
        </div>
            <?php
            if (isset($direct_list)) {
                $result_reverse = array_reverse($direct_list);
            }
            ?>

<tbody>
    
            * direct_list
            <form action="" method="post">
                <select name="order">
                    <option value="latest">최신순</option>
                    <option value="reverse">오래된순</option>
                </select>
                <button type="submit" class="btn">정렬</button></p>
        </form>


        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                <th scope="col">번호</th>
                <th scope="col" style="width:200px">제목</th>
                <th scope="col" style="width:200px">내용</th>
                <th scope="col">이름</th>
                <th scope="col">조회</th>
                </tr>
            </thead>
        

            <?php 
            if (@$_POST['order'] == "reverse"){
                foreach($result_reverse as $rr){
            ?>
                <tr>
                    <th scope="row"><?php echo $rr -> num;?></th>
                    <!-- segment(3)이 안 들어오는 문제 있음 -->
                    <td><a rel="external" onclick="clickMe()" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $rr -> num; ?>"> <?php echo $rr -> subject;?></a></td>                            
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
    </div>

</body>
</html>
