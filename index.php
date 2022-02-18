<?php
// Ouvrir une connexion à la base de données MySQL
$connection = new PDO("mysql:host=172.17.0.3;dbname=prepag1_salutem", "root", "root", [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
]);

// Récupérer la liste dans spécialités en base de données
$query = "SELECT * FROM speciality";
$stmt = $connection->prepare($query);
$stmt->execute();
$specialities = $stmt->fetchAll();

// Récupérer la liste dans docteurs en base de données
$query = "SELECT doctor.*, speciality.name AS speciality
            FROM doctor
            INNER JOIN speciality ON doctor.speciality_id = speciality.id";
$stmt = $connection->prepare($query);
$stmt->execute();
$doctors = $stmt->fetchAll();

// Récupérer la liste dans docteurs en base de données
$query = "SELECT * FROM opening_hours";
$stmt = $connection->prepare($query);
$stmt->execute();
$opening_days = $stmt->fetchAll();

/*
echo "<pre>";
print_r($doctors);
echo "</pre>";
die;
*/

require_once 'layout/header.php';
?>

<main>
    <section class="home-top">
        <article class="container">
            <h1>Salutem</h1>
            <h2>Maison de santé</h2>
            <a href="#appointment" class="btn btn-dark">Prendre rendez-vous</a>
        </article>
    </section>
    <section class="home-boxes">
        <div class="container">
            <article>
                <h3>Centre médicale</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, debitis delectus dolorem, est eveniet ex explicabo id iure iusto magni maiores nam non numquam odio officiis quaerat reiciendis repellat totam.</p>
                <a href="#" class="btn btn-light">Lire la suite</a>
            </article>
            <article>
                <h3>Horaires d'ouverture</h3>
                <table class="opening-hours">
                    <?php foreach($opening_days as $day) : ?>
                        <tr>
                            <td><?php echo $day['day_name']; ?></td>
                            <td class="hours">
                                <?php echo $day['hour_from']; ?>
                                -
                                <?php echo $day['hour_until']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </article>
            <article>
                <h3>Numéro d'urgence</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci assumenda aut delectus dolores illo laboriosam provident reiciendis tempore vel?</p>
                <p>
                    <a href="tel:0243785443" class="phone-number">0243785443</a>
                </p>
                <a href="#" class="btn btn-light">Lire la suite</a>
            </article>
        </div>
    </section>

    <section class="doctors">
        <div class="container">
            <article>
                <form class="form-appointment">
                    <h3>Prendre rendez-vous</h3>
                    <input type="text" required placeholder="Nom">
                    <input type="text" required placeholder="Prénom">
                    <input type="email" placeholder="Email">
                    <input type="tel" required placeholder="Téléphone">
                    <input type="date" required placeholder="Date">
                    <input type="time" step="900" required placeholder="Heure">
                    <select required >
                        <option disabled selected>Choisissez une spécialité</option>
                        <?php foreach($specialities as $speciality) : ?>
                            <option>
                                <?php echo $speciality['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <textarea placeholder="Votre message"></textarea>
                    <button type="submit" class="btn btn-light">
                        <i class="fa fa-check"></i>
                        Envoyer
                    </button>
                </form>
            </article>
            <?php foreach($doctors as $doctor) : ?>
                <?php $full_name = $doctor['first_name'] . ' ' . $doctor['last_name']; ?>
                <article class="doctor-thumbnail">
                    <img src="uploads/<?php echo $doctor['photo']; ?>" alt="<?php echo $full_name; ?>">
                    <div class="doctor-details">
                        <h4>
                            <?php echo $full_name; ?>
                        </h4>
                        <p>
                            <?php echo $doctor['speciality']; ?>
                        </p>
                        <a href="#" class="btn btn-dark">
                            <i class="fa fa-eye"></i>
                            Plus d'informations
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php require_once 'layout/footer.php'; ?>