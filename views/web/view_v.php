
            <div class="row" id="row">
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
                                    <a href="/index.php/web">목록</a>
                                    <a href="/index.php/web/modify/<?php echo $this -> uri -> segment(3); ?>">수정</a>
                                    <a href="/index.php/web/delete/<?php echo $this -> uri -> segment(3); ?>">삭제</a>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <?php 
                        $this->load->view('web/view_cmt');
                    ?>
                </article>
            </div>
            <div class="row"></div>
        </div>
    </body>
</html>
