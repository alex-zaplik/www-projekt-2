<?php
    require_once("main.php");

    $timer = new ExecutionTime();
    $timer->start(); 

    $P = new Page(1,"Strona główna", false);

    $P->AddCss("reset");
    $P->AddCss("main");

    echo $P->Begin();
?>

        <article class="description">
            <img id="photo" class="fancy-shadow" src="image.jpg" alt="Zdjęcie" />
            <h3>O mnie:</h3>
            <p>
                Szkołę średnią skończyłem w Pile w roku 2016.
                Od roku 2016 studiuję informatykę na Wydziale Podstawowych Problemów Techniki Politechniki Wrocławskiej.
            </p>
            <p>
                W sumie to na razie tyle. Może za parę lat będzie więcej do napisania (Chyba, że nadal będę walczył z
                Językami Formalnymi i Teorią Translacji).
            </p>
            <p>
                Czas wykonania:  <?php $timer->stop(); echo $timer->diff(); ?>  ms
            </p>
        </article>
<?php
    echo $P->Menu();
    echo $P->End();
?>
