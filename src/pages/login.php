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
      <a href="../php/home.php">HOME</a>
      <a href="login.html" class="current_page">LOGIN</a>
      <a href="signup.html">NOVA CONTA</a>
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
        <h2>Login</h2>

        <form action="../php/login.php" method="post" id="loginForm">
          <div>
            <input type="email" name="email" id="email" placeholder="E-mail" required >
          </div>

          <div>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Senha"
              required
            >
          </div>

          <button id="btnSubmit">ENTRAR</button>
        </form>
      </div>
    </main>

    <footer>© 2023 BY SADDEVS INC. ALL RIGHTS RESERVED.</footer>

    <script src="../js/login.js"></script>
  </body>
</html>
