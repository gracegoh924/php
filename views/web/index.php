<form action="/web/insert" name="form_test" method="post" enctype="application/x-www-form-urlencoded">
  <input type="text" name="name" />
  <input type="submit" />
</form>

* direct_list <br />
<?php
  foreach($direct_list as $dl){
    print_r($dl);
  }
?>

<br /><br />

* list <br />

<?php
  print_r($list);
?>
