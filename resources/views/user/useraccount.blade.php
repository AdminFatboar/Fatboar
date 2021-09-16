<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fatboar | Compte utilisateur</title>
	<link rel="icon" href="public/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/plugin/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/mdb.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/query.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>

<body>

    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-personal-tab" data-toggle="pill" href="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="true">Informations personnelles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-earning-tab" data-toggle="pill" href="#pills-earning" role="tab" aria-controls="pills-earning" aria-selected="false">Gains obtenus</a>
                            </li>
                            
                            <li class="nav-item mt-5">
                                <a class="nav-link active" href="{{route('logout')}}">Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-8">
                        <div class="tab-content p-4 border" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Votre profil</h4>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{route('user.profile')}}" method="post">
                                        @csrf
                                            <div class="form-group row">
                                                <label for="username" class="col-4 col-form-label">Nom d’utilisateur *</label>
                                                <div class="col-8">
                                                    <input id="name" name="name" placeholder="Username" class="form-control here" required="required" type="text" readonly value="{{Auth::user()->name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-4 col-form-label">Prénom</label>
                                                <div class="col-8">
                                                    <input id="firstname" name="firstname"  pattern="[a-zA-Z]*" oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" placeholder="Prénom" class="form-control here" type="text" @if(Auth::user()->firstname) value="{{Auth::user()->firstname}}" @endif>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lastname" class="col-4 col-form-label">Nom</label>
                                                <div class="col-8">
                                                    <input id="lastname" name="lastname"  pattern="[a-zA-Z]*" oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" placeholder="Nom de famille" class="form-control here" type="text" @if(Auth::user()->lastname) value="{{Auth::user()->lastname}}" @endif>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-4 col-form-label">Email *</label>
                                                <div class="col-8">
                                                    <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text" readonly value="{{Auth::user()->email}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="newpass" class="col-4 col-form-label">Nouveau mot de passe</label>
                                                <div class="col-8">
                                                    <input id="password" minlength="8" name="mot de passe" placeholder="Nouveau mot de passe" class="form-control here" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-4 col-8">
                                                    <button name="submit" type="submit" class="btn btn-warning">Mettre à jour</button>
                                                </div>
                                            </div>        
                                        </form>

                                        <a href="#" id="delete_account" class="btn btn-danger">Supprimer mon compte</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-earning" role="tabpanel" aria-labelledby="pills-earning-tab">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ticket Id</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Gain</th>
                                            <th scope="col">QR PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Auth::user()->tickets->where('is_rewarded',false) as $ticket)
                                        <tr>
                                            <th>{{$ticket->id}}</th>
                                            <td>{{$ticket->user->email}}</td>
                                            <td>{{$ticket->user->name}}</td>
                                            <td>{{$ticket->reward->name}}</td>
                                            <td><a href="public/uploads/QR.pdf" download><i class="fa fa-file-pdf fa-1.5x" aria-hidden="true"></i></td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    
  
    <script type="text/javascript" src="/public/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/custom.js"></script>
    <script type="text/javascript" src="/public/assets/js/bootbox.js"></script>
    
    <script>
        $('#delete_account').click(function(){
            var dialog = bootbox.dialog({
                title: 'Êtes-vous sûr ?',
                message: `<p class="h1 text-warning text-center"><i class="fas fa-exclamation-circle"></i></p>
                Cette action est irreversible.
                `,
                buttons: {
                    ok: {
                        label: "Continuer",
                        className: 'btn-danger btn-sm',
                        callback: function(){
                            $.post('/profile/delete', {
                                _token: '{{ csrf_token() }}'
                            }).then(function(data){
                                if(data.success)
                                    location.href = '{{ route('home') }}';
                            });
                            return false;
                        }
                    },
                    cancel: {
                        label: "Annuler",
                        className: 'btn-primary btn-sm'
                    }
                }
            });
        });
    </script>
</body>

</html>		