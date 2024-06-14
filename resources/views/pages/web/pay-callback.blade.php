<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paiement</title>
    @include('files.css')
</head>
<body>
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-10 mx-auto">
                <div class="jumbotron text-center">
                    @if ($success)
                        <i class="fa fa-check-circle text-success" style="font-size: 100px"></i>
                        <h1>Votre transaction a réusie !</h1>
                        <h4>Rérence : {{ $tref }}</h4>
                        <h4>Montant : {{ $montant }}</h4>
                    @endif
                    @if ($cancel)
                        <i class="fa fa-times-circle text-danger" style="font-size: 100px"></i>
                        <h1>Votre transaction a été annulée !</h1>
                        <h4>Rérence : {{ $tref }}</h4>
                        <h4>Montant : {{ $montant }}</h4>
                    @endif
                    @if ($decline)
                        <i class="fa fa-times-circle text-danger" style="font-size: 100px"></i>
                        <h1>Votre transaction est rejetée ! Vérifiez votre carte bancaire ou utilisez une autre.</h1>
                    @endif
                    <br>
                    <h6 class="text-danger font-italic">Veuillez fermer cette page.</h6>
                </div>
            </div>
        </div>
    </div>>
</body>
</html>
