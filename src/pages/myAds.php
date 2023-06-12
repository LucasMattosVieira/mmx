<?php
    session_start();

    $userID = $_SESSION["userID"];

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="../css/components/footer.css" >
        <link rel="stylesheet" href="../css/global/style.css" >
        <link rel="stylesheet" href="../css/pages/home.css" >
        <link rel="stylesheet" href="../css/style.css" >

        <title>MMX - Tudo ao seu alcance</title>
    </head>
    <body>
        <nav>
            <a href="home.php">HOME</a>
            <a href="createAd.php">NOVO ANÚNCIO</a>
            <a href="#" class="current_page">MEUS ANÚNCIOS</a>
            <a href="messages.php">MENSAGENS</a>
            <a href="account.php">MINHA CONTA</a>
            <a href="../php/logout.php">SAIR</a>
        </nav>

        <header>
            <div id="header_div">
                <img src="../assets/logo_rect.svg" alt="Logo rectangles 1" id="logo_img1" class="logo_rects">
                
                <div id="logo_div">
                    <h1 id="logo">MMX</h1>
                    <h5 id="sub_logo">TUDO AO SEU ALCANCE</h5>
                </div>
                
                <img src="../assets/logo_rect.svg" alt="Logo rectangles 2" id="logo_img2" class="logo_rects">
            </div>
        </header>

        <main class="content">

            <div>
                <h2>Meus anúncios</h2>
            </div>

            <div id="no_results">
                <img src="../assets/error.svg" alt="Error image" id="error_img">
                <h5 id="error_sub">Nenhum anúncio encontrado :(</h5>
            </div>

            <div id="cards"></div>
        </main>
        <footer>
            © 2023 BY SADDEVS INC.
        </footer>

        <script src="../js/fetchMyAds.js"></script>
    </body>
</html>