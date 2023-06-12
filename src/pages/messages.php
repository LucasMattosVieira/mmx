<?php
    require_once "../php/mySQLConnect.php";

    $pdo = mysqlConnect();

    session_start();

    $userID = $_SESSION["userID"];
    $adID = $_GET["id"];

    try {
      $sql = <<<SQL
          SELECT *
          FROM Anuncio
          WHERE Codigo = ?
          SQL;
  
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$adID]);
  
      $data = $stmt->fetch();
    } catch(Exception $error) {
      throw new Exception("Erro ao tentar acessar anúncio.");
    }

    try {
      $sql = <<<SQL
          SELECT Nome
          FROM Anunciante
          WHERE Codigo = ?
          SQL;
  
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$data["CodAnunciante"]]);
  
      $advertiser = $stmt->fetch();
    } catch(Exception $error) {
      throw new Exception("Erro ao tentar acessar anúncio.");
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="../css/components/footer.css" >
    <link rel="stylesheet" href="../css/global/style.css" >
    <link rel="stylesheet" href="../css/style.css" >
    
    <link rel="stylesheet" href="../css/pages/messages.css" >

    <title>MMX - Tudo ao seu alcance</title>
  </head>
  <body>
    <nav>
      <?php
          if(isset($userID)) {
              echo "<a href='home.php'>HOME</a>";
              echo "<a href='createAd.php'>NOVO ANÚNCIO</a>";
              echo "<a href='myAds.php'>MEUS ANÚNCIOS</a>";
              echo "<a href='messages.php' class='current_page'>MENSAGENS</a>";
              echo "<a href='account.php'>MINHA CONTA</a>";
              echo "<a href='../php/logout.php'>SAIR</a>";
          } else {
              echo "<a href='login.php'>LOGIN</a>";
              echo "<a href='#' class='current_page'>NOVA CONTA</a>";
          }
      ?>
    </nav>

    <header>
      <div id="header_div">
        <img
          src="../assets/logo_rect.svg"
          alt="Logo rectangles 1"
          id="logo_img1"
        >

        <div id="logo_div">
          <h1 id="logo">MMX</h1>
          <h5 id="sub_logo">TUDO AO SEU ALCANCE</h5>
        </div>

        <img
          src="../assets/logo_rect.svg"
          alt="Logo rectangles 2"
          id="logo_img2"
        >
      </div>
    </header>

    <main>
      <h2>Mensagens de interesse</h2>
        
      <div class="message">
        <h3>Mensagem:</h3>
        <p>teste</p>

        <h3>Contato:</h3>
        <p>teste</p>
        
        <h3>Produto:</h3>
        <p>teste</p>

        <div class="actions">
          <button type="button">Deletar mensagem</button>
        </div>
      </div>
      
      <div class="message">
        <h3>Mensagem:</h3>
        <p>teste</p>

        <h3>Contato:</h3>
        <p>teste</p>
        
        <h3>Produto:</h3>
        <p>teste</p>

        <div class="actions">
          <button type="button">Deletar mensagem</button>
        </div>
      </div>
    </main>

    <footer>
      © 2023 by SadDevs Corp.
    </footer>
  </body>
</html>
