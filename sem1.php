<?php
    require_once("main.php");
    $P = new Page(1,"Semestr 1 (2016/17)", "Semestr 1 (2016/17)");
    echo $P->Begin();

    $Card = new SubjectCard();

    $Card->SetTitle("Analiza metematyczna 1");
    $Card->SetIsList(true, false);
    $Card->SetLearned("
        <li>Granice</li>
        <li>Pochodne</li>
        <li>Całki</li>
    ");
    $Card->SetExtra("
        Przydałoby się trochę więcej topologii.
    ");

    echo $Card->Generate();

    $Card->SetTitle("Algebra z geometrią analityczną");
    $Card->SetIsList(true, false);
    $Card->SetLearned("
        <li>Teoria liczb</li>
        <li>Liczby zespolone</li>
        <li>Wektory i macierze</li>
    ");
    $Card->SetExtra("
        Na razie wystarczy.
    ");

    echo $Card->Generate();

    $Card->SetTitle("Logika i struktury formalne");
    $Card->SetIsList(true, false);
    $Card->SetLearned("
        <li>Kwantyfikatory</li>
        <li>Zbiory</li>
        <li>Moc (ale nie taka jak w Gwiezdnych Wojnach)</li>
    ");
    $Card->SetExtra("
        Niektórzy mówią, że teorii kategorii.
    ");

    echo $Card->Generate();

    $Card->SetTitle("Wstęp do informatyki i programowania");
    $Card->SetIsList(false, false);
    $Card->SetLearned("
        Że Ada jest najlepszym językiem programowania na świecie.
    ");
    $Card->SetExtra("
        ...
    ");

    echo $Card->Generate();

    echo $P->BackButton();
    echo $P->End();
?>
