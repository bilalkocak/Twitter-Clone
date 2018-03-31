<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Twitter</title>
        <link rel="stylesheet" href="style/reset.css">
        <link rel="stylesheet" href="style/header.css">
        <link rel="stylesheet" href="style/girisyapildi.css">
        <link rel="shortcut icon" href="images/twitter.png">
    </head>
    <body>
        <div class="header">
            <div class="header-icerik">
                <div class="header-sol">
                    <div class="header-sol-buton">
                        <a href="">Anasayfa</a>
                    </div>
                    <div class="header-sol-buton">
                        <a href="">Profil</a>
                    </div>
                </div>
                <div class="header-logo">
                    <a href=""><img src="images/twitter.png" class="logo"></a>
                </div>
                <div class="header-sag">
                    <form action="" class="form">
                        <input type="text" placeholder="Twitter'da Ara" class="header-ara">
                        <input type="submit" class="ara-buton" value="Ara">
                    </form>
                    <div class="header-sag-menu">
                        <a href=""> <img src="<?php echo $_SESSION['uye_pp']; ?>" class="header-sag-menu-icon"> </a>
                    </div>
                </div>
            </div>
        </div>
