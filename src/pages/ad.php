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
    <link rel="stylesheet" href="../css/components/modal.css" >
    <link rel="stylesheet" href="../css/global/style.css" >
    <link rel="stylesheet" href="../css/style.css" >

    <link rel="stylesheet" href="../css/pages/ad.css">

    <title>MMX - Tudo ao seu alcance</title>
  </head>
  <body>
    <nav>
      <?php
          if(isset($userID)) {
              echo "<a href='home.php'>HOME</a>";
              echo "<a href='createAd.php'>NOVO ANÚNCIO</a>";
              echo "<a href=''>MEUS ANÚNCIOS</a>";
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
      <aside>
        <p id="price" class="price"></p>

        <div class="carousel">
          <button type="button" id="previous">
            <svg xmlns:xlink="http://www.w3.org/1999/xlink" width="24" xmlns="http://www.w3.org/2000/svg" height="24" id="screenshot-89822874-17e9-8064-8002-5ca639eb6005" viewBox="0 0 24 24" style="-webkit-print-color-adjust: exact;" fill="none" version="1.1"><g id="shape-89822874-17e9-8064-8002-5ca639eb6005" width="24" height="24" rx="0" ry="0" style="fill: rgb(0, 0, 0);"><g id="shape-89822874-17e9-8064-8002-5ca639eb6007"><g class="fills" id="fills-89822874-17e9-8064-8002-5ca639eb6007"><path fill="rgba(0,0,0,1)" rx="0" ry="0" d="M10.828,12.001L15.778,16.950L14.364,18.365L8.000,12.001L14.364,5.637L15.778,7.051L10.828,12.001ZZ" style="fill: currentColor;"></g></g></g></svg>
          </button>

          <img src="../assets/demo.jpg" alt="demo">

          <button type="button" id="next">
            <svg xmlns:xlink="http://www.w3.org/1999/xlink" width="24" xmlns="http://www.w3.org/2000/svg" height="24" id="screenshot-89822874-17e9-8064-8002-5ca639eb6001" viewBox="0 0 24 24" style="-webkit-print-color-adjust: exact;" fill="none" version="1.1"><g id="shape-89822874-17e9-8064-8002-5ca639eb6001" width="24" height="24" rx="0" ry="0" style="fill: rgb(0, 0, 0);"><g id="shape-89822874-17e9-8064-8002-5ca639eb6003"><g class="fills" id="fills-89822874-17e9-8064-8002-5ca639eb6003"><path rx="0" ry="0" d="M13.171,12.001L8.222,7.051L9.636,5.637L16.000,12.001L9.636,18.365L8.222,16.950L13.171,12.001ZZ" style="fill: currentColor;"></g></g></g></svg>
          </button>
        </div>

        <address>
          <?php echo $data["CEP"] ?>
          <br>
          <?php echo $data["Bairro"] ?>
          <br>
          <?php echo $data["Cidade"] ?>
          <br>
          <?php echo $data["Estado"] ?>
        </address>
      </aside>

      <section>
        <h2>
          <?php echo $data["Titulo"] ?>
        </h2>
        
        <h3 id="metadata"></h3>
        
        <p>
          <?php echo $data["Descricao"] ?>
        </p>
      </section>
    </main>

    <footer>
      © 2023 by SadDevs Corp. All rights reserved.
    </footer>

    <div class="modal">
      <div class="modalContent">
        <button type="button" class="btnClose">
          <svg xmlns:xlink="http://www.w3.org/1999/xlink" width="12.728" xmlns="http://www.w3.org/2000/svg" height="12.728" id="screenshot-89822874-17e9-8064-8002-5ca8174ee628" viewBox="11039.637 2218.137 12.728 12.728" style="-webkit-print-color-adjust: exact;" fill="none" version="1.1"><g id="shape-89822874-17e9-8064-8002-5ca8174ee628"><g class="fills" id="fills-89822874-17e9-8064-8002-5ca8174ee628"><path rx="0" ry="0" d="M11046.001,2223.086L11050.950,2218.137L11052.365,2219.551L11047.415,2224.501L11052.365,2229.450L11050.950,2230.865L11046.001,2225.915L11041.051,2230.865L11039.637,2229.450L11044.586,2224.501L11039.637,2219.551L11041.051,2218.137L11046.001,2223.086ZZ" style="fill: rgb(0, 0, 0);"/></g></g></svg>
        </button>
  
        <h2 class="title">Registrar interesse</h2>

        <form action="">
          <div>
            <input type="text" placeholder="Contato">
          </div>
  
          <div>
            <textarea placeholder="Mensagem"></textarea>          
          </div>
  
          <button>Enviar</button>
        </form>
      </div>
    </div>

    <script>
      const metadata = document.getElementById("metadata");
      const date = new Date('<?php echo $data["DataHora"] ?>');
      metadata.textContent = `${`${date.getDate()}`.padStart(2, "0")}/${`${date.getMonth() + 1}`.padStart(2, "0")}/${date.getFullYear()} às ${`${date.getHours()}`.padStart(2, "0")}h${`${date.getMinutes()}`.padStart(2, "0")}min por <?php echo $advertiser["Nome"] ?>`
    
      const priceTag = document.getElementById("price");
      const price = Number('<?php echo $data["Preco"]?>');
      let formattedIntValue = Math.floor(price).toString().split("");

      for(let i = price.toString().length - 3 - 3; i > 0; i -= 3) {
        formattedIntValue.splice(i, 0, ".");
      }

      priceTag.innerHTML = `R$ ${formattedIntValue.join("")},<span>${((price % 1) * 100).toFixed(0)}</span>`;
    </script>
  </body>
</html>
