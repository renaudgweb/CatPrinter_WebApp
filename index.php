<?php
// Text
// curl --location -X POST --form 'font="comic.ttf"' --form 'size="48"' --form 'text="Lorem ipsum."' --form 'feed="100"' 'localhost:5000'

// Image
// curl --location -X POST --form 'image=@/home/your/path/catprinter/test.png' --form 'feed="100"' 'localhost:5000'

// Feed
// curl --location --request POST --form 'feed="100"' 'localhost:5000'

if(($_SERVER["REQUEST_METHOD"] == "POST")){
  if (empty(isset($_POST['text'])) && isset($_POST['font_family']) && isset($_POST['font_size'])){
    $font_family = htmlspecialchars($_POST['font_family']);
    $font_size = htmlspecialchars($_POST['font_size']);
    $user_text = htmlspecialchars($_POST['text']);
    shell_exec("curl --location -X POST --form 'font=".$font_family."' --form 'size=".$font_size."' --form 'text=".$user_text."' --form 'feed=\"100\"' 'localhost:5000'");
  } elseif (empty(isset($_FILES['image']))){
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
      echo "<p class='text-2xl text-center' style='background-color:yellow;text-align:center;font-size:20px'>Error: the text-area or image is empty :(</p>";
  }
}
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#f0f" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#f0f" media="(prefers-color-scheme: dark)">
  <link rel=icon href=contents/favicon/favicon.png sizes="16x16" type="image/png">
  <link rel=icon href=contents/favicon/favicon.ico sizes="32x32 48x48" type="image/vnd.microsoft.icon">
  <link rel=icon href=contents/favicon/android-chrome-512x512.png sizes="192x192 512x512">
  <link rel=icon href=contents/favicon/apple-touch-icon.png sizes="180x180" type="image/png">
  <link rel="stylesheet" href="contents/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<title>Web Cat Printer</title>

</head>
<body>
  <audio controls autoplay loop>
    <source src="contents/sounds/Kirk_Osamayo-Shiba.mp3">
  </audio>

  <h1>Web Cat Printer (◉_◉)</h1>

  <nav>
    <form id="fonts" action="" method="post">
      <select id="font_family" name="font_family">
        <option value="Lucida_Console_Regular.ttf">Lucida Console</option>
        <option value="MajorMonoDisplay-Regular.ttf">Major Mono Display</option>
        <option value="VG5000-Regular_web.ttf" selected="yes">VG5000</option>
        <option value="ocr_b.ttf">OCR-B</option>
        <option value="Anthony.ttf">Anthony</option>
        <option value="BilboINC.ttf">BilboINC</option>
        <option value="CirrusCumulus.ttf">CirrusCumulus</option>
        <option value="Commune-Nuit_Debout_web.ttf">Commune Nuit Debout</option>
        <option value="FacadeGX.ttf">Facade</option>
        <option value="Format_1452.ttf">Format1452</option>
        <option value="Gulax-Regular.ttf">Gulax</option>
        <option value="vtf_hngl-webfont.ttf">Hangul</option>
        <option value="Mister-Pixel-Regular.ttf">Mister Pixel</option>
        <option value="le-murmure.ttf">le murmure</option>
        <option value="Ouroboros-Regular.ttf">Ouroboros</option>
        <option value="outward-block.ttf">outward (block)</option>
        <option value="outward-borders.ttf">outward (borders)</option>
        <option value="PicNic-Regular.ttf">PicNic</option>
        <option value="Pilowlava-Regular.ttf">Pilowlava</option>
        <option value="savate-regular-webfont.ttf">savate</option>
        <option value="Sligoil-Micro.ttf">Sligoil</option>
        <option value="Solide_Mirage-Mono_web.ttf">Solide Mirage</option>
        <option value="Steps-Mono.ttf">Steps</option>
        <option value="terminal-grotesque.ttf">terminal grotesque</option>
        <option value="Trickster-Reg.ttf">Trickster</option>
        <option value="Typefesse_Claire-Obscure.ttf">Typefesse (Claire-Obscure)</option>
        <option value="Typefesse_Pleine.ttf">Typefesse (Pleine)</option>
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
        <option value="20">20 pt</option>
        <option value="21">21 pt</option>
        <option value="22">22 pt</option>
        <option value="24">24 pt</option>
        <option value="26">26 pt</option>
        <option value="28" selected="yes">28 pt</option>
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
      </div>
      <div class="status">
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
