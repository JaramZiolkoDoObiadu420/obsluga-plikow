<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <label for="notatka"></label>
        <input type="text" name="notatka" id="notatka">
        <button type="submit" name="notatki" value="dodaj">Dodaj notatkę</button>
        <button type="submit" name="notatki" value="wyswietl">Wyswietl notatki</button>
        <button type="submit" name="notatki" value="usun" onclick="return confirm('jestes konfi?');">Usuń notatki</button>
        <button type="submit" name="notatki" value="zakoncz">Zakończ program</button>
    </form>
    <?php
        $plik = fopen("notes.txt","a+") or die("Błąd!");
        $sciezka = "notes.txt";
        if(isset($_POST['notatki']))
        {
            $przycisk = $_POST['notatki'];
            if($przycisk == 'wyswietl')
            {
                if(file_exists($sciezka) && filesize($sciezka) > 0)
                {
                    $linie = file($sciezka);
                    $numer = 1;

                    foreach($linie as $linia)
                    {
                        echo $numer . ". " . nl2br($linia);
                        $numer++;
                    }
                }
                else
                {
                    echo "Brak notatek!";
                }
            }
            if($przycisk == 'dodaj')
            {
                $notatka = $_POST['notatka'];
                $data = date("Y/m/d")." ".date("h:i:s");
                if($notatka == "")
                {
                    echo "Wpisz notatke";
                }
                else
                {
                    $notatka = $data." ".$_POST['notatka']."\n";
                    fwrite($plik, $notatka);
                }
            }
            if($przycisk == 'usun')
            {
                unlink($sciezka); 
            }
            if($przycisk == 'zakoncz')
            {
                fclose($plik);
            }
        }       
        else
        {
            echo "Wpisz notatke";
        }
    ?>
</body>
</html>