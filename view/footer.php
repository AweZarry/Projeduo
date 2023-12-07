<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            position: relative;
        }

        .main-content {
            margin-bottom: 50px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            width: 100%;
            padding: 10px 0;
        }

        .contatos {
            padding: 20px;
        }

        .contato-info {
            display: flex;
            justify-content: center;
            flex-direction: row;
        }

        .contato-item {
            margin-right: 20px;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            background: linear-gradient(to right, #FFC0CB, #87CEFA);
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #fff;
        }

        .contato-img {
            position: relative;
            top: 4px;
            left: 1px;
        }

        .contatos h2 {
            background-image: linear-gradient(to right, aliceblue, black, red, black, aliceblue);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
            font-size: 24px;
            padding: 10px 10px;
        }

        .contatos p {
            color: aliceblue;
            display: block;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .adicionais {
            padding: 20px;
        }

        .adicionais h1,
        .adicionais h2 {
            background-image: linear-gradient(to right, aliceblue, black, red, black, aliceblue);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
            font-size: 24px;
            padding: 10px 10px;
            margin-bottom: 10px;
        }

        .adicionais p {
            color: aliceblue;
            display: block;
            font-size: 20px;
            line-height: 1.5;
        }

        .container {
            padding: 10px;
        }
    </style>
</head>

<body>
    <footer>
        <div class="contatos">
            <h2>Entre em Contato</h2>
            <p>Se você tiver alguma dúvida ou precisar de suporte, sinta-se à vontade para entrar em contato conosco.
            </p>
            <div class="contato-info">
                <a class="contato-item"><img class="contato-imgs" src="../public/img/dc.png" alt=""></a>
                <a class="contato-item"><img class="contato-imgs" src="../public/img/email.png" alt=""></a>
                <a class="contato-item"><img class="contato-img" src="../public/img/insta.png" alt=""></a>
            </div>
        </div>

        <div class="adicionais" id="sobre">
            <h1>Sobre nós</h1>
            <h2>Seu Destino para Dicas de Jogos para Iniciantes!</h2>
            <p>Bem-vindo à Eagle Games, seu refúgio amigável no vasto universo dos jogos!<br> Aqui, nos dedicamos
                apaixonadamente a ajudar iniciantes a encontrar seu caminho no emocionante mundo dos jogos digitais.<br>
                Se você está apenas começando sua jornada como jogador ou se sente um pouco perdido em meio a tantas
                opções, você veio ao lugar certo.</p>
        </div>
        <div class="container">
            <p>&copy;
                <?php echo date("Y"); ?> Eagle Games. Todos os direitos reservados.
            </p>
        </div>
    </footer>
</body>