<?php

setcookie('id',$uyeler['uye_id'],time()-86400);
setcookie('uye_kadi',$uyeler['uye_kadi'],time()-86400);
setcookie('uye_adi',$uyeler['uye_adi'],time()-86400);
setcookie('uye_soyadi',$uyeler['uye_soyadi'],time()-86400);
setcookie('uye_pp',$uyeler['uye_pp'],time()-86400);
setcookie('uye_kapak',$uyeler['uye_kapak'],time()-86400);
setcookie('oturum','acik',time()-86400);
    header("Location:index.php");
?>