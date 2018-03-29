<?php 
session_start();
include 'baglan.php';

/*$sorgu=$db->prepare('SELECT * FROM uye WHERE uye_kadi="deneme"');
$sorgu->execute();
$uyeler=$sorgu->fetch();

$uyeler['uye_kadi'];*/

if(!isset($_POST['submit'])){
    $uye_mail=$_POST['uye_mail'];
    $uye_sifre=$_POST['uye_sifre'];
    $sorgu=$db->prepare('SELECT * FROM uye WHERE uye_mail= ? ');
    $sorgu->execute([
        $uye_mail
    ]);
    $uyeler=$sorgu->fetch(PDO::FETCH_ASSOC);
    print_r($uyeler);
    if($uye_mail==$uyeler['uye_mail']&&$uye_sifre==$uyeler['uye_sifre']){
        $_SESSION['uye_kadi']=$uyeler['uye_kadi'];
        
        include('girisyapildi.php');
    }
}

?>