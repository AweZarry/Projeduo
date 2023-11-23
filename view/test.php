<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roda com Mudança Gradual de Cor e Background</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #roda {
            width: 30px;
            height: 30px;
            background: black;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: aliceblue;
            font-weight: bold;
        }

        #rodagradi {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            border: 2px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #entrada {
            width: 200px;
            height: 100px;
            padding: 5px;
            position: relative;
        }
    </style>
</head>

<body>
    <textarea id="entrada" oninput="atualizarRoda()"></textarea>
    <div id="rodagradi">
        <div id="roda">0</div>
    </div>
    <script src="../public/js/test/test.js"></script>
</body>

</html>