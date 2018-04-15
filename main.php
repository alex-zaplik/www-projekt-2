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

{{ CSS }}
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

$CSS_TEMPLATE = <<<EOT
    <link rel="stylesheet" type="text/css" href="css/{{ CSS }}.css">
EOT;

$MENU_TOP_TEMPLATE = <<<EOT
        <nav class="{{ CLASS }}">
            <div class="sub-header">
                <h2>{{ TITLE }}</h2>
            </div>
            <div class="sub-list">
                <ul>
EOT;

$MENU_LINE_TEMPLATE = <<<EOT
                    <li><a href="{{ HREF }}.php">{{ NAME }}</a></li>
EOT;

$MENU_BOTTOM_TEMPLATE = <<<EOT
                </ul>
            </div>
        </nav>
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
    private $Tabs = "\t\t\t\t";
    private $Title = "";
    private $Learned = "";
    private $Extra = "";
    private $IsList = [false, false];

    public function SetTitle($str) {
        $this->Title = $str;
    }

    private function FormatInput($input) {
        $separator = "\r\n";
        $line = strtok($input, $separator);
        $res = "";

        while ($line !== false) {
            $res .= "\n" . $this->Tabs . "\t";
            $res .= (string) trim($line);

            $line = strtok($separator);
        }

        return $this->Tabs . "\t" . trim($res);
    }

    public function SetLearned($str) {
        $this->Learned = $this->FormatInput($str);
    }

    public function SetExtra($str) {
        $this->Extra = $this->FormatInput($str);
    }

    public function SetIsList($learned, $extra) {
        $this->IsList = [$learned, $extra];
    }

    public function Generate() {
        global $SUBJECT_CARD_TEMPLATE;

        $text = (string) str_replace(
            [
                "{{ TITLE }}",
                "{{ LEARNED }}",
                "{{ EXTRA }}"
            ], [
                $this->Title,
                $this->Tabs . ($this->IsList[0] ? "<ul>" : "<p>") . "\n" . $this->Learned . "\n" . $this->Tabs . ($this->IsList[0] ? "</ul>" : "</p>"),
                $this->Tabs . ($this->IsList[1] ? "<ul>" : "<p>"). "\n" . $this->Extra . "\n" . $this->Tabs . ($this->IsList[1] ? "</ul>" : "</p>")
            ],
            $SUBJECT_CARD_TEMPLATE
        );

        return "\n" . $text;
    }
}

class HobbyCard {
    private $Tabs = "\t\t\t\t";
    private $Title = "";
    private $Description = "";
    private $Conclusion = "";

    public function SetTitle($str) {
        $this->Title = $str;
    }

    private function FormatInput($input) {
        $separator = "\r\n";
        $line = strtok($input, $separator);
        $res = "";

        while ($line !== false) {
            $res .= "\n" . $this->Tabs . "\t";
            $res .= (string) trim($line);

            $line = strtok($separator);
        }

        return $this->Tabs . "\t" . trim($res);
    }

    public function SetDescription($str) {
        $this->Description = $this->FormatInput($str);
    }

    public function SetConclusion($str) {
        $this->Conclusion = trim($str);
    }

    public function Generate() {
        global $HOBBY_CARD_TEMPLATE;

        $text = "\n" . (string) str_replace(
            [
                "{{ TITLE }}",
                "{{ DESCRIPTION }}",
                "{{ CONCLUSION }}"
            ], [
                $this->Title,
                $this->Description,
                (strlen($this->Conclusion) > 0 ? "<h5>" . $this->Conclusion . "</h5>" : "")
            ],
            $HOBBY_CARD_TEMPLATE
        );

        return $text;
    }
}

class Page {
    private $id = -1;
    private $Title = "";
    private $Subtitle = "";
    private $CssList = array();

    function __construct($id, $Title, $Subtitle) {
        $this->id = $id;
        $this->Title = $Title;
        $this->Subtitle = $Subtitle;
    }

    public function AddCss($css) {
        $this->CssList[] = $css;
    }

    public function Begin() {
        global $TOP, $CSS_TEMPLATE;

        $Css = "";
        $max = count($this->CssList);
        for ($i = 0; $i < $max; $i++) {
            $Css .= (string) str_replace("{{ CSS }}", $this->CssList[$i], $CSS_TEMPLATE);
            $Css .= "\n";
        }

        $S = (string) str_replace(["{{ TITLE }}", "{{ CSS }}"], ["Edukacja - " . $this->Title, $Css], $TOP);
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
        global $MENU_TOP_TEMPLATE, $MENU_LINE_TEMPLATE, $MENU_BOTTOM_TEMPLATE;

        $mid = "";
        $max = count($subjects);
        for ($i = 0; $i < $max; $i++) {
            $mid .= "\n";
            $mid .= (string) str_replace(["{{ HREF }}", "{{ NAME }}"], [$subjects[$i]["href"], $subjects[$i]["name"]], $MENU_LINE_TEMPLATE);
        }
        $mid .= "\n";

        $start = (string) str_replace(["{{ TITLE }}", "{{ CLASS }}"], [$title, $class], $MENU_TOP_TEMPLATE);
        $end = $MENU_BOTTOM_TEMPLATE;

        return $start . $mid . $end;
    }

    public function Menu() {
        global $EDUCATION;
        global $HOBBY;

        return $this->MenuPart("subjects", $EDUCATION, "Moja edukacja") . "\n" . $this->MenuPart("hobbies", $HOBBY, "Moje hobby");
    }

    public function End() {
        global $BOTTOM;
        return $BOTTOM;
    }
}

class ExecutionTime
{
     private $startTime;
     private $endTime;

     public function start(){
         $this->startTime = microtime(true);
     }
     public function stop(){
         $this->endTime =  microtime(true);
     }
     public function diff(){
         return $this->endTime - $this->startTime;
     }
}
?>
