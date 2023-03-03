<form action="insert" name="form_test" method="post" enctype="application/x-www-form-urlencoded">
  <input type="text" name="name" placeholder="이름" />
  <input type="text" name="subject" placeholder="제목" />
  <input type="text" name="content" placeholder="내용" />
  <input type="submit" />
</form>

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
    
        <tbody>
          * direct_list <br />  
          <?php
            foreach($direct_list as $dl){
          ?>
            <tr>
                <th scope="row"><?php echo $dl -> num;?></th>
                <td><a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/article/<?php echo $dl -> num; ?>"> <?php echo $dl -> subject;?></a></td>
                <td><?php echo $dl -> content;?></td>
                <td><?php echo $dl -> name;?></td>
                <td><?php echo $dl -> hits;?></td>
            </tr>
          <?php
            }     
          ?>
          <div>
              <form id="bd_search" method="post">
                  <input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" placeholder="검색어를 입력하세요" />
                  <input type="button" value="검색" id="search_btn" />
              </form>
          </div>
        </tbody>
    </table>
