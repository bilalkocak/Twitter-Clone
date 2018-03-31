<?php
    include ('header.php');
    echo $_SESSION['uye_kadi']." kullanıcı adıyla giriş yapıldı";
?>

<a href="cikis.php">[ÇIKIŞ YAP]</a>
<div class="container">
    <div class="girisyapildi-sol">
        <div class="kart">
            <div class="kart-kapak">
                <a href=""><img src="<?php echo $_SESSION['uye_kapak'] ?>" class="kart-kapak-img"></a>
            </div>
            <div class="kapak-bilgi">
                <div class="kart-pp">
                    <a href=""><img src="<?php echo $_SESSION['uye_pp']; ?>" class="kart-pp-img"  ></a>
                </div>
                <div class="kart-kimlik">
                    <div class="kart-kimlik-isim">
                        <a href=""><?php echo $_SESSION['uye_adi'].' '.$_SESSION['uye_soyadi']; ?></a>
                    </div>
                    <div class="kart-kimlik-kadi">
                        <a href=""><?php echo '@'.$_SESSION['uye_kadi']; ?></a>
                    </div>
                </div>
            </div>
            <div class="kapak-bilgi-istatistik">
                <div class="tweetler">
                    <div><a href="">Tweetler</a></div>
                    <div><a href="" class="sayi">9999</a></div>
                </div>
                <div class="takipci">
                    <div><a href="">Takip Edilen</a></div>
                    <div><a href="" class="sayi">9999</a></div>
                </div>
                <div class="takipedilen">
                    <div><a href="">Takipciler</a></div>
                    <div><a href="" class="sayi">9999</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="girisyapildi-orta">
        Orta Bölüm
    </div>
    <div class="girisyapildi-sag">
        Sağ Bölüm
    </div>
</div>



</body>
</html>