<?php
declare(strict_types=1);
ini_set('display_errors', "1"); // om foutmeldingen te tonen

// ----------------------------------------------------------------------CONTROLLER-----------------------------------------------------------------------------------------------
require('class_post.php');
require ('class_guestbook.php');

$file = 'data.json'; // nu in het object

$publication = new Post($_POST['title'],$_POST['date'],$_POST['message'],$_POST['name']);
$post_values=$publication->display();
// make the post-array to unshift the new post values into the data-array from the jason file
$array_post=array("date"=>$post_values[1],"titel"=>$post_values[0],"comment"=>$post_values[2],"name"=>$post_values[3]);

$objectGuestbook=new Guestbook($array_post, $file);
$post_values=$objectGuestbook->display_data();

file_put_contents($file, $objectGuestbook->backToJsonFile());  // put the data back on the json file
?>
<!------------------------------------------------------------------- VIEW ---------------------------------------------------------------------------------------------------->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css">
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
            <input type="hidden" id="date" name="date" value="<?php echo $date = date('d-m-Y - H:i:s'); ?>">
            <label for="message" class="mt-3">Your message:</label>
            <textarea name="message" rows="10" cols="30" id="message" name="message" class="form-control" >
Type here your message
</textarea>
           <!-- value="<?php //echo $email; ?> -->
          <!--  <span class="error"> <?php //echo $messageErr; ?></span>-->

            <label for="name" class="mt-3">Your name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Here your name" />
         <!--   <span class="error"> <?php //echo $nameErr; ?></span> -->
            <button type="submit" class="btn btn-primary mt-3">Post comment</button>
        </section>
</form>
    </section>
        <?php
        // only show the latest 20 post - newest message on top
        for ($i=0; $i<=20; $i++) {
            echo "<section id='post' class='form-group col-md-6'>";
            echo "<H4>".$post_values[$i]['titel']."</H4>";
            echo "<em>".$post_values[$i]['date']."</em>";
            echo "<p>".$post_values[$i]['comment']."</p>";
            echo "<em>".$post_values[$i]['name']."</em>";
            echo "</section>";
        }
        ?>
</main>
<footer><?php if($_POST){ echo "You have placed your message"; }else{ echo ""; } ?> </footer>
</div>
</body>
</html>