<?php
include('baglan.php');

//form gönderilmiş mi
if(!isset($_POST['submit'])){
    $uye_mail=$_POST['uye_mail'];
    $uye_adi=$_POST['uye_adi'];
    $uye_soyadi=$_POST['uye_soyadi'];
    $uye_kadi=$_POST['uye_kadi'];
    if($_POST['uye_sifre']==$_POST['uye_sifret']){
        $uye_sifre=$_POST['uye_sifre'];
        //Kayıt ekleme işlemi
        $sorgu=$db->prepare('insert into members set
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
        //Kayıt olan üyenin id sini öğrenme işlemi
        $idSorgu=$db->prepare('select * from members where uye_kadi=?');
        $isSorguexe=$idSorgu->execute([
            "$uye_kadi"
        ]);
        $uye_id=$idSorgu->fetch(PDO::FETCH_ASSOC);
        $uye_id[uye_id];

        //Uyenin kendisini takip ettirme işlemi
        $sorgu2=$db->prepare('insert into follows set
        takipeden_id=?,
        takipedilen_id=?
        ');
        $ekle2=$sorgu2->execute([
            "$uye_id[uye_id]",
            "$uye_id[uye_id]"
        ]);
    }
    if($ekle){//ekleme gerçekleştiyse
        header('Location:girisyapildi.php');
    }else{
        echo $uye_mail;
        echo $uye_kadi;
    }
    
}

?>