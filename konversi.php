<?php
@$angka = isset($_POST['angka']) ? $_POST['angka'] : "0";
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <title>SWITCH-KONVERSI ANGKA -> HURUF</title>
    </head>
    <body>
        <form action="konversi.php" method="POST">
            <table>
                <tr>
                    <td>Input Angka</td>
                    <td>=</td>
                    <td><input type="text" name="angka" value="<?php echo $angka; ?>"/></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="SUBMIT"/><br/><br/>

            <?php
            if ($angka) {
                echo number_format($angka, 0) . "<br/>";
                echo ucwords(Dibaca($angka));
            }
            ?>

            <?php
            function Dibaca($x) {
                $angkaBaca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                switch ($x) {
                    case ($x < 12):
                        echo " " . $angkaBaca[$x];
                        break;
                    case ($x < 20):
                        echo $result = Dibaca($x - 10) . " belas";
                        break;
                    case ($x < 100):
                        echo Dibaca($x / 10);
                        echo " puluh ";
                        echo Dibaca($x % 10);
                        break;
                    case ($x < 200):
                        echo " seratus ";
                        echo Dibaca($x - 100);
                        break;
                    case ($x < 1000):
                        echo Dibaca($x / 100);
                        echo " ratus";
                        echo Dibaca($x % 100);
                        break;
                    case ($x < 2000):
                        echo " seribu ";
                        echo Dibaca($x - 1000);
                        break;
                    case ($x < 1000000):
                        echo Dibaca($x / 1000);
                        echo " ribu ";
                        echo Dibaca($x % 1000);
                        break;
                    case ($x < 1000000000):
                        echo Dibaca($x / 1000000);
                        echo " juta ";
                        echo Dibaca($x % 1000000);
                        break;
                }
            }
            ?>
        </form>
    </body>
</html>