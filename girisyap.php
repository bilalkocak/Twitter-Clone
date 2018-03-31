<?php 
    session_start();
    include 'baglan.php';

    if(!isset($_POST['submit'])){
        $uye_mail=$_POST['uye_mail'];
        $uye_sifre=$_POST['uye_sifre'];
        $sorgu=$db->prepare('SELECT * FROM uye WHERE uye_mail= ? ');
        $sorgu->execute([
            $uye_mail
        ]);
        $uyeler=$sorgu->fetch(PDO::FETCH_ASSOC);

        
        if($uye_mail==$uyeler['uye_mail']&&$uye_sifre==$uyeler['uye_sifre']){
            $_SESSION['uye_kadi']=$uyeler['uye_kadi'];
            $_SESSION['uye_mail']=$uyeler['uye_mail'];
            $_SESSION['uye_sifre']=$uyeler['uye_sifre'];
            $_SESSION['uye_adi']=$uyeler['uye_adi'];
            $_SESSION['uye_soyadi']=$uyeler['uye_soyadi'];
            $_SESSION['uye_pp']=$uyeler['uye_pp'];
            $_SESSION['uye_kapak']=$uyeler['uye_kapak'];
            
            
            include('girisyapildi.php');
        }else{
            header('Location:http://localhost/Twitter/index.php?hata=sifre');
        }
    }

?>