<a href="index.php?sayfa=insert">[İçerik Ekle]</a>

<?php 

include('baglan.php');

$dersler=$db->query('select * from dersler')->fetchAll();
print_r($dersler);


?>