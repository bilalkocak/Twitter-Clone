<!DOCTYPE html>
<?php
include 'baglan.php';
include 'fonksiyonlar.php';
if ($_COOKIE['oturum']!='acik') {
    header("location:index.php");
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Twitter</title>
        <link rel="stylesheet" href="style/reset.css">
        <link rel="stylesheet" href="style/header.css">
        <link rel="stylesheet" href="style/girisyapildi.css">
        <link rel="stylesheet" href="style/profil.css">
        <link rel="stylesheet" href="style/tweet.css">
        <link rel="shortcut icon" href="images/twitter.png">
    </head>
    <body>
        <div class="header">
            <div class="header-icerik">
                <div class="header-sol">
                    <div class="header-sol-buton">
                        <a href="girisyapildi.php">Anasayfa</a>
                    </div>
                    <div class="header-sol-buton">
                        <a href="profil.php">Profil</a>
                    </div>
                </div>
                <div class="header-logo">
                    <a href=""><img src="images/twitter.png" class="logo"></a>
                </div>
                <div class="header-sag">
                    <form action="girisyapildi.php" class="form" method="post">
                        <input type="text" placeholder="Twitter'da Ara" class="header-ara" name="aranan">
                        <input type="submit" class="ara-buton" value="Ara" name="ara">
                    </form>
                    <div class="header-sag-menu">
                        <ul>
                            <li>
                                <img src="<?php echo $_COOKIE['uye_pp']; ?>" class="header-sag-menu-icon">
                                
                                <ul>
                                    <li><a href="profil.php?profil-duzenle=true">Profil Düzenle</a></li>
                                    <li><a href="">2. Seçenek</a></li>
                                    <li><a href="cikis.php">Çıkış Yap</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
