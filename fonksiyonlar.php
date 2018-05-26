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
    if ($_FILES['resim']['size']!=0){

        if ($_FILES["resim"]["size"]<1024*1024){//Dosya boyutu 1Mb tan az olsun

            if ($_FILES["resim"]["type"]=="image/jpeg"){  //dosya tipi jpeg olsun

                $dosya_adi   =    $_FILES["resim"]["name"];


                $uret=array("as","rt","ty","yu","fg");
                $uzanti=substr($dosya_adi,-5,5);
                $sayi_tut=rand(1,10000);

                $yeni_ad="uploadklasoru/".$uret[rand(0,4)].$sayi_tut.$uzanti;



                if (move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad)){



                    $sorgu = $db->prepare("INSERT INTO tweets SET uye_id=?,tweet_icerik=?,tweet_img=?");

                    $sorgu->execute([
                        $uye_id,
                        $tweet_icerik,
                        $yeni_ad,
                    ]);


                }
            }else{
                header("Location:girisyapildi.php?hata=jpeg");
            }
        }else{
            header("Location:girisyapildi.php?hata=boyut");
            echo 'Dosya boyutu 1 Mb ı geçemez!';
        }
    }
else{
    $sorgu=$db->prepare('insert into tweets set
        uye_id=?,
        tweet_icerik=?'
    );
    $ekle=$sorgu->execute([
        "$uye_id",
        "$tweet_icerik"
    ]);

}




    header("Location:girisyapildi.php");
}



//mention at
if(isset($_POST['mention_at'])){
    $tweet_icerik=$_POST['mention_icerik'];
    $uye_id=$_COOKIE['id'];
    $usttweet_id=$_POST['usttweet_id'];
    print_r($_FILES);
    if ($_FILES['mention-resim']['size']!=0){

        if ($_FILES["mention-resim"]["size"]<1024*1024){//Dosya boyutu 1Mb tan az olsun

            if ($_FILES["mention-resim"]["type"]=="image/jpeg"){  //dosya tipi jpeg olsun

                $dosya_adi   =    $_FILES["mention-resim"]["name"];


                $uret=array("as","rt","ty","yu","fg");
                $uzanti=substr($dosya_adi,-5,5);
                $sayi_tut=rand(1,10000);

                $yeni_ad="uploadklasoru/".$uret[rand(0,4)].$sayi_tut.$uzanti;



                if (move_uploaded_file($_FILES["mention-resim"]["tmp_name"],$yeni_ad)){



                    $sorgu = $db->prepare("INSERT INTO tweets SET uye_id=?,tweet_icerik=?,tweet_img=?,usttweet_id=?");

                    $sorgu->execute([
                        $uye_id,
                        $tweet_icerik,
                        $yeni_ad,
                        $usttweet_id
                    ]);


                }
            }else{
                header("Location:girisyapildi.php?hata=jpeg");
            }
        }else{
            header("Location:girisyapildi.php?hata=boyut");
            echo 'Dosya boyutu 1 Mb ı geçemez!';
        }
    }
    else {
        $sorgu = $db->prepare('insert into tweets set
        uye_id=?,
        tweet_icerik=?,
        usttweet_id=?'
        );
        $ekle = $sorgu->execute([
            $uye_id,
            $tweet_icerik,
            $usttweet_id
        ]);


    }
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
//profil düzenle

if (isset($_POST['profil-duzenle'])){

    $bilgiler = [
        'uye_adi' => $_POST['uye_adi'],
        'uye_soyadi' => $_POST['uye_soyadi'],
        'uye_kadi' => $_POST['uye_kadi'],
        'uye_mail' => $_POST['uye_mail'],
        'uye_sifre' => $_POST['uye_sifre'],
        'uye_bio' => $_POST['uye_bio'],
        'uye_website' => $_POST['uye_website'],
        'uye_konum' => $_POST['uye_konum'],
        'uye_id' => $_COOKIE['id'],
    ];

    $duzenlemesorgusu=$db->prepare('UPDATE `members`   
   SET `uye_adi` = :uye_adi,
       `uye_soyadi` = :uye_soyadi,
       `uye_kadi` = :uye_kadi,
       `uye_mail` = :uye_mail,
       `uye_sifre` = :uye_sifre,
       `uye_bio` = :uye_bio,
       `uye_website` = :uye_website,
       `uye_konum` = :uye_konum
 WHERE `uye_id` = :uye_id');
    $guncelle=$duzenlemesorgusu->execute($bilgiler);
    if ($guncelle){
        header('Location:profil.php');
    }else{
        echo "olmadı";
    }

}




?>