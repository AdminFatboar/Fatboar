<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Administration</title>
	<link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="/public/assets/plugin/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/mdb.min.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link rel="stylesheet" href="/public/assets/css/query.css">
</head>
<body>

    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-9">
                <div class="row">
                    <div class="col-md-4 p-4 border">
                    <h4>Tableau de bord</h4>
                    <hr>
                        <ul class="nav nav-pills flex-column " id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-draw-tab" data-toggle="pill" href="#pills-draw" role="tab" aria-controls="pills-draw" aria-selected="true">Tirage au sort</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-stats-tab" data-toggle="pill" href="#pills-stats" role="tab" aria-controls="pills-stats" aria-selected="false">Statistiques du jeu-concours</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-users-tab" data-toggle="pill" href="#pills-users" role="tab" aria-controls="pills-users" aria-selected="false">Gestion des utilisateurs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-admin-tab" data-toggle="pill" href="#pills-admin" role="tab" aria-controls="pills-admin" aria-selected="false">Gestion de l'administration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('kpi')}}" target="_blank">KPI & Métriques</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin/export')}}">Extraction de données</a>
                            </li>
                            <li class="nav-item mt-5">
                                <a class="nav-link active" href="{{route('logout')}}">Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                        
                    
                    <div class="col-md-8">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active p-4 border" id="pills-draw" role="tabpanel" aria-labelledby="pills-draw-tab">
                                @if (session('status'))
                                <div class="alert alert-danger">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="d-flex justify-content-around align-items-center pb-3 border-bottom">
                                    <form action="{{route('admin.draw')}}" method="post">
                                        @csrf
                                        <p class="mb-0 font-small">Lancer le tirage au sort final</p>
                                        <button type="submit" class="btn btn-warning" @if($ticket) disabled @endif>Tirage aléatoire</button>
                                        @if($ticket)
                                        <button type="button" class="btn btn-danger" id="delete_stats">Réinitialiser le tirage</button>
                                        @endif
                                    </form>
                                </div>
                                <div class="py-2 text-center">
                                    <span></span>
                                </div>
                                <div class="py-3 text-center">
                                    <h6 class="font-small">Gagnant</h6>
                                </div>
                                <div class="py-2">
                                    <form action="">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label font-small">Nom d'utilisateur</label>
                                            <div class="col-sm-6">
                                                <input readonly type="text" id="name" class="form-control" name="name" @if($ticket && $ticket->user->name) value="{{$ticket->user->name}}" @endif>
                                            </div>
                                            
                                            <label for="email" class="col-sm-4 col-form-label font-small">Email</label>
                                            <div class="col-sm-6">
                                                <input readonly type="text" id="email" class="form-control" name="email" @if($ticket && $ticket->user->email) value="{{$ticket->user->email}}" @endif>
                                            </div>
                                        </div>

                                    </form>
                                    
                                </div>
                               
                            </div>
                            
                            <div class="tab-pane fade p-4 border" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nom</th>
											<th scope="col">Prénom</th>
                                            <th scope="col">Gain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($win_results as $result)
                                        <tr>
                                            <th>{{$result->id}}</th>
                                            <td>{{$result->email}}</td>
                                            <td>{{$result->name}}</td>
                                            <td>{{$result->lastname}}</td>
                                            <td>{{$result->ticket_count}}</td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>

                                <a href="#" id="delete_stats" class="btn btn-danger">Réinitialiser les statistiques</a>
                            </div>

                            <div class="tab-pane fade p-4 border" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>Utilisateurs</h3>
                                    </div>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Date création</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $result)
                                        <tr>
                                            <th>{{$result->id}}</th>
                                            <td>{{$result->email}}</td>
                                            <td>{{$result->name}}</td>
                                            <td>{{$result->created_at}}</td>

                                            <td><button class="btn btn-outline-danger btn-sm deleteUser" data-id="{{$result->id}}" data-type="user"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            
                            
                            <div class="tab-pane fade p-4 border {{ old('pills-admin') }}" id="pills-admin" role="tabpanel" aria-labelledby="pills-admin-tab">
                            <div class="row">
                            @if(Session::has('the_pass_employer'))
                            <div class="alert alert-success">
                                Employé créé avec succès.
                            </div>
                            @endif

                            @if(Session::has('the_pass_admin'))
                            <div class="alert alert-success">
                                Admin créé avec succès.
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                                <div class="col-md-9">
                                    <h3>Employés</h3>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createEmployerModal"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nom</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employers as $result)
                                    <tr>
                                        <th>{{$result->id}}</th>
                                        <td>{{$result->email}}</td>
                                        <td>{{$result->name}}</td>
                                        <td><button class="btn btn-outline-danger btn-sm deleteUser" data-id="{{$result->id}}" data-type="employer"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>

                            <div class="row mt-5">
                                <div class="col-md-9">
                                    <h3>Admins</h3>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createAdminModal"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nom</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins  as $result)
                                    <tr>
                                        <th>{{$result->id}}</th>
                                        <td>{{$result->email}}</td>
                                        <td>{{$result->name}}</td>
                                        <td>
                                            @if($result->id != Session::get('auth_user_id'))
                                                <button class="btn btn-outline-danger btn-sm deleteUser" data-id="{{$result->id}}" data-type="admin"><i class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
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

    <div class="modal fade" id="createEmployerModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Ajouter un employé</h5>
                </div>
                <form action="{{ route('admin.createEmployer') }}" class="row" name="createEmployee" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="email">E-Mail de l'employé</label>
                            <input type="text" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Nom de l'employé</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">Mot de passe de l'employé</label>
                            <input type="text" id="password" name="password" class="form-control" required>
                            <small class="text-muted">Le mot de passe doit contenir au minimum une majuscule, une minuscule, un caractère spécial et doit faire au minimum 8 caractères.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Ajouter un administrateur</h5>
                </div>
                <form action="{{ route('admin.createAdmin') }}" class="row" name="createEmployee" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="email_e">E-Mail de l'administrateur</label>
                            <input type="text" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name_e">Nom de l'administrateur</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password_e">Mot de passe de l'administrateur</label>
                            <input type="text" id="password_e" name="password" class="form-control" required>
                            <small class="text-muted">Le mot de passe doit contenir au minimum une majuscule, une minuscule, un caractère spécial et doit faire au minimum 8 caractères.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/public/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/custom.js"></script>
    <script type="text/javascript" src="/public/assets/js/bootbox.js"></script>

    <script>
        $('#delete_stats').click(function(){
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
                            $.post('/admin/reset-stats', {
                                _token: '{{ csrf_token() }}'
                            }).then(function(data){
                                if(data.success)
                                    document.location.reload();
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


        $('#reset_tirage').click(function(){
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
                            $.post('/admin/reset-tirage', {
                                _token: '{{ csrf_token() }}'
                            }).then(function(data){
                                if(data.success)
                                    document.location.reload();
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

        $('.deleteUser').click(function(){
            var type = $(this).attr('data-type');
            var id = $(this).attr('data-id');
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
                            $.post('/admin/delete-' + type, {
                                _token: '{{ csrf_token() }}',
                                id: id
                            }).then(function(data){
                                if(data.success)
                                    document.location.reload();
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

        $(document).ready(function () {
        $('#pills-tab a[href="#{{ old('tab') }}"]').tab('show')
        });

    </script>
</body>

</html>		