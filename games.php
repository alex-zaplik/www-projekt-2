<?php
    require_once("main.php");
    $P = new Page(1,"Gry", "Projektowanie gier");
    echo $P->Begin();

    $Card = new HobbyCard();

    $Card->SetTitle("Tu byłaby gra gdybym w końcu jakąś skończył");
    $Card->SetDescription("
        Gdyby liczyć wszystkie rozpoczęte projekty, portfolio miałbym spore
        ale niestety liczą się tylko te ukończone.
    ");
    $Card->SetConclusion("
        Kończenie projektów jest ciężkie
    ");

    echo $Card->Generate();

    echo $P->BackButton();
    echo $P->End();
?>
