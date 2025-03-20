<?php

// ARRAY ORIGINALE
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

// ARRAY FILTRATO
$filteredHotels = array_filter($hotels, function ($hotel) {

    // isset() è una funzione di PHP che verifica se una variabile è stata dichiarata ed è diversa da null
    // isset() aiuta a evitare errori quando controlliamo variabili che potrebbero non esistere

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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/styles.css">
    <title>PHP Hotels</title>
</head>

<body>

    <div class="container">
        
        <!-- Main Title -->
        <h1>Trova l'hotel che fa per te!</h1>

        <p>Trova l'hotel perfetto per te! Usa questi filtri per selezionare gli hotel in base al voto e alla disponibilità di parcheggio.</p>

        <!-- Form -->
        <form method="GET">

            <div class="filters">

                <!-- Parking Checkbox -->
                <div class="parking-checkbox">
                    <label for="parking">Parcheggio disponibile</label>
                    <input type="checkbox" id="parking" name="parking" value="1" <?php if (isset($_GET['parking'])) echo 'checked'; ?>>
                </div>

                <!-- Vote Select -->
                <div class="vote-div">
                    <label for="vote">Voto</label>
                    <select name="vote" id="vote">
                        <option value="">Qualsiasi</option>
                        <option value="1" <?php if (isset($_GET['vote']) && $_GET['vote'] == 1) echo 'selected'; ?>>1 ⭐</option>
                        <option value="2" <?php if (isset($_GET['vote']) && $_GET['vote'] == 2) echo 'selected'; ?>>2 ⭐</option>
                        <option value="3" <?php if (isset($_GET['vote']) && $_GET['vote'] == 3) echo 'selected'; ?>>3 ⭐</option>
                        <option value="4" <?php if (isset($_GET['vote']) && $_GET['vote'] == 4) echo 'selected'; ?>>4 ⭐</option>
                        <option value="5" <?php if (isset($_GET['vote']) && $_GET['vote'] == 5) echo 'selected'; ?>>5 ⭐</option>
                    </select>
                </div>

            </div>

            <!-- Buttons -->
            <div class="buttons-div">

                <!-- Submit Button -->
                <button class="submit-btn" type="submit">Filtra</button>

                <!-- Reset Button -->
                <button class="reset-btn" type="button" onclick="window.location.href='index.php'">Reset</button>

            </div>

        </form>



    <!-- Subtitle -->
    <h2>Elenco degli Hotel</h2>

    <!-- Table -->
    <table>

        <!-- Table Head -->
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Parcheggio</th>
                <th>Voto</th>
                <th>Distanza dal centro</th>
            </tr>
        </thead>

        <!-- Table Body -->
        <?php if (count($filteredHotels) > 0) : ?>
            <tbody>
                <?php foreach ($filteredHotels as $hotel) : ?>
                    <tr>
                        <td><?php echo $hotel["name"] ?></td>
                        <td><?php echo $hotel["description"] ?></td>
                        <td class="parking"><?php echo $hotel["parking"] ? "✅" : "❌" ?></td>
                        <td class="vote"><?php echo $hotel["vote"] ?> ⭐</td>
                        <td class="distance"><?php echo $hotel["distance_to_center"] ?> km</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
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

</body>

</html>