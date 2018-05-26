<?php
include 'baglan.php';





$query=$db->prepare("select a.* from tweets a inner join members b on a.uye_id=b.uye_id inner join follows c on c.takipedilen_id=b.uye_id WHERE c.takipeden_id=? ORDER by a.tweet_tarih DESC");
$query->execute([
        $_COOKIE[id]
]);

while ($tweets=$query->fetch(PDO::FETCH_ASSOC)) {
    $uye_id=$tweets[uye_id];
    $query2=$db->prepare("SELECT * from members where uye_id=?");
    $uye_bilgiler=$query2->fetch(PDO::FETCH_ASSOC);

    $query2->execute([
        $uye_id
    ]);
    $uye_bilgiler=$query2->fetch(PDO::FETCH_ASSOC);
    if ($tweets["usttweet_id"]==0) {

        ?>

<div class="tweet">
    <div class="tweet-ust">
        <div class="pp">
            <a href=""><img src="<?php echo $uye_bilgiler[uye_pp] ?>" class="pp-img"></a>
        </div>
        <div class="bilgi">
            <div class="adi">
                <a href="profil.php?id=<?php echo $uye_bilgiler['uye_id'] ?>">
                    <?php echo  $uye_bilgiler[uye_adi]." ".$uye_bilgiler[uye_soyadi];  ?>
                </a>
            </div>
            <div class="kadi">
                <a href="profil.php?id=<?php echo $uye_bilgiler['uye_id']; ?>">
                    <?php echo "@".$uye_bilgiler[uye_kadi];  ?>
                </a>
            </div>
        </div>
    </div>
    <div class="tweet-orta">
        <div class="icerik">
            <div class="icerik-metin">
                <?php echo $tweets[tweet_icerik];   ?>
            </div>
            <div class="icerik-foto">
                <img src="<?php echo $tweets['tweet_img']  ?>" style="max-width: 530px;max-height: 300px;border-radius: 20px">
            </div>

        </div>
    </div>
    <div class="tarih">
        <?php echo $tweets[tweet_tarih];   ?>
    </div>
    <div class="tweet-alt">
        <div class="yorum">
            <a href="tweetpage.php?tweet=<?php echo $tweets[tweet_id]; ?>"><img src="images/like/yorum.svg" width="13px"> <?php yorumSayisiHesapla($db,$tweets[tweet_id]) ?></a>
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
                $tweets[tweet_id],
            ]);

            if ($like=$sorgu->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="">
                    <a href="fonksiyonlar.php?like-sil-id=<?php echo $tweets[tweet_id]  ?>"><img src="images/like/like%20(1).svg" width="20px" style="margin-right: -30px"><span style="visibility: hidden">sasd</span></a>
                </div>


            <?php }
            else {  ?>
                <div class="">
                    <a href="fonksiyonlar.php?like-id=<?php echo $tweets[tweet_id]  ?>"><img src="images/like/like%20(2).svg" width="20px" style="margin-right: -30px"><span style="visibility: hidden">sasd</span></a>
                </div>
                <?php
            }
            ?>

            <div class="likesayi">
                <a href="<?php echo 'tweetpage.php?begeni-listele='.$tweets[tweet_id].'&tweet='.$tweets[tweet_id];   ?>"><?php begeniSayisiHesapla($db,$tweets[tweet_id]) ?></a>
            </div>
        </div>


    </div>
        <!--   -->


</div>
<?php
    }
}?>
