<?php

    include ('header.php');

?>

<div class="container">
    <div class="girisyapildi-sol">
        <div class="kart">
            <div class="kart-kapak">
                <a href=""><img src="<?php echo $_COOKIE['uye_kapak'] ?>" class="kart-kapak-img"></a>
            </div>
            <div class="kapak-bilgi">
                <div class="kart-pp">
                    <a href=""><img src="<?php echo $_COOKIE['uye_pp']; ?>" class="kart-pp-img"  ></a>
                </div>
                <div class="kart-kimlik">
                    <div class="kart-kimlik-isim">
                        <a href=""><?php echo $_COOKIE['uye_adi'].' '.$_COOKIE['uye_soyadi']; ?></a>
                    </div>
                    <div class="kart-kimlik-kadi">
                        <a href=""><?php echo '@'.$_COOKIE['uye_kadi']; ?></a>
                    </div>
                </div>
            </div>
            <div class="kapak-bilgi-istatistik">
                <div class="tweetler">
                    <div><a href="">Tweetler</a></div>
                    <div><a href="" class="sayi"><?php tweetSayisiHesapla($db,$_COOKIE['id']); ?></a></div>
                </div>
                <div class="takipci">
                    <div><a href="">Takipciler</a></div>
                    <div><a href="" class="sayi"><?php takipciHesapla($db,$_COOKIE['id']); ?></a></div>
                </div>
                <div class="takipedilen">
                    <div><a href="">Takip Edilen</a></div>
                    <div><a href="" class="sayi">
                            <?php takipEdilenHesapla($db,$_COOKIE['id']); ?></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="girisyapildi-orta">
        <?php include 'tweetlistele.php'; ?>
    </div>
    <div class="girisyapildi-sag">
        <?php include "tweetat.php"; ?>
    </div>
</div>



</body>
</html>