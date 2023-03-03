* list <br /><br />

<?php
    foreach($list as $lt){
        print_r($lt);
        echo "<br />";
    }
?>

<br /><br /><br />
<a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/index/">목록</a>
