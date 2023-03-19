<!-- 
    <form action="insert" name="form_test" method="post" enctype="application/x-www-form-urlencoded">
        <input type="text" name="name" placeholder="이름" />
        <input type="text" name="subject" placeholder="제목" />
        <input type="text" name="content" placeholder="글쓰기" />
        <input type="submit" />
    </form> -->




    <form style="background: whitesmoke; padding: 15px;" action="/index.php/web/uploadimage" id="contactForm" name="contact-form" method="post" enctype="multipart/form-data">
        Codeigniter로 파일첨부하기

        <input class="form-control" type="text" name="name" placeholder="이름" />
        <input class="form-control" type="text" name="subject" placeholder="제목" />
        <input class="form-control" type="file" name="thumb_image" id="image" />
        <textarea class="form-control" type="text" name="content" placeholder="글쓰기"></textarea>

        <input class="btn" type="submit" type="submit" value="Upload" />

    </form>

    


</body>
</html>

