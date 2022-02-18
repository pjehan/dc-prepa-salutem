<?php
// Récupérer la liste dans réseaux sociaux en base de données
$query = "SELECT * FROM social_network";
$stmt = $connection->prepare($query);
$stmt->execute();
$social_networks = $stmt->fetchAll();

/*
echo "<pre>";
print_r($social_networks);
echo "</pre>";
*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Salutem - Maison médicale</title>
    <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="header-top">
        <div class="container">
            <div class="social-networks">
                <?php foreach($social_networks as $social_network) : ?>
                    <a href="<?php echo $social_network['url']; ?>">
                        <i class="fa fa-<?php echo $social_network['icon']; ?>"></i>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="contact-infos">
                <ul>
                    <li>
                        <i class="fa fa-phone"></i>
                        <a href="tel:0243785462">0243785462</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:contact@salutem.fr">contact@salutem.fr</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="logo">
                <i class="fa fa-heartbeat"></i>
                Salutem
            </div>
            <div class="status">
                Votre centre est actuellement <span class="open">ouvert</span>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">La maison médicale</a></li>
                <li><a href="#">Nos docteurs</a></li>
                <li><a href="#">Nous contacter</a></li>
            </ul>
        </div>
    </div>
</header>