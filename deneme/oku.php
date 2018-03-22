<?php
require_once('header.php');
?>

<?php 

    if(!isset($_GET['id'])||empty($_GET['id'])){
        header('Location:deneme.php');
        exit;
    }

    $sorgu=$db->prepare('select * from dersler where id=?');
    $sorgu->execute([
        $_GET['id']
    ]);

    $ders=$sorgu->fetch(PDO::FETCH_ASSOC);
    
?>

<h3><?php echo $ders['baslik'] ?> <?php echo $ders['tarih'] ?>  </h3> <hr>
<h5><?php echo $ders['icerik'] ?></h5>

