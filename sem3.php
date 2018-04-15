<?php
    require_once("main.php");
    $P = new Page(1,"Semestr 3 (2017/18)", "Semestr 3 (2017/18)");

    $P->AddCss("reset");
    $P->AddCss("main");
    
    echo $P->Begin();

    $Card = new SubjectCard();

    $Card->SetTitle("Architektura komputerów i systemy operacyjne");
    $Card->SetIsList(false, false);
    $Card->SetLearned("
        Że można napisać książkę, która ma 100+ stron w niecały
        tydzień w siedem osób, a także tego, że wszystko jest bardzo proste.
    ");
    $Card->SetExtra("
        Pisania większych programów w językach assembly.
    ");

    echo $Card->Generate();

    $Card = new SubjectCard();

    $Card->SetTitle("Technologie programowania");
    $Card->SetIsList(false, false);
    $Card->SetLearned("
        Że są jednak na tym kierunku wykłady na których \"aktualny stan rzeczy\"
        tyczy się tej dekady, a nie lat pięćdziesiątych ubiegłego wieku.
    ");
    $Card->SetExtra("
        Regex'a by w końcu móc zrozumieć co robią programy w SEDzie.
    ");

    echo $Card->Generate();

    $Card = new SubjectCard();

    $Card->SetTitle("Bazy danych i systemy informacyjne");
    $Card->SetIsList(false, false);
    $Card->SetLearned("
        Że można, bezproblemowo dostać 5.5 z przedmiotu którego zasady
        oceniania (niewiedzieć czemu) wielu osobom się nie podobały.
    ");
    $Card->SetExtra("
        Obiektowych baz danych.
    ");

    echo $Card->Generate();

    echo $P->BackButton();
    echo $P->End();
?>
