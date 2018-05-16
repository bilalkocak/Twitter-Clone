<?php
include 'baglan.php';
//takip edilen hesapla

function takipEdilenHesapla($db,$id){

    $sorgu= $db->prepare("Select count(takipedilen_id) from follows WHERE takipeden_id=?");
    $sorgu->execute([
        $id
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
//mention at
if(isset($_POST['mention_at'])){
    $tweet_icerik=$_POST['mention_icerik'];
    $uye_id=$_COOKIE['id'];
    $usttweet_id=$_POST['usttweet_id'];
    $sorgu=$db->prepare('insert into tweets set
        uye_id=?,
        tweet_icerik=?,
        usttweet_id=?'
    );
    $ekle=$sorgu->execute([
        "$uye_id",
        "$tweet_icerik",
        "$usttweet_id"
    ]);
    header("Location:tweetpage.php?tweet=".$usttweet_id);
}

//beğen
if (isset($_GET['like-id'])){
    $like_id=$_GET['like-id'];
    $uye_id=$_COOKIE['id'];
    $sorgu=$db->prepare('insert into likes set
        uye_id=?,
        tweet_id=?'
    );
    $ekle=$sorgu->execute([
        "$uye_id",
        "$like_id",
    ]);
    header("Location:tweetpage.php?tweet=".$like_id);
}

//beğeni sil

if (isset($_GET['like-sil-id'])){
    $like_id=$_GET['like-sil-id'];
    $uye_id=$_COOKIE['id'];
    $sorgu=$db->prepare('delete FROM likes where
        uye_id=? AND 
        tweet_id=?'
    );
    $ekle=$sorgu->execute([
        "$uye_id",
        "$like_id",
    ]);
    header("Location:tweetpage.php?tweet=".$like_id);
}

//beğeni sayısı hesapla
function begeniSayisiHesapla($db,$tweet_id){
    $sorgu= $db->prepare("Select count(tweet_id) from likes WHERE tweet_id=?");
    $sorgu->execute([
        $tweet_id
    ]);

    $sonuc=$sorgu->fetch(PDO::FETCH_ASSOC);

    echo $sonuc['count(tweet_id)'];
}

//takip bırak
if (isset($_GET['takip-birak'])){
    $sorgu=$db->prepare('DELETE FROM follows WHERE takipeden_id=? AND takipedilen_id=?');
    $sorgu->execute([
        $_COOKIE['id'],
        $_GET['takip-birak'],
    ]);
    header("Location:profil.php?id=".$_GET['takip-birak']);
}

//takip et

if (isset($_GET['takip-et'])){
    $sorgu=$db->prepare('INSERT INTO follows SET takipeden_id=?, takipedilen_id=?');
    $sorgu->execute([
        $_COOKIE['id'],
        $_GET['takip-et'],
    ]);
    header("Location:profil.php?id=".$_GET['takip-et']);
}



//yorum sayısı hesapla
function yorumSayisiHesapla($db,$tweet_id){
    $sorgu= $db->prepare("Select count(tweet_id) from tweets WHERE usttweet_id=?");
    $sorgu->execute([
        $tweet_id
    ]);

    $sonuc=$sorgu->fetch(PDO::FETCH_ASSOC);

    echo $sonuc['count(tweet_id)'];
}



?>