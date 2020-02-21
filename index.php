<?php
declare(strict_types=1);
ini_set('display_errors', "1"); // om foutmeldingen te tonen
session_start();

// class post
class post {

    // initializing properties
    private $author;
    private $message_content;
    private $message_title;

    // this is the setter
    public function __construct($titel, $message, $name) {
        $this->message_title=$titel;
        $this->message_content=$message;
        $this->author = $name;
    }
    // this is the getter
    public function display() {
        echo $this->message_title;
        echo $this->message_content;
        return $this->author;
    }
}

$publication = new post($_POST['title'],$_POST['message'],$_POST['name']);
$publication->display();
echo '<br>';
var_dump($publication);

//var_dump($_POST); // testing $_POST

/* zoiets gebruiken om de posts af te spelen: zie hieronder: ne foreach en dan ineens in de html plaatsen
<?php foreach ($products AS $i => $product): ?>
             <label><!-- hier nog den checked verbeteren want ie houdt alleen het laatste item geselecteerd !!!!!!!!!!!! nog aanpassen !!!!!! -->
              <input type="checkbox" value="<?php echo number_format($product['price'], 2) ?>" name="products[<?php echo $product['name'] ?>]"
               <?php if (isset($_POST['products']) && $product['name']==$foodDrink) echo "checked=checked";?>/> <?php echo $product['name'] ?> -
                     &euro; <?php echo number_format($product['price'], 2) ?></label><br />
                <?php endforeach; ?>*/

// nen datum genereren om ook in dat gastboek te publiceren!
echo $date = date('d-m-Y'); // generate the dat for in the guestbook
// class guestbook
// only show the latest 20 post - newest message on top
// get and put data on a file:

$file = 'data.json';
//read json file from url in php
$readJSONFile = file_get_contents($file); // dit werkt! :)
//print_r($readJSONFile); // display contents

$array = substr($readJSONFile,7,2);
//convert json to array in php
$array = json_decode($readJSONFile, TRUE); // makes an array // dit werkt! :)
var_dump($array); // print array

// in een foreach steken om alles te tonen
foreach ($array AS $key => $value):
    echo "<h3>$value['titel']</h3>";
    echo "<h3>$value</h3>";

                 endforeach;
echo $array[0]['date'];
echo $array[0]['titel'];
echo $array[0]['comment'];
echo $array[0]['name'];

// dus als de post verstuurt wordt onclick via unshift de gegevens van boven bij duwen.  de tweede waarde nog vervangen door een var uit de post
$array_post=array("date"=>"2-3-2020","titel"=>"verzonnen titel","comment"=>"blablabla","name"=>"Steve");
array_unshift($array,$array_post);
// om data om te zetten naar tekst voor deze terug op te slaan
$content=json_encode($array);
var_dump($content);

file_put_contents($file, $content);

//var_dump($array); // print array
/*$file = 'data.json';
$content = file_get_contents($file);
json_encode() //to convert your array to a string to store. // om die array om te zetten naar data die je kan 'store'n'
$content.= "de inhoud uit de post";
file_put_contents($file, $content);
/*
file_get_contents()
    file_put_contents()
json_encode() //to convert your array to a string to store.
serialize()*/
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <style>
        body{
            background-color:#EEE;
        }
        .error{
            color:red;
        }

        footer {
            text-align: center;
        }
    </style>

    <title>Guestbook</title>
</head>
<body>
<main class="container">
    <H1>GUESTBOOK</H1>
    <H3></H3>
    <p></p>
    <em></em>
<form method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " >
    <section class="form-row">
        <section class="form-group col-md-3">
            <label for="titel">Titel</label>

            <input type="text" id="title" name="title" class="form-control" placeholder="Here the titel" />
           <!-- <span class="error"> <?php //echo $titelErr; ?></span><br /> -->

            <label for="message">Your message:</label>
            <textarea name="message" rows="10" cols="30" id="message" name="message" class="form-control" >
Type here your message
</textarea>
           <!-- value="<?php //echo $email; ?> -->
          <!--  <span class="error"> <?php //echo $messageErr; ?></span>-->

            <label for="name">Your name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Here your name" />
         <!--   <span class="error"> <?php //echo $nameErr; ?></span> -->
        </section>
    </section>
<button type="submit" class="btn btn-primary">Post comment</button>
</form>
</main>
<footer>You have placed<?php //echo $_COOKIE['$cookie_email'] ?> your message.</footer>
</div>
</body>
</html>