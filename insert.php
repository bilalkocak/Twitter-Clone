<?php 



//form gönderilmiş mi
if(isset($_POST['submit'])){

    $baslik=isset($_POST['baslik'])?$_POST['baslik']:null;
    $icerik=isset($_POST['icerik'])?$_POST['icerik']:null;
    $onay=isset($_POST['onay'])?$_POST['onay']:0;

    if(!baslik){
        echo 'baslik ekleyin';
    }else if(!icerik){
        echo 'icerik ekleyin';
    }else{
        //ekleme işlemi
        $sorgu=$db->prepare('insert into dersler set
        baslik=?,
        icerik=?,
        onay=?');
        $ekle=$sorgu->execute([
            $baslik,$icerik,$onay
        ]);

        if($ekle){
            header('Location:index.php');
        }else{
            $hata=$sorgu->errorInfo();
            echo 'MySQL Hatası: '.$hata[2];
        }
    }
}



?>



<form action="" method="post">
    Başlık: <br>
    <input type="text" name="baslik" > <br><br>
    İçerik: <br>
    <textarea name="icerik"  cols="30" rows="10"></textarea>
    Onay: <br>
    <select name="onay">
        <option value="1">Onaylı</option>
        <option value="0">Onaylı Değil</option>
    </select>
    <input type="hidden" name="submit" value="1">
    <button type="submit">Gonder</button>
</form>

