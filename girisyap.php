<?php 

    include 'baglan.php';


    if(!isset($_POST['submit'])){

        $uye_mail=$_POST['uye_mail'];
        $uye_sifre=$_POST['uye_sifre'];
        $sorgu=$db->prepare('SELECT * FROM members WHERE uye_mail= ? ');
        $sorgu->execute([
            $uye_mail
        ]);
        $oturum='acik';
        $uyeler=$sorgu->fetch(PDO::FETCH_ASSOC);
        if($uye_mail==$uyeler['uye_mail'] && $uye_sifre==$uyeler['uye_sifre']){
            setcookie('id',$uyeler['uye_id'],time()+86400);
            setcookie('uye_kadi',$uyeler['uye_kadi'],time()+86400);
            setcookie('uye_adi',$uyeler['uye_adi'],time()+86400);
            setcookie('uye_soyadi',$uyeler['uye_soyadi'],time()+86400);
            setcookie('uye_pp',$uyeler['uye_pp'],time()+86400);
            setcookie('uye_kapak',$uyeler['uye_kapak'],time()+86400);
            setcookie('oturum',$oturum,time()+86400);
            header("Location:girisyapildi.php");
        }else{
            header('Location:index.php?hata=sifre');
        }
    }

?>