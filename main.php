<?php
// Model
$EDUCATION = [
    ['id'=>1, 'name'=>"Szkoła średnia", 'href'=>"high-school"],
    ['id'=>2, 'name'=>"Studia: semestr 1 (2016/17)", 'href'=>"sem1"],
    ['id'=>2, 'name'=>"Studia: semestr 2 (2016/17)", 'href'=>"sem2"],
    ['id'=>2, 'name'=>"Studia: semestr 3 (2017/18)", 'href'=>"sem3"]
];

$HOBBY = [
    ['id'=>1, 'name'=>"Muzyka", 'href'=>"music"],
    ['id'=>1, 'name'=>"Projektowanie gier", 'href'=>"games"]
];

// View
$TOP = <<<EOT
    <!DOCTYPE html>

    <html lang="pl">
        <head>
            <meta charset="utf-8">
            <title>{{ TITLE }}</title>
            <meta name="description" content="Opis mojej przygody z edukacją">
            <meta name="author" content="Aleksander Lasecki">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

            <link rel="stylesheet" type="text/css" href="css/reset.css">
            <link rel="stylesheet" type="text/css" href="css/main.css">
        </head>

        <body>
            <div class="container fancy-shadow">
                <header>
                    <h1>Aleksander Lasecki</h1>
                    <h2>Przygody z edukacją</h2>
                    {{ SUBTITLE }}
                </header>
EOT;

$BOTTOM = <<<EOT
            </div>
        </body>
    </html>
EOT;

$BACK_BUTTON = <<<EOT
    <div class="button-wrapper">
        <a href="index.php" class="back-button fancy-shadow">Strona Główna</a>
    </div>
EOT;

$SUBJECT_CARD_TEMPLATE = <<<EOT
    <h3 class="card-title">{{ TITLE }}</h3>
    <section class="card left fancy-shadow">
        <h4>Czego się dowiedziałem?</h4>
        <div>
               {{ LEARNED }}
        </div>
    </section>
    <section class="card right fancy-shadow">
        <h4>Czego warto się douczyć?</h4>
        <div>
               {{ EXTRA }}
        </div>
    </section>
EOT;

$HOBBY_CARD_TEMPLATE = <<<EOT
    <section class="card single fancy-shadow">
        <h4>{{ TITLE }}</h4>
        <div>
            <p>
                {{ DESCRIPTION }}
            </p>
        </div>
        {{ CONCLUSION }}
    </section>
EOT;

// Controller
class SubjectCard {
    private $Title = "";
    private $Learned = "";
    private $Extra = "";
    private $IsList = [false, false];

    public function SetTitle($str) {
        $this->Title = $str;
    }

    public function SetLearned($str) {
        $this->Learned = $str;
    }

    public function SetExtra($str) {
        $this->Extra = $str;
    }

    public function SetIsList($learned, $extra) {
        $this->IsList = [$learned, $extra];
    }

    public function Generate() {
        global $SUBJECT_CARD_TEMPLATE;

        $text = (string) str_replace("{{ TITLE }}", $this->Title, $SUBJECT_CARD_TEMPLATE);
        $text = (string) str_replace("{{ LEARNED }}", ($this->IsList[0] ? "<ul>" : "<p>") . $this->Learned . ($this->IsList[0] ? "</ul>" : "</p>"), $text);
        $text = (string) str_replace("{{ EXTRA }}", ($this->IsList[1] ? "<ul>" : "<p>") . $this->Extra . ($this->IsList[1] ? "</ul>" : "</p>"), $text);

        return $text;
    }
}

class HobbyCard {
    private $Title = "";
    private $Description = "";
    private $Conclusion = "";

    public function SetTitle($str) {
        $this->Title = $str;
    }

    public function SetDescription($str) {
        $this->Description = $str;
    }

    public function SetConclusion($str) {
        $this->Conclusion = $str;
    }

    public function Generate() {
        global $HOBBY_CARD_TEMPLATE;

        $text = (string) str_replace("{{ TITLE }}", $this->Title, $HOBBY_CARD_TEMPLATE);
        $text = (string) str_replace("{{ DESCRIPTION }}", $this->Description, $text);
        $text = (string) str_replace("{{ CONCLUSION }}", (strlen($this->Conclusion) > 0 ? "<h5>" . $this->Conclusion . "</h5>" : ""), $text);

        return $text;
    }
}

class Page {
    private $id = -1;
    private $Title = "";
    private $Subtitle = "";

    function __construct($id, $Title, $Subtitle) {
        $this->id = $id;
        $this->Title = $Title;
        $this->Subtitle = $Subtitle;
    }

    public function Begin() {
        global $TOP;
        $S = (string) str_replace("{{ TITLE }}", "Edukacja - " . $this->Title, $TOP);
        if (strlen($this->Subtitle) > 0) {
            $S = (string) str_replace("{{ SUBTITLE }}", "<h3>" . $this->Subtitle . "</h3>", $S);
        } else {
            $S = (string) str_replace("{{ SUBTITLE }}", "", $S);
        }
        return $S;
    }

    public function BackButton() {
        global $BACK_BUTTON;
        return $BACK_BUTTON;
    }

    function MenuPart($class, $subjects, $title) {
        $start =  "<nav class=\"$class\">\n";
        $start .= "    <div class=\"sub-header\">\n";
        $start .= "        <h2>{{ TITLE }}</h2>\n";
        $start .= "    </div>\n";
        $start .= "    <div class=\"sub-list\">\n";
        $start .= "        <ul>\n";

        $mid_line = "            <li><a href=\"{{ HREF }}.php\">{{ NAME }}</a></li>\n";

        $mid = "";
        for ($i = 0; $i < count($subjects); $i++) {
            $line = (string) str_replace("{{ HREF }}", $subjects[$i]["href"], $mid_line);
            $mid .= (string) str_replace("{{ NAME }}", $subjects[$i]["name"], $line);
        }

        $end = "        </ul>\n";
        $end .= "    </div>\n";
        $end .= "</nav>\n";

        $start = (string) str_replace("{{ TITLE }}", $title, $start);

        return $start . $mid . $end;
    }

    public function Menu() {
        global $EDUCATION;
        global $HOBBY;

        return $this->MenuPart("subjects", $EDUCATION, "Moja edukacja") . $this->MenuPart("hobbies", $HOBBY, "Moje hobby");
    }

    public function End() {
        global $BOTTOM;
        return $BOTTOM;
    }
}
?>
