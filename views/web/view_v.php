<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <title>CodeIgniter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
           

            // const myList = document.getElementById('my-list')
            // const listItem = document.getElementsByClassName('list-item')

            // 댓글
            function handleSingleClick(e) {
                const singleItem = document.getElementById(e.id)
                singleItem.classList.toggle("mystyle")
            }

            function handleUpdate(e) {
                const singleItem = document.getElementById(e.id).previousSibling
                singleItem.style.visibility = "hidden"

                const updateInput = document.createElement("input")
                updateInput.setAttribute("id", "update-input")
                updateInput.value = singleItem.innerHTML

                singleItem.parentNode.insertBefore(updateInput, singleItem)

                const updateButton = document.getElementById(e.id)
                updateButton.setAttribute("onclick", "handleUpdateConfirm(this)")
            }

            function handleUpdateConfirm(e) {
                const updateInput = document.getElementById("update-input")

                
                const singleItem = document.getElementById(e.id).previousSibling
                singleItem.innerHTML = updateInput.value
                singleItem.style.visibility = "visible"

                const updateButton = document.getElementById(e.id)
                updateButton.setAttribute("onclick", "handleUpdate(this)")
                updateInput.remove()
            }


            // 딜리트
            function handleDelete(e) {
                const singleItem = document.getElementById(e.id).parentElement
                singleItem.remove()
            }
            
            
            function addItem() {
                console.log("addItem 실행")
                const nameInput = document.getElementById("name-input")
                const itemInput = document.getElementById("item-input")
                const content = itemInput.value
                const content_name = nameInput.value


                if (content_name) {
                    alert ("작성되었습니다.")
                    const myList = document.getElementById("my-list")
                    console.log(myList.getElementsByTagName("body").length)
                    let list_number = myList.getElementsByTagName("body").length + 1
                    const newList = document.createElement("body")
                    const newNum = document.createElement('span')
                    const newText = document.createElement('span')
                    const newName = document.createElement('span')
                    
                    newNum.innerText = list_number + " "
                    newName.innerText = content_name + " : "
                    newText.innerText = content
                    newText.setAttribute("onclick", "handleSingleClick(this)")
                    newText.setAttribute("id", `${list_number}th-item`)
                    newList.appendChild(newNum)
                    newList.appendChild(newName)
                    newList.appendChild(newText)

                    const updateButton = document.createElement('button')
                    updateButton.innerHTML = "수정"
                    updateButton.setAttribute("style", "margin: 5px;")
                    updateButton.setAttribute("onclick", "handleUpdate(this)")
                    updateButton.setAttribute("id", `${list_number}th-item-update-button`)
                    newList.appendChild(updateButton)

                    const deleteButton = document.createElement('button')
                    deleteButton.innerHTML = "삭제"
                    deleteButton.setAttribute("onclick", "handleDelete(this)")
                    deleteButton.setAttribute("id", `${list_number}th-item-delete-button`)
                    newList.appendChild(deleteButton)

                    myList.append(newList)

                    itemInput.value = ""
                    nameInput.value = ""

                } else {
                    alert ("내용을 입력해주세요.")
                }
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
                <div id="input-area" style="margin-top:30px">
                    <input type="text" placeholder="작성자" id="name-input" />
                    <input type="text" placeholder="댓글을 입력하세요" id="item-input" />
                    <button onclick="addItem()">등록</button>
                </div>      
                <ul id="my-list"></ul>
            </article>
        </div>
    </body>
</html>
