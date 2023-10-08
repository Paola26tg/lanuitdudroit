<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation à la Nuit du Droit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .invitation {
            max-width: 600px;
            /*margin: 50px auto;*/
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            max-width: 100px;
            margin-bottom: 20px;
        }

        .qr-code {
            max-width: 200px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="invitation">
    <img src="{{url('users/img/logo.png')}}" alt="Logo Nuit du Droit" class="logo">
    <h2>Invitation à la Nuit du Droit</h2>
    <p>Nous sommes ravis de vous informer que votre réservation pour l'événement "La Nuit du Droit" a été définitivement confirmée. Nous sommes impatients de vous accueillir le 18 Novembre à 17H à l'hôtel SARAKAWA.


    <p>Cordialement</p>
    <p>L'equipe de la NDD</p>
    <p>Participant: <b style="font-size: 25px">{{$name}}</b></p>
    <div class="card-body" style="margin-top: 2rem">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate('['.$reference.'] '.$name)) !!} ">
    </div>
    <p>Parrain de l'événement:</p>
    <img src="{{url('users/img/logo_parrain.jpeg')}}" alt="Logo Parrain" class="logo">

    <p class="signature">Copyright ©2023 All rights reserved | Powered By BIZIYEE TECHNOLOGIE & COMMUNICATION</p>
</div>

</body>
</html>
