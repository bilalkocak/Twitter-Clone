<?php
include('baglan.php');

print_r($_POST);
//form gönderilmiş mi
if(!isset($_POST['submit'])){
    $uye_mail=$_POST['uye_mail'];
    $uye_adi=$_POST['uye_adi'];
    $uye_soyadi=$_POST['uye_soyadi'];
    $uye_kadi=$_POST['uye_kadi'];
    if($_POST['uye_sifre']==$_POST['uye_sifret']){
        $uye_sifre=$_POST['uye_sifre'];
    }

   
  
    $sorgu=$db->prepare('insert into uye set
    uye_mail=?,
    uye_adi=?,
    uye_soyadi=?,
    uye_kadi=?,
    uye_sifre=?');
    $ekle=$sorgu->execute([
        "$uye_mail",
        "$uye_adi",
        "$uye_soyadi",
        "$uye_kadi",
        "$uye_sifre"
    ]);

    if($ekle){//ekleme gerçekleştiyse
        header('Location:kayitoldu.php');
    }else{
        echo $uye_mail;
        echo $uye_kadi;
    }
    
}

?>