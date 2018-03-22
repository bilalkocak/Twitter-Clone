
<?php 
require_once('header.php');
include('baglan.php');
?>

<h3>Ders Listesi</h3>
<?php 


$dersler=$db->query('SELECT * FROM  dersler')->fetchAll();

?>

<ul>
    <?php foreach($dersler as $ders): ?>
        <li>
            <?php echo $ders['baslik'];  ?>
            <a href="deneme.php?sayfa=oku&id=<?php echo $ders['id'] ?>">[OKU]</a>
            <a href="">[DÜZENLE]</a>
            <a href="">[SİL]</a>
        </li>
    <?php endforeach; ?>
</ul>
