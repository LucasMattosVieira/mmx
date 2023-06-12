<?php
    require_once "../php/mySQLConnect.php";

    $pdo = mysqlConnect();

    session_start();

    $id = $_SESSION["userID"];

    if(isset($id)) {
      $sql = <<<SQL
          SELECT Nome, CPF, Email, Telefone
          FROM Anunciante
          WHERE Codigo = ?
          SQL;
  
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$id]);
  
      $data = $stmt->fetch();

      $name = $data["Nome"];
      $cpf = $data["CPF"];
      $email = $data["Email"];
      $tel = $data["Telefone"];
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
     
    <title>MMX - Tudo ao seu alcance</title>
  </head>
  <body>
    <nav>
      <a href="home.php">HOME</a>
      <?php
          if(isset($id)) {
              echo "<a href='createAd.php'>NOVO ANÚNCIO</a>";
              echo "<a href='myAds.php'>MEUS ANÚNCIOS</a>";
              echo "<a href=''>MENSAGENS</a>";
              echo "<a href='#' class='current_page'>MINHA CONTA</a>";
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
      <div>
        <h2><?php echo isset($id) ? "Minha conta" : "Nova conta" ?></h2>

        <form action="../php/signup.php" method="post" id="signupForm">
          <div>
            <input 
              type="text" 
              name="name" 
              id="name" 
              placeholder="Nome" 
              value="<?php echo $name ?>"
              required
            >
          </div>

          <div>
            <input 
              type="text" 
              name="cpf" 
              id="cpf" 
              placeholder="CPF" 
              value="<?php echo $cpf ?>"
              required
            >
          </div>

          <div>
            <input 
              type="text" 
              name="tel" 
              id="tel" 
              placeholder="Telefone" 
              value="<?php echo $tel ?>"
              required
            >
          </div>

          <div>
            <input 
              type="email"
              name="email" 
              id="email" 
              placeholder="E-mail" 
              value="<?php echo $email ?>"
              <?php echo isset($id) ? "disabled" : "" ?>
              required
            >
            </div>
            
            <div>
              <input
              type="password"
              name="password"
              id="password"
              placeholder="<?php echo isset($id) ? "Nova senha" : "Senha" ?>"
              required
            >
          </div>

          <ul id="errors"></ul>

          <button id="btnSubmit">
            <?php echo isset($id) ? "ALTERAR DADOS" : "CRIAR CONTA"?>
          </button>
        </form>
      </div>
    </main>

    <footer>© 2023 BY SADDEVS INC. ALL RIGHTS RESERVED.</footer>

    <script src="../js/account.js"></script>
  </body>
</html>
