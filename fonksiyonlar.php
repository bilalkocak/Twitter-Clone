<?php
include 'baglan.php';
//takip edilen hesapla

function takipEdilenHesapla($db,$id){

    $sorgu= $db->prepare("Select count(takipedilen_id) from follows WHERE takipeden_id=?");
    $sorgu->execute([
        $_COOKIE['id']
    ]);

    $sonuc=$sorgu->fetch(PDO::FETCH_ASSOC);

    echo $sonuc['count(takipedilen_id)']-1;
}

//takipci hesapla

function takipciHesapla($db,$id){
    $sorgu= $db->prepare("Select count(takipeden_id) from follows WHERE takipedilen_id=?");
    $sorgu->execute([
        $id
    ]);

    $sonuc=$sorgu->fetch(PDO::FETCH_ASSOC);

    echo $sonuc['count(takipeden_id)']-1;
}
//tweet sayisi hesapla
function tweetSayisiHesapla($db,$id){
    $sorgu= $db->prepare("Select count(uye_id) from tweets WHERE uye_id=?");
    $sorgu->execute([
        $id
    ]);

    $sonuc=$sorgu->fetch(PDO::FETCH_ASSOC);

    echo $sonuc['count(uye_id)'];
}


//tweet at

if(isset($_POST['tweet_at'])){
    $tweet_icerik=$_POST['tweet_icerik'];
    $uye_id=$_COOKIE['id'];
    $sorgu=$db->prepare('insert into tweets set
        uye_id=?,
        tweet_icerik=?'
       );
    $ekle=$sorgu->execute([
          "$uye_id",
          "$tweet_icerik"
      ]);
    header("Location:girisyapildi.php");
}

//takipedilenleri listele



?>