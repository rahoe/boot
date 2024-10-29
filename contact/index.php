<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', ':3306');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$mail = isset($_POST['mail']) ? (string)$_POST['mail'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$msgName = '';
$msgMail = '';
$msgMessage = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Gelieve een naam in te voeren';
        $allOk = false;
    }

    if (trim($mail) === '') {
        $msgMail = 'Gelieve een correct e-mailadres in te voeren';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        // build & execute prepared statement
        $stmt = $db->prepare('INSERT INTO messages (sender, mail, message, added_on) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($name, $mail, $message, (new DateTime())->format('Y-m-d H:i:s')));

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: ./formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }
    }
}

?><!DOCTYPE html>
<html lang="nl">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon bedrijf.png">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../vloot/">Vloot</a></li>
                <li><a href="../Route/">Routes</a></li>
                <li><a class="logo" href="../"><img src="../img/Logo Boot bedrijf.png" alt="Logo" width="150px"></a></li>
                <li><a href="../over ons/">Over ons</a></li>
                <li><a href="../nieuws/">Nieuws</a></li>
                <li><a href="./">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <main class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Contacteer ons!</h1>
            <section class="input">
            <p class="message">Alle velden zijn verplicht, tenzij anders aangegeven.</p>

            <div>
                <label for="name">Jouw naam</label>
                <input type="text" id="name" name="name" value="<?php echo htmlentities($name); ?>" class="input-text" />
                <span class="message error"><?php echo $msgName; ?></span>
            </div>

            <div>
                <label for="mail">E-mail</label>
                <input type="email" id="mail" name="mail" value="<?php echo htmlentities($mail); ?>" class="input-text" />
                <span class="message error"><?php echo $msgMail; ?></span>
            </div>

            <div>
                <label for="message">Boodschap</label>
                <textarea name="message" id="message" rows="5" cols="40"><?php echo htmlentities($message); ?></textarea>
                <span class="message error"><?php echo $msgMessage; ?></span>
            </div>

            <input type="submit" id="btnSubmit" name="btnSubmit" value="Verstuur" />
        </section>
        </form>
    </main>
    <footer>
        <h2>Neem contact met ons op!</h2>
            <hr>
            <p>Heb je vragen of wil je meer informatie? Wij helpen je graag!
            <p>
            <ul>
                <li>
                    <h3>email</h3>fons.geerts@student.odisee.be
                </li>
                <li>
                    <h3>telefoon</h3>
                </li>
                <li>
                    <h3>adress</h3>
                </li>

            </ul>
            <p>Volg ons op social media voor tips en aanbiedingen!</p>
            <h2>[Bedrijfsnaam] – Jouw avontuur op het water begint hier!</h2>
            <hr>
    </footer>
</body>

</html>