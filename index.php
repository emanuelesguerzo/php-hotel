<?php

// Array Originale
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

// Array Filtrato
$filteredHotels = array_filter($hotels, function ($hotel) {

    // Controllo del filtro parcheggio
    if (isset($_GET['parking']) && $_GET['parking'] == '1' && !$hotel['parking']) {
        return false;
    }

    // Controllo del filtro voto
    if (isset($_GET['vote']) && $_GET['vote'] !== '') {

        // In questo modo converto il voto in numero intero (int) altrimenti mi da errore perche' abbiamo un int ed una stringa
        $vote = (int) $_GET['vote'];

        if ($hotel['vote'] != $vote) {
            return false;
        }
    }

    return true;
});

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/styles.css">

    <!-- Tab Title -->
    <title>PHP Hotels</title>
</head>

<body>
    <div class="wrapper">

        <!-- Header -->
        <header>
            <img src="./img/boolhotel-logo.png" class="logo" alt="Logo di Boolhotels">
        </header>

        <!-- Jumbo Image -->
        <div class="jumbo-img">
            <img src="./img/boolhotels-jumbo.png" alt="Paradise Vacation Vista">
        </div>

        <!-- Container -->
        <div class="container">

            <!-- Main Title -->
            <h1 class="main-title">Trova l'hotel che fa per te!</h1>

            <p class="subtitle">Trova l'hotel perfetto per te! Usa questi filtri per selezionare gli hotel in base al voto e alla disponibilità di parcheggio.</p>

            <!-- Form -->
            <form method="GET">

                <div class="filters">

                    <!-- Vote Select -->
                    <div class="vote-div">
                        <label for="vote">Voto</label>
                        <select name="vote" id="vote">
                            <option value="">Qualsiasi</option>
                            <option value="1" <?php if (isset($_GET['vote']) && $_GET['vote'] == 1) echo 'selected'; ?>>1 stella</i></option>
                            <option value="2" <?php if (isset($_GET['vote']) && $_GET['vote'] == 2) echo 'selected'; ?>>2 stelle</i></option>
                            <option value="3" <?php if (isset($_GET['vote']) && $_GET['vote'] == 3) echo 'selected'; ?>>3 stelle</i></option>
                            <option value="4" <?php if (isset($_GET['vote']) && $_GET['vote'] == 4) echo 'selected'; ?>>4 stelle</i></option>
                            <option value="5" <?php if (isset($_GET['vote']) && $_GET['vote'] == 5) echo 'selected'; ?>>5 stelle</i></option>
                        </select>
                    </div>

                    <!-- Parking Checkbox -->
                    <div class="parking-checkbox">
                        <label for="parking">Parcheggio disponibile</label>
                        <input type="checkbox" id="parking" name="parking" value="1" <?php if (isset($_GET['parking'])) echo 'checked'; ?>>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="buttons-div">

                    <!-- Reset Button -->
                    <button class="reset-btn" type="button" onclick="window.location.href='index.php'"><i class="fa-solid fa-arrows-rotate"></i></button>

                    <!-- Submit Button -->
                    <button class="submit-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>

                </div>

            </form>

            <!-- Table -->
            <div class="table-wrapper">
                <table>

                    <!-- Table Head -->
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrizione</th>
                            <th>Parcheggio</th>
                            <th>Voto</th>
                            <th>Centro (km)</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <?php if (count($filteredHotels) > 0) : ?>
                        <tbody>
                            <?php foreach ($filteredHotels as $hotel) : ?>
                                <tr>
                                    <td class="hotel-name"><?php echo $hotel["name"] ?></td>
                                    <td class="description"><?php echo $hotel["description"] ?></td>
                                    <td class="parking"><?php echo $hotel["parking"] ? "<i class='fa-solid fa-square-check'></i>" : "<i class='fa-solid fa-square-xmark'></i>" ?></td>
                                    <td class="vote"><?php echo $hotel["vote"] ?> <i class="fa-regular fa-star"></i></td>
                                    <td class="distance"><?php echo $hotel["distance_to_center"] ?> km</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <!-- Else -->
                    <?php else : ?>
                        <tbody>
                            <tr>
                                <td colspan="5" class="not-found">
                                    Nessun hotel soddisfa la tua ricerca.
                                </td>
                            </tr>
                        </tbody>
                    <?php endif; ?>

                </table>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-container">

                <!-- Footer Logo -->
                <div class="footer-logo">
                    <img src="./img/boolhotel-logo.png" alt="Logo di Boolhotels" width="60px">
                </div>

                <!-- Footer Links -->
                <div class="footer-links">
                    <a href="#">Chi siamo</a>
                    <a href="#">Contatti</a>
                    <a href="#">Privacy Policy</a>
                </div>

                <!-- Footer Socials -->
                <div class="footer-social">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; 2025 Boolhotels. Tutti i diritti riservati.</p>
            </div>

        </footer>
    </div>
</body>
</html>