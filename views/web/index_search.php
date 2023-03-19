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
    table {
        border-spacing: 5px;
        border-collapse: separate;
    }
    table td {
        width: max-content;
        background-color: ghostwhite;
    } 
</style>
<body>
    <?php
        $category_v = $_POST['category'];
        $search_v = $_POST['search'];    
    ?>
    
        <article id="board_area">
            <table cellpadding="1" cellspacing="0">
                <thead>
                    <tr>
                    <th scope="col">번호</th>
                    <th scope="col">제목</th>
                    <th scope="col">내용</th>
                    <th scope="col">이름</th>

                    <th scope="col">조회수</th>
                    </tr>
                </thead>
                <?php foreach($test as $search_show):?>
                    <tr>
                        <td><?php echo $search_show->num?></td>
                        <td><a rel="external" href="/index.php/web/view/<?php echo $search_show -> num; ?>"> <?php echo $search_show -> subject;?></a></td>                            
                        <td><?php echo $search_show->content?></td>
                        <td><?php echo $search_show->name?></td>

                        <td><?php echo $search_show->hits?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <br />
            <a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/">목록</a>
        </article>
    </div>
</body>
</html>
