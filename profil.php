<?php

include ('header.php');
if (!isset($_GET['id'])){
    $_GET['id']=$_COOKIE['id'];
}

?>

<?php
$user_id = $_GET['id'];

/*if ($user_id == $_COOKIE['id']) {
        $kapak=$_COOKIE['uye_kapak'];
        $pp=$_COOKIE['uye_pp'];
        $kadi=$_COOKIE['uye_kadi'];
        $adi=$_COOKIE['uye_adi'];
        $soyadi=$_COOKIE['uye_soyadi'];
        $id=$_COOKIE['id'];
        $konum=$_COOKIE['konum'];
        $site=$_COOKIE['site'];
        $bio= $_COOKIE['bio'];


}else{*/
    $sorgu=$db->prepare("select * from members where uye_id=?");
    $sorgu->execute([
            $_GET['id']
    ]);
    $bilgiler=$sorgu->fetch(PDO::FETCH_ASSOC);
    $kapak=$bilgiler['uye_kapak'];
    $pp=$bilgiler['uye_pp'];
    $id=$user_id;
    $kadi=$bilgiler['uye_kadi'];
    $adi=$bilgiler['uye_adi'];
    $soyadi=$bilgiler['uye_soyadi'];
    $konum=$bilgiler['uye_konum'];
    $site=$bilgiler['uye_website'];
    $bio=$bilgiler['uye_bio'];



//}


?>
<div class="profilkart">
    <div class="profilkart-kapak">
        <a href=""><img src="<?php echo $kapak ?>" class="profilkart-kapak-img"></a>
    </div>
    <div class="profilkapak-bilgi">
        <div class="profilkart-pp">
            <a href=""><img src="<?php echo $pp; ?>" class="profilkart-pp-img"  ></a>
        </div>
    </div>
    <div class="profilkapak-bilgi-istatistik">
        <div class="profiltweetler">
            <div><a href="">Tweetler</a></div>
            <div><a href="" class="sayi"><?php tweetSayisiHesapla($db,$id)  ?></a></div>
        </div>
        <div class="profiltakipci">
            <div><a href="">Takipciler</a></div>
            <div><a href="" class="sayi"><?php takipciHesapla($db,$id); ?></a></div>
        </div>
        <div class="profiltakipedilen">
            <div><a href="">Takip Edilen</a></div>
            <div><a href="" class="sayi"><?php takipEdilenHesapla($db,$id); ?></a></div>
        </div>
        <div class="profilbegeni">
            <div><a href="">Beğeni</a></div>
            <div><a href="" class="sayi"><?php //takipEdilenHesapla($db,$id); ?>10</a></div>
        </div>
        <?php
        if ($_COOKIE['id']==$_GET['id']){
            ?>
            <div class="takip">
                <a href="profil.php?profil-duzenle=true">
                    <div class="takip-button">
                        Düzenle
                    </div>
                </a>
            </div>

            <?php
        }

        else{
            $takipsorgusu=$db->prepare('SELECT * FROM follows WHERE takipeden_id=? AND takipedilen_id=?');
            $takip=$takipsorgusu->execute([
               $_COOKIE['id'],
                $_GET['id']
            ]);
            if ($takip=$takipsorgusu->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="takip">
                    <a href="fonksiyonlar.php?takip-birak=<?php echo $_GET['id'] ?>">
                        <div class="takip-button">
                            Takip Etme
                        </div>
                    </a>
                </div>

                <?php

            }
            else {
                ?>
                <div class="takip">
                    <a href="fonksiyonlar.php?takip-et=<?php echo $_GET['id'] ?>">
                        <div class="takip-button">
                            Takip Et
                        </div>
                    </a>
                </div>

                <?php
            }
        }

        ?>

    </div>
</div>

<div class="container">
    <div class="profilgirisyapildi-sol">

        <div class="profilkart background">
            <div class="profilkapak-bilgi">
                <div class="profilkart-kimlik">
                    <div class="profilkart-kimlik-isim">
                        <a href=""><?php echo $adi.' '.$soyadi; ?></a>
                    </div>
                    <div class="profilkart-kimlik-kadi">
                        <a href=""><?php echo '@'.$kadi; ?></a>
                    </div>
                </div>

                <div class="biografi">
                    <?php echo  $bio; ?>
                </div>

                <div class="konum">
                    <?php echo  $konum; ?>
                </div>

                <div class="website">
                    <a href="http://<?php echo  $site; ?>"><?php echo  $site; ?></a>
                </div>

            </div>
        </div>
    </div>
    <div class="girisyapildi-orta">

        <?php
        if (isset($_GET['profil-duzenle'])){
            include 'profilduzenle.php';
        }else{
            include 'kenditweetlistele.php';
        }
        ?>
    </div>
    <div class="girisyapildi-sag">

    </div>
</div>



</body>
</html>