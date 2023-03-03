<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <title>CodeIgniter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </head>
    <body>
        <div id="main">

            <article id="board_area">

                <form class="form-horizontal" method="post" action="" id="write_action">
                    <fieldset>
                        <legend>게시물 수정</legend>
                        <div class="control-group">
                            <label class="control-label" for="input01">제목</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="input01" name="subject"
                                    value="<?php echo $views->subject; ?>" />
                            </div>
                            <label class="control-label" for="input02">내용</label>
                            <div class="controls">
                                <textarea class="input-xlarge" id="input02" name="content" rows="5">
                                    <?php echo $views->content;?>
                                </textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" id="write_btn"> 수정 </button>
                                <button class="btn" onclick="document.location.reload()">취소</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </article>

        </div>
    </body>
</html>