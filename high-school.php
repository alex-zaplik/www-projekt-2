<?php
    require_once("main.php");
    $P = new Page(1,"Szkoła średnia", "Szkoła średnia");

    $P->AddCss("reset");
    $P->AddCss("main");
    
    echo $P->Begin();

    $Card = new SubjectCard();

    $Card->SetTitle("Matematyka");
    $Card->SetIsList(false, false);
    $Card->SetLearned("
        Wszystkiego o czym potem i tak musiałem zapomnieć,
        poniewarz matematyka na studiach to coś kompletnie innego.
    ");
    $Card->SetExtra("
        Całek, algebry... Właściwie wszystkiego.
    ");

    echo $Card->Generate();

    $Card->SetTitle("Fizyka");
    $Card->SetIsList(true, false);
    $Card->SetLearned("
        <li>Co to jest całka</li>
        <li>Że każdy satalita bezustannie spada na ziemię</li>
        <li>Okazuje się, że zajęcia pozalekcyjne mogą się również odbywać w pokoju nauczycielskim</li>
    ");
    $Card->SetExtra("
        Pisania esejów...
    ");

    echo $Card->Generate();

    $Card->SetTitle("Polski");
    $Card->SetIsList(false, false);
    $Card->SetLearned("
        Że Słowacki wielkim poetą był.
    ");
    $Card->SetExtra("
        Warto pojąć fakt, że nie wszystkie książki są tak nudne
        jak lektury szkolne i że czytanie może (jakimś cudem) być przyjemne.
    ");

    echo $Card->Generate();

    echo $P->BackButton();
    echo $P->End();
?>
