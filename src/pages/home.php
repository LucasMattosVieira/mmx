<?php
    session_start();

    $isLoggedIn = false;

    if(isset($_SESSION["userID"])) {  
        $isLoggedIn = true;
    } else {
        session_unset();
        session_destroy();
    }
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
            <a href="#" class="current_page">HOME</a>
            <?php
                if($isLoggedIn) {
                    echo "<a href='createAd.php'>NOVO ANÚNCIO</a>";
                    echo "<a href=''>MEUS ANÚNCIOS</a>";
                    echo "<a href=''>MENSAGENS</a>";
                    echo "<a href='account.php'>MINHA CONTA</a>";
                    echo "<a href='../php/logout.php'>SAIR</a>";
                }
                else {
                    echo "<a href='login.php'>LOGIN</a>";
                    echo "<a href='account.php'>NOVA CONTA</a>";
                }
            ?>
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
            <div class="filters">
                <div id="simple_filter">
                    <h2>Filtro</h2>
    
                    <button type="button" id="setAdvanced" class="filter_btn">SIMPLES</button>
    
                    <form action="" id="simpleForm">
                        <div>
                            <input type="text" name="title" id="title" placeholder="Título">
                        </div>
                        
                        <button>PESQUISAR</button>
                    </form>
                </div>
    
                <div id="advanced_filter">
                    <h2>Filtro</h2>
                    <button type="button" id="setSimple" class="filter_btn">AVANÇADO</button>
    
                    <form action="" id="advForm">
                        <div>
                            <input type="text" name="title" id="title" placeholder="Título">
                        </div>
                        <div>
                            <input type="text" name="description" id="description" placeholder="Descrição">
                        </div>
                        <div>
                            <select name="category" id="category">
                                <option value="" disabled selected>Categoria</option>
                            </select>
                        </div>
                        <div>
                            <input type="text" name="min_price" id="min_price" class="price" placeholder="Preço mínimo">
                            <input type="text" name="max_price" id="max_price" class="price" placeholder="Preço máximo">
                        </div>
                        <button>PESQUISAR</button>
                    </form>
                </div>
            </div>

            <div id="start_search">
                <img src="../assets/search.svg" alt="Search image" id="search_img">
                <h5 id="search_sub">Comece a pesquisar!</h5>
            </div>

            <div id="no_results">
                <img src="../assets/error.svg" alt="Error image" id="error_img">
                <h5 id="error_sub">Nenhum anúncio encontrado :(</h5>
            </div>

            <div id="cards"></div>
        </main>
        <footer>
            © 2023 BY SADDEVS INC. ALL RIGHTS RESERVED.
        </footer>

        <script src="../js/script.js"></script>
        <script src="../js/categories.js"></script>
    </body>
</html>