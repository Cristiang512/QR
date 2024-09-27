{!!QrCode::size(120)->generate('http://127.0.0.1:8000/visitors/'.$equipment.'/equipment') !!}

<!-- {{$equipment}} -->

<!DOCTYPE html>
<html lang="en">
<img src="../../dist/img/Logo-de-gobierno-escala-de-grises.png"
               alt="alcaldia"
               class="brand-image img-circle elevation-3"
               style="opacity: .8; margin: 0px 5px 0px 60px;" width="130" height="130">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR</title>
    <style>
        .printbutton {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- <h1>Imprimir...</h1> -->
    </br>
    </br>
    </br>
    <input type="button" value="Imprimir" class="printbutton">

    <!-- <p>Lorem ipsum.......</p>
    
    <p>
        <img src="https://via.placeholder.com/36" alt="imprimir" class="printbutton">
    </p> -->

    <script>
        document.querySelectorAll('.printbutton').forEach(function(element) {
            element.addEventListener('click', function() {
                print();
            });
        });
    </script>
</body>
</html>