<?php
/**
 * Created by PhpStorm.
 * User: Bilal
 * Date: 5/16/2018
 * Time: 11:55 PM
 */
$uyebilgisorgu=$db->prepare('SELECT * FROM members where uye_id=?');
$uyebilgisorgu->execute([
    $_COOKIE['id'],
]);
$uyebilgileri=$uyebilgisorgu->fetch(PDO::FETCH_ASSOC);
?>

<div class="profil-duzenle">
    <form action="fonksiyonlar.php" method="post">
        <table>
            <tr>
                <td>
                    İsim:
                </td>
                <td>
                    <input type="text" name="uye_adi" value="<?php echo $uyebilgileri['uye_adi'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Soy İsim:
                </td>
                <td>
                    <input type="text" name="uye_soyadi" value="<?php echo $uyebilgileri['uye_soyadi'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Kullanıcı Adı:
                </td>
                <td>
                    <input type="text" name="uye_kadi" value="<?php echo $uyebilgileri['uye_kadi'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Kapak Fotoğrafı:
                </td>
                <td>
                    <input type="file" name="uye_kapak" value="<?php echo $uyebilgileri['uye_kapak'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Mail Adresi:
                </td>
                <td>
                    <input type="email" name="uye_mail" value="<?php echo $uyebilgileri['uye_bilgileri'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Profil Fotoğrafı:
                </td>
                <td>
                    <input type="file" name="uye_pp" value="<?php echo $uyebilgileri['uye_pp'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Şifre:
                </td>
                <td>
                    <input type="password" name="uye_sifre" value="<?php echo $uyebilgileri['uye_sifre'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Biyografi:
                </td>
                <td>
                    <input type="text" name="uye_bio" value="<?php echo $uyebilgileri['uye_bio'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Web Sitesi:
                </td>
                <td>
                    <input type="text" name="uye_website" value="<?php echo $uyebilgileri['uye_website'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Konum:

                </td>
                <td>
                    <input type="text" name="uye_konum" value="<?php echo $uyebilgileri['uye_konum'] ?>">
                </td>
            </tr>

            <tr>
                <td>

                </td>
                <td>
                    <button type="submit" name="profil-duzenle">Düzenle</button>
                </td>
            </tr>

        </table>
    </form>
</div>

