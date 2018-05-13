<?php
include 'baglan.php';



$kendi_id=$_COOKIE['id'];


$query=$db->prepare("select * from tweets WHERE uye_id=? ORDER BY tweet_tarih DESC ");
$query->execute([
    $kendi_id
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
            <div class="tweet-sag">
                <div class="pp">
                    <a href=""><img src="<?php echo $uye_bilgiler[uye_pp] ?>" class="pp-img"></a>
                </div>
            </div>
            <div class="tweet-sol">
                <div class="tweet-ust">
                    <div class="bilgi">
                        <div class="adi">
                            <?php echo  $uye_bilgiler[uye_adi]." ".$uye_bilgiler[uye_soyadi]." @".$uye_bilgiler[uye_kadi];  ?>
                        </div>
                    </div>
                </div>

                <div class="icerik">
                    <div class="icerik-metin">
                        <?php echo $tweets[tweet_icerik];   ?>
                    </div>
                    <div class="icerik-foto">
                        <!--yapılacak-->
                    </div>

                </div>
                <div class="tarih">
                    <?php echo $tweets[tweet_tarih];   ?>
                </div>
                <div class="like">

                </div>
                <div class="yorum">

                </div>
            </div>
        </div>
        <?php

    }
}

?>
