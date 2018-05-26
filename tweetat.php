<?php

?>

<div class="tweetAt">
    <form action="fonksiyonlar.php" method="post" enctype="multipart/form-data">
        <div class="tweet-gonder-metin">
            <textarea  cols="40" rows="10" class="txtbox-kayit" name="tweet_icerik" maxlength="240" style="resize: none" placeholder="Neler oluyor?"></textarea>
        </div>
        <div class="foto">
            <input type="file" name="resim"  >(JPEG)
        </div>
        <div class="tweet-gonder-button">
            <input type="submit" name="tweet_at" class="tw-button" value="Tweetle">
        </div>
    </form>
</div>