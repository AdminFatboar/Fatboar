<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fatboar | Inscription</title>
	<meta name="description" content="Inscrivez-vous afin de participer au jeu-concours de Fatboar et d'avoir la chance de remporter un Range Rover">
	<link rel="icon" href="public/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/plugin/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/mdb.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/query.css">
</head>

<body>

    @include('layouts.header')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7 mx-auto">


                <div class="p-3 my-md-5 text-center login-signup-bg rounded">

                    


                        <div class="row">

                            <div class="col-md-9 mx-auto">

                                <div class="card">

                                    <div class="card-body">

                                        <form class="text-center" method="POST" action="{{ route('register') }}">
                                            
                                            @csrf
                                            <h3 class="font-weight-bold my-4 pb-2 text-center">S’inscrire</h3>
											
											<label for="name" class="form-label">Nom d'utilisateur</label>
                                            <input name="name" type="text" class="@error('name') is-invalid @enderror form-control mb-4" id="name" placeholder="Entrez votre nom d'utilisateur">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
											<label for="emailreg" class="form-label">E-mail</label>
                                            <input name="email" type="text" class="@error('email') is-invalid @enderror form-control mb-4" id="emailreg" placeholder="Entrez votre e-mail">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
											<label for="passwordreg" class="form-label">Mot de passe</label>
                                            <input name="password" type="password" class="@error('password') is-invalid @enderror form-control" id="passwordreg" placeholder="Entrez votre mot de passe">
                                            <p class="text-muted small mb-4">Le mot de passe doit contenir au minimum une majuscule, une minuscule, un caractère spécial et doit faire au minimum 8 caractères.</p>
                                            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
											<label for="password-confirm" class="form-label">Confirmez votre mot de passe</label>
                                            <input id="password-confirm" type="password" class="@error('password') is-invalid @enderror form-control mb-4" id="password-confirm" placeholder="Entrez de nouveau votre mot de passe" name="password_confirmation" >
											<label for="checkbox">
												<input id="checkbox" type="checkbox" class="@error('checkbox') is-invalid @enderror" >  J'accepte <a href="{{route('cgu')}}" target="_blank"><u>les conditions d'utilisation</u></a>
											</label>

                                         
											
											

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-outline-orange btn-rounded my-3 waves-effect">S’inscrire</button>
                                            </div>

                                            <h4>Ou</h4>

                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-fb"><i class="fab fa-facebook-f pr-1"></i> Facebook</button>
                                                <button type="button" class="btn btn-gplus"><i class="fab fa-google-plus-g pr-1"></i> Google +</button>
                                            </div>

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