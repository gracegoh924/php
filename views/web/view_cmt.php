<form action="/index.php/web/insert_cmt" method="post" enctype="multipart/form-data">
    <input value="<?php echo $views -> num;?>" name="bbs"/>
    <input type="text" name="name" placeholder="이름" />
    <input type="text" name="body" placeholder="댓글을 작성해주세요" />
    <input name="action2" type="submit" />
</form>


<?php
if (isset($sql)) {
    foreach($sql as $s) {
?>
    <tbody>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                <th scope="col">번호</th>
                <th scope="col">이름</th>
                <th scope="col">내용</th>
                </tr>
            </thead>
            <tr>
                <th scope="row"><?php echo $s -> idx;?></th>
                <td><?php echo $s -> name;?></td>
                <td><?php echo $s -> body;?></td>
            </tr>
        </table>
    </tbody>    
<?php
    }
}

?>