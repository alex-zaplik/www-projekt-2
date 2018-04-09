<?php
    require_once("main.php");
    $P = new Page(1,"Muzyka", "Muzyka");
    echo $P->Begin();

    $Card = new HobbyCard();

    $Card->SetTitle("Elektroniczna");
    $Card->SetDescription("
        Wszystko od lekkiego house'a do dubstepu (do którego fajnie się zasypia).
        W muzyce elektronicznej piękne jest to, że każdy utwór jest robiony od zera,
        więc niemal wszystkie dźwięki są w nim wyjątkowe.
    ");

    echo $Card->Generate();

    $Card->SetTitle("Klasyczna");
    $Card->SetDescription("
        Od czasu do czasu zdarza mi się posłuchać koncertu Rachmaninowa, pójść do
        opery, czy nawet (nieumiejętnie) zagrać coś na pianinie.
    ");
    $Card->SetConclusion("
        Tego się nikt nie spodziwał
    ");

    echo $Card->Generate();

    $Card->SetTitle("POP");
    $Card->SetDescription("
        Chyba każdy czasem miewa taki humor w którym nie ma się ochoty zbyt dużo
        myśleć i chce się tylko czymś wypełnić ciszę panującą w salonie. POP jest
        do wtedy idalnym wyjściem.
    ");
    $Card->SetConclusion("
        Każdemu się zdarza...
    ");

    echo $Card->Generate();

    echo $P->BackButton();
    echo $P->End();
?>
