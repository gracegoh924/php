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
                        var act = "/index.php/web/index/test/q/" + $("#q").val();
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
        <div id="main">
            <article id="board_area">
                <table cellspacing="0" cellpadding="0" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">[번호] <?php echo $views -> num;?></th>
                        </tr>
                        <tr>
                            <th scope="col">[제목] <?php echo $views -> subject;?></th>
                        </tr>
                        <tr>
                            <th scope="col">[이름] <?php echo $views -> name;?></th>
                        </tr>
                        <tr>
                            <th scope="col">[조회수] <?php echo $views -> hits;?></th>
                        </tr>
                        <tr><th scope="col">-------------------------------------</th></tr>
                    </thead>
                    * list <br /><br />
                    <tbody>
                        <tr>
                            <th colspan="4">[내용] <?php echo $views -> content;?></th>
                        </tr>
                        <td>
                            <a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $views -> num; ?>"></a>
                        </td>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4"><br /><br />
                                <th colspan="4">
                                <a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/">목록</a>
                                <a href="/index.php/web/modify/<?php echo $this -> uri -> segment(3); ?>">수정</a>

                                <a href="/index.php/web/delete/<?php echo $this -> uri -> segment(3); ?>">삭제</a>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </article>
        </div>
    </body>
</html>
