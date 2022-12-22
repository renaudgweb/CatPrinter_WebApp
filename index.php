<?php
// Text
// curl --location -X POST --form 'font="comic.ttf"' --form 'size="48"' --form 'text="Lorem ipsum."' --form 'feed="100"' 'localhost:5000'

// Image
// curl --location -X POST --form 'image=@/home/your/path/catprinter/test.png' --form 'feed="100"' 'localhost:5000'

// Feed
// curl --location --request POST --form 'feed="100"' 'localhost:5000'

if(($_SERVER["REQUEST_METHOD"] == "POST")){
  if (isset($_POST['text']) && isset($_POST['font_family']) && isset($_POST['font_size'])){
    $font_family = $_POST['font_family'];
    $font_size = $_POST['font_size'];
    $user_text = $_POST['text'];
    shell_exec("curl --location -X POST --form 'font=".$font_family."' --form 'size=".$font_size."' --form 'text=".$user_text."' --form 'feed=\"100\"' 'localhost:5000'");
  } elseif (isset($_FILES['image'])){
      $errors = array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      if($file_size > 8388608){
        $errors[]='File size must be excately 8 MB';
      }
      if(empty($errors)==true){
        move_uploaded_file($file_tmp,"contents/img/".$file_name);
      }else{
        print_r($errors);
      }
      $user_image = "contents/img/".$file_name;
      shell_exec("curl --location -X POST --form 'image=@".$user_image."' --form 'feed=\"100\"' 'localhost:5000'");
      shell_exec("rm /var/www/html/cat/contents/img/".$file_name);
  } elseif (isset($_POST['feed'])){
      shell_exec("curl --location --request POST --form 'feed=\"100\"' 'localhost:5000'");
  } else {
      echo "<p class='text-2xl text-center' style='background-color:yellowgreen;'>Error</p>";
  }
}
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#75a2dc" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#75a2dc" media="(prefers-color-scheme: dark)">
  <link rel="stylesheet" href="contents/css/style.css">
  <script src="https://cdn.tailwindcss.com"></script>

<title>Cat Printer</title>

</head>
<body class="font-mono">
  <h1 class="text-3xl text-center underline">Cat Printer Web App</h1>
  <nav>
    <form action="" method="post">
      <select name="font_family">
        <option value="Lucida_Console_Regular.ttf" selected="yes">Lucida Console</option>
        <option value="MajorMonoDisplay-Regular.ttf">Major Mono Display</option>
        <option value="VG5000-Regular_web.ttf">VG5000</option>
        <option value="ocr_b.ttf">OCR-B</option>
      </select>

      <select name="font_size">
        <option value="6">6 pt</option>
        <option value="7">7 pt</option>
        <option value="8">8 pt</option>
        <option value="9">9 pt</option>
        <option value="10">10 pt</option>
        <option value="11">11 pt</option>
        <option value="12">12 pt</option>
        <option value="13">13 pt</option>
        <option value="14">14 pt</option>
        <option value="15">15 pt</option>
        <option value="16">16 pt</option>
        <option value="18">18 pt</option>
        <option value="20" selected="yes">20 pt</option>
        <option value="21">21 pt</option>
        <option value="22">22 pt</option>
        <option value="24">24 pt</option>
        <option value="26">26 pt</option>
        <option value="28">28 pt</option>
        <option value="30">30 pt</option>
        <option value="32">32 pt</option>
        <option value="34">34 pt</option>
        <option value="36">36 pt</option>
        <option value="40">40 pt</option>
        <option value="42">42 pt</option>
        <option value="44">44 pt</option>
        <option value="48">48 pt</option>
        <option value="54">54 pt</option>
        <option value="60">60 pt</option>
        <option value="66">66 pt</option>
        <option value="72">72 pt</option>
        <option value="80">80 pt</option>
        <option value="88">88 pt</option>
        <option value="96">96 pt</option>
      </select>

      <button type="submit" name="feed" value="feed">Feed paper</button>
  </nav>
  <main>

    <section>
        <textarea id="text" name="text" placeholder=" Write here..."></textarea>
        <button type="submit">send text</button>
    </section>
    </form>

    <section class="image">
      <div class="drag-area">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="file" name="image" id="file-selector" accept=".jpg, .jpeg, .png">
          <button type="submit" value="send">send image</button>
        </form>
        <p id="status"></p>
      </div>
      <div class="img">
        <img id="output">
      </div>
    </section>

  </main>
</body>
<script src="contents/js/script.js"></script>
</html>
