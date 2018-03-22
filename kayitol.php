<?php include('anasayfacerceveust.php')  ?>

<div class="LogOut-sag">                  
    <div class="LogOut-sag-signup">
        <div class="signup-header">
            <img src="images/twitter.png" alt="" width="50px" height="50px">
        </div>
        <h1 class="suanda">Twitter'a kayıt yap.</h1>
        <form action="kayit.php" method="post">
            <div class="signup-posta">
                <input type="email" class="txtbox-kayit" name="uye_mail" id="" placeholder="E-posta">
            </div>
            <div class="signup-adsoyad">
                <input type="text" class="txtbox-kayit-adsoyad" name="uye_adi" id="" placeholder="İsim">
                <input type="text" class="txtbox-kayit-adsoyad" name="uye_soyadi" placeholder="Soyisim">
            </div>
            <div class="signup-kadi">
                <input type="text" class="txtbox-kayit" name="uye_kadi" placeholder="Kullanıcı Adı">
            </div>
            <div class="signup-sifre">
                <input type="password" class="txtbox-kayit" name="uye_sifre" placeholder="Şifre">
            </div>
            
           <!-- <div class="signup-sifre">
                <input type="password" class="txtbox-kayit" name="uye_sifret" placeholder="Tekrar Şifre">
            </div> -->
            
            <div class="signup-button">
                <input type="submit" class="btn-basla" value="Kayıt Ol">
                <div>
                    <p>Hesabın var mı? <a href="index.php" class="giris">Giriş Yap</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include('anasayfacercevealt.php')  ?>