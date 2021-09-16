<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fatboar | Connexion</title
	<link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="public/assets/plugin/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/mdb.min.css')}}">

    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/query.css">
</head>

<body>

    @include('layouts.header')


    <!-- Connexion -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7 mx-auto">


                <div class="p-3 my-md-5 text-center login-signup-bg rounded">

                    

                        <div class="row">

                            <div class="col-md-9 mx-auto">

                                <div class="card">

                                    <div class="card-body">

                                        <form class="text-center" method="POST" action="{{ route('login') }}">
                                        @csrf
                                            <h3 class="font-weight-bold my-4 pb-2 text-center">Connexion</h3>
											
											<label for="email" class="mb-0 font-weight-bold font-small">E-mail</label>
                                            <input name="email" type="email" class="form-control mb-4" id="email" placeholder="Email">
											
											<label for="password" class="mb-0 font-weight-bold font-small">Mot de passe</label>
                                            <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe">
                                            
                                            <!-- @if (Route::has('password.request'))
                                            <small id="passwordHelpBlock" class="form-text text-right blue-text">
                                                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                            </small>
                                            @endif -->
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-outline-orange btn-rounded my-4 waves-effect">Connexion </button>
                                            </div>

                                            <h4>Ou</h4>

                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-fb"><i class="fab fa-facebook-f pr-1"></i> Facebook</button>
                                                <button type="button" class="btn btn-gplus"><i class="fab fa-google-plus-g pr-1"></i> Google +</button>
                                            </div>

                                            <!-- <div class="login_message">
                                                <p> Vous n’avez pas de compte ? <a href="{{route('register')}}"> S’enregistrer </a> </p>
                                            </div> -->

                                        </form>

                                    </div>

                                </div>
                                
                            </div>

                        </div>

                    

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="/public/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/custom.js"></script>

</body>

</html>