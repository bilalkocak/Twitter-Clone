<?php //sonradan gelen
include 'header.php';
$query=$db->prepare("select * from tweets WHERE tweet_id=?");
$query->execute([
    $_GET['tweet']
]);

$usttweet=$query->fetch(PDO::FETCH_ASSOC);

$alttweetquery=$db->prepare('select * from tweets where usttweet_id=?');
$alttweetquery->execute([
    $_GET['tweet']
]);
$ustuyequery=$db->prepare('select * from members where uye_id=?');

$ustuyequery->execute([
    $usttweet[uye_id]
]);
    $ustuyebilgi=$ustuyequery->fetch(PDO::FETCH_ASSOC);
    $kapak=$ustuyebilgi['uye_kapak'];
    $pp=$ustuyebilgi['uye_pp'];
    $kadi=$ustuyebilgi['uye_kadi'];
    $adi=$ustuyebilgi['uye_adi'];
    $soyadi=$ustuyebilgi['uye_soyadi'];
    $id=$ustuyebilgi['uye_id'];



    ?>

<div class="container">
    <div class="girisyapildi-sol">
        <div class="kart">
            <div class="kart-kapak">
                <a href=""><img src="<?php echo $kapak ?>" class="kart-kapak-img"></a>
            </div>
            <div class="kapak-bilgi">
                <div class="kart-pp">
                    <a href=""><img src="<?php echo $pp; ?>" class="kart-pp-img"  ></a>
                </div>
                <div class="kart-kimlik">
                    <div class="kart-kimlik-isim">
                        <a href=""><?php echo $adi.' '.$soyadi; ?></a>
                    </div>
                    <div class="kart-kimlik-kadi">
                        <a href=""><?php echo '@'.$kadi; ?></a>
                    </div>
                </div>
            </div>
            <div class="kapak-bilgi-istatistik">
                <div class="tweetler">
                    <div><a href="">Tweetler</a></div>
                    <div><a href="" class="sayi"><?php tweetSayisiHesapla($db,$id)  ?></a></div>
                </div>
                <div class="takipci">
                    <div><a href="">Takipciler</a></div>
                    <div><a href="" class="sayi"><?php takipciHesapla($db,$id); ?></a></div>
                </div>
                <div class="takipedilen">
                    <div><a href="">Takip Edilen</a></div>
                    <div><a href="" class="sayi"><?php takipEdilenHesapla($db,$id); ?></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="girisyapildi-orta">
        <div class="tweet">
            <div class="tweet-ust">
                <div class="pp">
                    <a href=""><img src="<?php echo $ustuyebilgi[uye_pp] ?>" class="pp-img"></a>
                </div>
                <div class="bilgi">
                    <div class="adi">
                        <a href="profil.php?id=<?php echo $ustuyebilgi['uye_id'] ?>">
                            <?php echo  $ustuyebilgi[uye_adi]." ".$ustuyebilgi[uye_soyadi];  ?>
                        </a>
                    </div>
                    <div class="kadi">
                        <a href="profil.php?id=<?php echo $uye_bilgiler['uye_id']; ?>">
                            <?php echo "@".$ustuyebilgi[uye_kadi];  ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="tweet-orta">
                <div class="icerik">
                    <div class="icerik-metin">
                        <?php echo $usttweet[tweet_icerik];   ?>
                    </div>
                    <div class="icerik-foto">
                        <img src="<?php echo $usttweet['tweet_img']  ?>" style="max-width: 530px;max-height: 300px;border-radius: 20px">
                    </div>

                </div>
            </div>
            <div class="tarih">
                <?php echo $usttweet[tweet_tarih];   ?>
            </div>
            <div class="tweet-alt">
                <div class="yorum">
                    <a href="tweetpage.php?tweet=<?php echo $usttweet[tweet_id]; ?>"><img src="images/like/yorum.svg" width="13px"> <?php yorumSayisiHesapla($db,$usttweet[tweet_id]) ?></a>
                </div>
                <div class="rt">
                    <form action="fonksiyonlar.php" method="post">
                        <div class="submit">
                            <submit name="rt-button" class="rt-button" style="width: 22px; margin-bottom: 20px">
                                <img src="images/like/rt.svg" height="18px" ><a style="visibility: hidden">&nbsp20</a>
                            </submit>
                        </div>
                    </form>
                    <div class="rt-sayi">
                        <a href="">10</a>
                    </div>
                </div>
                <div class="like">
                    <?php
                    $sorgu=$db->prepare('select * from likes WHERE
                                uye_id=? AND tweet_id=?');
                    $like=$sorgu->execute([
                        $_COOKIE['id'],
                        $usttweet[tweet_id],
                    ]);

                    if ($like=$sorgu->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="">
                            <a href="fonksiyonlar.php?like-sil-id=<?php echo $usttweet[tweet_id]  ?>"><img src="images/like/like%20(1).svg" width="20px" style="margin-right: -30px"><span style="visibility: hidden">sasd</span></a>
                        </div>


                    <?php }
                    else {  ?>
                        <div class="">
                            <a href="fonksiyonlar.php?like-id=<?php echo $usttweet[tweet_id]  ?>"><img src="images/like/like%20(2).svg" width="20px" style="margin-right: -30px"><span style="visibility: hidden">sasd</span></a>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="likesayi">
                        <a href="<?php echo 'tweetpage.php?begeni-listele='.$usttweet[tweet_id].'&tweet='.$usttweet[tweet_id];   ?>"><?php begeniSayisiHesapla($db,$usttweet[tweet_id]) ?></a>
                    </div>
                </div>


            </div>
        </div>
        <?php

        //beğeni listeleme
        if (isset($_GET['begeni-listele'])){
            $like_id=$_GET['begeni-listele'];

            $sorgu=$db->prepare('select * from members a INNER JOIN likes b on a.uye_id=b.uye_id WHERE tweet_id=?');
            $listele=$sorgu->execute([
                $like_id,
            ]);
            echo "<div style='border-bottom: 1px solid #657786;padding: 5px'>Beğenenler</div>";

            while ($listele=$sorgu->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="begenen">
                <div class="begenenpp">
                    <img src="<?php echo $listele[uye_pp] ?>" class="begenen-pp">
                </div>
                <div class="begenen-bilgi">
                    <div class="begenen-isim">
                        <a href="profil.php?id=<?php echo $listele[uye_id] ?>"><?php echo $listele[uye_adi]." ".$listele[uye_soyadi] ?></a>
                    </div>
                    <div class="begenen-kadi">
                        <a href="profil.php?id=<?php echo $listele[uye_id] ?>"><?php echo "@".$listele[uye_kadi] ?></a>
                    </div>
                </div>
            </div>


            <?php
        }}
        else{//yorumları göster

        while ($alttweet=$alttweetquery->fetch(PDO::FETCH_ASSOC)) {
            $uye_id=$alttweet[uye_id];
            $uyequery=$db->prepare("SELECT * from members where uye_id=?");
            $uye_bilgiler=$uyequery->fetch(PDO::FETCH_ASSOC);

            $uyequery->execute([
                $uye_id
            ]);
            $uye_bilgiler=$uyequery->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="alttweet">
                <div class="alttweet-sol">
                    <div class="altpp">
                        <a href=""><img src="<?php echo $uye_bilgiler[uye_pp] ?>" class="altpp-img"></a>
                    </div>
                </div>
                
                
                <div class="alttweet-sag">
                    <div class="alttweet-ust">
                        <div class="altbilgi">
                            <div class="adi">
                                <a href="profil.php?id=<?php echo $uye_bilgiler['uye_id'] ?>">
                                    <?php echo  $uye_bilgiler[uye_adi]." ".$uye_bilgiler[uye_soyadi]." @".$uye_bilgiler[uye_kadi];  ?>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="yanit-olarak">
                        <a href="profil.php?id=<?php echo $ustuyebilgi[uye_id] ?>">@<?php echo $ustuyebilgi[uye_kadi];?></a>&nbsp; adlı kullanıcıya yanıt olarak.
                    </div>

                    <div class="alticerik">
                        <div class="alticerik-metin">
                            <?php echo $alttweet[tweet_icerik];   ?>
                        </div>
                        <div class="alticerik-foto">
                            <img src="<?php echo $alttweet['tweet_img']  ?>" style="max-width: 430px;max-height: 300px;border-radius: 20px">
                        </div>

                    </div>
                    <div class="alttarih">
                        <?php echo $alttweet[tweet_tarih];   ?>
                    </div>

                    <div class="alttweet-alt">
                        <div class="altyorum">
                            <a href="tweetpage.php?tweet=<?php echo $alttweet[tweet_id]; ?>"><img src="images/like/yorum.svg" width="13px"> <?php yorumSayisiHesapla($db,$alttweet[tweet_id]) ?></a>
                        </div>
                        <div class="rt">
                            <form action="fonksiyonlar.php" method="post">
                                <div class="submit">
                                    <submit name="rt-button" class="rt-button" style="width: 22px; margin-bottom: 20px">
                                        <img src="images/like/rt.svg" height="18px" ><a style="visibility: hidden">&nbsp20</a>
                                    </submit>
                                </div>
                            </form>
                            <div class="rt-sayi">
                                <a href="">10</a>
                            </div>
                        </div>
                        <div class="like">
                            <?php
                            $sorgu=$db->prepare('select * from likes WHERE
                                uye_id=? AND tweet_id=?');
                            $like=$sorgu->execute([
                                $_COOKIE['id'],
                                $alttweet[tweet_id],
                            ]);

                            if ($like=$sorgu->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div class="">
                                    <a href="fonksiyonlar.php?like-sil-id=<?php echo $alttweet[tweet_id]  ?>"><img src="images/like/like%20(1).svg" width="20px" style="margin-right: -30px"><span style="visibility: hidden">sasd</span></a>
                                </div>


                             <?php }
                             else {  ?>
                                 <div class="">
                                     <a href="fonksiyonlar.php?like-id=<?php echo $alttweet[tweet_id]  ?>"><img src="images/like/like%20(2).svg" width="20px" style="margin-right: -30px"><span style="visibility: hidden">sasd</span></a>
                                 </div>
                             <?php
                                 }
                            ?>


                            <div class="likesayi">
                                <a href="<?php echo 'tweetpage.php?begeni-listele='.$alttweet[tweet_id].'&tweet='.$alttweet[tweet_id];   ?>"><?php begeniSayisiHesapla($db,$alttweet[tweet_id]) ?></a>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
            <?php

        }
            }?>
    </div>
    <div class="girisyapildi-sag">
        <div class="alttweetAt">
            <form action="fonksiyonlar.php" method="post" enctype="multipart/form-data">
                <div class="tweet-gonder-metin">
                    <textarea  cols="40" rows="10" class="txtbox-kayit" name="mention_icerik" maxlength="240" style="resize: none" placeholder="Cevap ver..!"></textarea>
                </div>
                <input type="hidden" value="<?php echo $_GET['tweet']  ?> " name="usttweet_id">
                <div class="foto">
                    <input type="file" name="mention-resim"  >(JPEG)
                </div>
                <div class="tweet-gonder-button">
                    <input type="submit" name="mention_at" class="tw-button" value="Tweetle">
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>
