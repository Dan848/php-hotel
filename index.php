<?php

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

$filteredHotels = [];

if (!empty($_GET["vote"]) && !empty($_GET["parking"])) {
    $selVote = $_GET["vote"];
    $selParking = filter_input(INPUT_GET, "parking", FILTER_VALIDATE_BOOLEAN);
    foreach ($hotels as $hotel) {
        if ($hotel["vote"] == $selVote && $hotel["parking"] == $selParking){
            $filteredHotels[] = $hotel;
        }
    };
}
elseif (!empty($_GET["vote"])) {
    $selVote = $_GET["vote"];
    foreach ($hotels as $hotel) {
        if ($hotel["vote"] == $selVote){
            $filteredHotels[] = $hotel;
        }
    };
}
elseif (!empty($_GET["parking"])) {
    $selParking = filter_input(INPUT_GET, "parking", FILTER_VALIDATE_BOOLEAN);
    foreach ($hotels as $hotel) {
        if ($hotel["parking"] == $selParking){
            $filteredHotels[] = $hotel;
        }
    };
    var_dump($selParking);
}
else {
    $filteredHotels = $hotels;
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
    <header class="container-md text-center mt-3 mb-5">
        <h1 class="mb-3">Hotels</h1>
    </header>
    <main class="container-md">
        <div class="row mb-5">
            <div class="col py-4 px-3 bg-success">
            <!-- FROM -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="row gy-2 gx-3 align-items-center justify-content-center">
                    <!-- SELECT PARKING -->
                    <div class="col-12 col-sm-6 col-md-auto">
                        <div class="input-group">
                            <label class="input-group-text" for="parking">Parcheggio</label>
                            <select class="form-select" name="parking">
                                <option value="" selected>Si/No?</option>
                                <option value="TRUE">Si</option>
                                <option value="FALSE">No</option>
                            </select>
                        </div>
                    </div>
                    <!-- SELECT REVIEW -->
                    <div class="col-12 col-sm-6 col-md-auto">
                        <div class="input-group">
                            <label class="input-group-text" for="vote">Voto</label>
                            <select class="form-select" name="vote">
                                <option value="" selected>Quante stelle?</option>
                                <?php for ($i = 1; $i <= 5; $i++){?>
                                <option value=<?php echo $i?> ><?php echo "$i"?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- BUTTON -->
                    <div class="col-12 col-md-auto">
                        <div class="input-group">
                        <button class="btn btn-warning w-100 fw-bold text-uppercase">Invia</button>
                        </div>
                    </div>
                    <!-- /FROM -->                
                </form>
            </div>
        </div>

        <div class="row mb-5">
            <h2 class="mb-3 col-12">Hotel</h2>
            <div class="col py-4 px-3 bg-success">
                <?php if ($filteredHotels) {?>
                    <table class="table table-dark table-striped mb-0">
                        <thead>
                            <tr>
                            <th scope="col">Voto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Dal Centro</th>
                            <th scope="col">Parcheggio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filteredHotels as $hotel) {?>
                                <tr>
                                    <th scope="row"><?php echo $hotel["vote"]?></th>
                                    <td><?php echo $hotel["name"]?></td>
                                    <td><?php echo $hotel["description"]?></td>
                                    <td><?php echo $hotel["distance_to_center"] . "km"?></td>
                                    <td>
                                        <?php
                                            if ($hotel["parking"]){echo "Si";}
                                            else {echo "No";}
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {?>
                    <h4 class="text-center">Nessun Hotel con queste caratteristiche trovato</h4>
                <?php } ?>
            </div>

        </div>
    </main>
</body>
</html>