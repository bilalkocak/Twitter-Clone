<?php

    include ('header.php');

    $sorgu=$db->prepare('SELECT * from members WHERE uye_id=?');
    $uyebilgi=$sorgu->execute([
    $_COOKIE['id']
]);
    $uyebilgi=$sorgu->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="girisyapildi-sol">
        <div class="kart">
            <div class="kart-kapak">
                <a href="profil.php?id=<?php echo $uyebilgi['uye_id'] ?>"><img src="<?php echo $uyebilgi['uye_kapak'] ?>" class="kart-kapak-img"></a>
            </div>
            <div class="kapak-bilgi">
                <div class="kart-pp">
                    <a href="profil.php?id=<?php echo $uyebilgi['uye_id'] ?>"><img src="<?php echo $uyebilgi['uye_pp']; ?>" class="kart-pp-img"  ></a>
                </div>
                <div class="kart-kimlik">
                    <div class="kart-kimlik-isim">
                        <a href="profil.php?id=<?php echo $uyebilgi['uye_id'] ?>"><?php echo $uyebilgi['uye_adi'].' '.$uyebilgi['uye_soyadi']; ?></a>
                    </div>
                    <div class="kart-kimlik-kadi">
                        <a href="profil.php?id=<?php echo $uyebilgi['uye_id'] ?>"><?php echo '@'.$uyebilgi['uye_kadi']; ?></a>
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
        <?php if (isset($_POST['ara'])){
        $aranan="%".$_POST['aranan']."%";
        $sorgu=$db->prepare('SELECT * from members WHERE uye_adi LIKE ? OR  uye_soyadi LIKE ? OR uye_kadi LIKE ?');
        $sonuc=$sorgu->execute([
            $aranan,
            $aranan,
            $aranan
        ]);

        while ($sonuc=$sorgu->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="begenen">
                <div class="begenenpp">
                    <img src="<?php echo $sonuc[uye_pp] ?>" class="begenen-pp">
                </div>
                <div class="begenen-bilgi">
                    <div class="begenen-isim">
                        <a href="profil.php?id=<?php echo $sonuc[uye_id] ?>"><?php echo $sonuc[uye_adi]." ".$sonuc[uye_soyadi] ?></a>
                    </div>
                    <div class="begenen-kadi">
                        <a href="profil.php?id=<?php echo $sonuc[uye_id] ?>"><?php echo "@".$sonuc[uye_kadi] ?></a>
                    </div>
                </div>
            </div>


            <?php
        }}else{
            include 'tweetlistele.php';
        }
         ?>
    </div>
    <div class="girisyapildi-sag">
        <?php include "tweetat.php"; ?>
    </div>
</div>



</body>
</html>