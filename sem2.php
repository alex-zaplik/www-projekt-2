<?php
    require_once("main.php");
    $P = new Page(1,"Semestr 2 (2016/17)", "Semestr 2 (2016/17)");
    echo $P->Begin();

    $Card = new SubjectCard();

    $Card->SetTitle("Analiza metematyczna 2");
    $Card->SetIsList(false, false);
    $Card->SetLearned("
        Że podciąg podciągu jest podciągiem ciągu.
    ");
    $Card->SetExtra("
        Że podciąg podciągu podciągu podciągu ciągu jest również podciągiem ciągu.
    ");

    echo $Card->Generate();

    $Card->SetTitle("Algebra abstrakcyjna");
    $Card->SetIsList(true, false);
    $Card->SetLearned("
        <li>Grupy</li>
        <li>Pierścienie</li>
        <li>Ciała</li>
    ");
    $Card->SetExtra("
        Nie wiem ale na pewno coś ciekawego by się znalazło.
    ");

    echo $Card->Generate();

    $Card->SetTitle("Matematyka dyskretna");
    $Card->SetIsList(true, false);
    $Card->SetLearned("
        <li>Dużo dużych sum</li>
        <li>Grafy (i ryzykowne dowody twierdzień)</li>
        <li>Prawdopodobieństwo klasyczne</li>
    ");
    $Card->SetExtra("
        Teorii grafów ale to za rok (chyba).
    ");

    echo $Card->Generate();

    echo $P->BackButton();
    echo $P->End();
?>
