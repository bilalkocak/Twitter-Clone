<?php include('anasayfacerceveust.php')  ?>

<div class="LogOut-sag">                  
    <div class="LogOut-sag-signup">
        <div class="signup-header">
            <img src="images/twitter.png" alt="" width="50px" height="50px">
        </div>
        <h1 class="suanda">Şu anda dünyada neler olup bittiğini gör</h1>
        <h2 class="katil"><?php if($_GET['hata']=='sifre'){ echo 'Şifre veya mail hatalı !!!';} else {echo "Twitter'a giriş yap.";} ?></h2>
        <form action="girisyap.php" method="post">
            <div class="signup-posta">
                <input type="email" class="txtbox-kayit" name="uye_mail"  placeholder="E-posta">
            </div>
            <div class="signup-sifre">
                <input type="password" class="txtbox-kayit" name="uye_sifre"  placeholder="Şifre">  
            </div>
            <div class="signup-button">
                <input type="submit" class="btn-basla" value="Giriş yap">
                <div>
                    <p>Hesabın yok mu? <a href="kayitol.php" class="giris">Kayıt Ol</a></p>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('anasayfacercevealt.php')  ?>