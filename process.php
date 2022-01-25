<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php

    $targetDir = "files/";

    $targetFile = $targetDir . basename($_FILES["uploadedName"]["name"]);

    $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

    $uploadSuccess = true; //pomocná  - označí nám chybu

//kontrola existence
if (file_exists($targetFile)) {
    echo "Soubor již existuje!";
    $uploadSuccess = false;
}

// Kontrola velikosti (vlastní limit)
if ($_FILES["uploadedName"]["size"] > 8000000 || $_FILES['uploadedName']['size'] <= 0) {
    echo "Soubor je příliš velký";
    $uploadSuccess = false;
}

// Kontrola typu – vždy WHITELIST
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "mp3" ) {
    echo "Bohužel jsou podporovány jen soubory typů JPG, JPEG, PNG, GIF, MP3 a MP4.";
    $uploadSuccess = false;
}

// zkontrolujeme proměnnou, která by nesla chybu
if (! $uploadSuccess) {
    echo "Bohužel došlo k chybě uploadu";
// pokud je vše v pořádku, uložíme soubor trvale
} else {
    if (move_uploaded_file($_FILES["uploadedName"]["tmp_name"], $targetFile)) {
        switch ($imageFileType) {
            case 'jpg':
                echo '<img class="rounded img-fluid" src="' . $targetFile . '" />';
                break;
            case 'jpeg':
                echo '<img class="rounded img-fluid" src="' . $targetFile . '" />';
                break;
            case 'png':
                echo '<img class="rounded img-fluid" src="' . $targetFile . '" />';
                break;
            case 'gif':
                echo '<video class="container" src="' . $targetFile . '" controls>Bohužel nepodporovaný typ souboru</video>';
                break;
            case 'mp4':
                echo '<video class="container" src="' . $targetFile . '" controls>Bohužel nepodporovaný typ souboru</video>';
                break;
            case 'mp3':
                echo '<audio src="' . $targetFile . '" controls>Bohužel nepodporovaný typ souboru</audio>';
                break;
            default:
                echo 'Bohužel nepodporovaný typ souboru. ';
                break;
        }
    } else {
	 echo "Bohužel došlo k chybě uploadu";
    }
}



    ?>
</body>
</html>