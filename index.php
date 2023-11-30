<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <?php
        require_once '_connec.php';

        $idmovie = 2;
        $pdo = new \PDO(DSN, USER, PASS);
        $query  = "SELECT `session`, date_movie, room, seatAvai, idmovie_session, seats  FROM movie_session as m JOIN `session`  as s ON m.idsession = s.idsession 
        JOIN date_of as d ON m.iddate_of = d.iddate_of 
        JOIN room as r ON r.idroom = m.idroom where idmovie = $idmovie AND seatAvai > 0 AND end_session > NOW()";
        $statement = $pdo->query($query);
        $availableMovies = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <form method="post">
        <div>
            <select id="date" name="date" class="form-control linked-selected" data-target="#hour" data-source="list.php?type=hour&filter=$id" >
                <option value="0">Choisissez votre date</option>
                <?php
                foreach ($availableMovies as $avMovie) {            
                echo '<option value="'. $avMovie['idmovie_session'] . '">' . $avMovie['date_movie']  . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <select id="hour" name="hour"  class=" form-control linked-selected" style="display: none;">
                <option value="0">Choisissez votre horaire</option>
            </select>  
        </div>
        </form>
        <script src="index.js"></script>
    </body>