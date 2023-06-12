<?php
    session_start();

    $id = $_SESSION["userID"];

    if(!isset($id)) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            <a href="#" class="current_page">NOVO ANÚNCIO</a>
            <a href="myAds.php">MEUS ANÚNCIOS</a>
            <a href="messages.php">MENSAGENS</a>
            <a href="account.php">MINHA CONTA</a>
            <a href="../php/logout.php">SAIR</a>
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
                <h2>Novo Anúncio</h2>

                <!-- <form action="../php/imagem.php" method="POST" enctype="multipart/form-data" id="formE">

                    <button type="submit">ADICIONAR IMAGEM</button>
                    <div>
                        <input type="file" id="imagem" name="imagem" accept="image/*" placeholder="imagem.jpg">
                    </div>
                    
                </form> -->
                
                <form action="../php/ad.php" method="post" id="createAdForm" enctype="multipart/form-data">

                    <div>
                        <label for="image" id="fileLabel">ADICIONAR IMAGEM</label>
                        <input type="file" id="image" name="image[]" accept="image/*" multiple>
                    </div>

                    <div>
                    <input type="text" name="title" id="title" placeholder="Título" >
                    </div>
        
                    <div>
                    <input type="text" name="descr" id="descr" placeholder="Descrição" >
                    </div>

                    <div>
                        <select name="category" id="category">
                            <option value="" disabled selected>Categoria</option>
                        </select>
                    </div>
        
                    <div>
                    <input type="number" name="price" id="price" placeholder="Preço" >
                    </div>


                    <div>
                        <input type="text" name="cep" id="cep" placeholder="CEP" >
                    </div>


                    <div>
                        <input type="text" name="bairro" id="bairro" placeholder="Bairro" >
                    </div>

                    <div>
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade" >
                    </div>

                    <div>
                        <select name="estado" id="estado">
                            <option value="" disabled selected>Estado</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AM">AM</option>
                            <option value="AP">AP</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MG">MG</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="SC">SC</option>
                            <option value="PR">PR</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RR">RR</option>
                            <option value="RO">RO</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>
        
                    <button type="submit">PUBLICAR</button>
                </form>
            </div>
        </main>

        <footer>© 2023 BY SADDEVS INC.</footer>

        <script src="../js/address.js"></script>
        <script src="../js/categories.js"></script>
    </body>
</html>