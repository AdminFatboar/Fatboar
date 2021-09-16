<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fatboar | Employé</title>
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
                    <div class="col-md-4">
                        <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-draw-tab" data-toggle="pill" href="#pills-draw" role="tab" aria-controls="pills-draw" aria-selected="true">Remettre un gain</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-stats-tab" data-toggle="pill" href="#pills-stats" role="tab" aria-controls="pills-stats" aria-selected="false">Historique des clients</a>
                            </li>
                            <li class="nav-item mt-5">
                                <a class="nav-link active" href="{{route('logout')}}">Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content p-4 border" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-draw" role="tabpanel" aria-labelledby="pills-draw-tab">
                                <div class="d-flex justify-content-around align-items-center pb-3 border-bottom">
                                    <p class="mb-0 font-small mx-auto">Remettre un gain</p>
                                </div>
                                <div class="py-3 text-center">
                                    <h6 class="font-small">Gagnants</h6>
                                </div>
                                <div class="py-2">
                                    <form id="form1" action="{{route('employer.validate')}}" method="post">
                                        @csrf
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Ticket Id</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Prix</th>
                                                    <th scope="col">Validé?</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tickets as $key=>$ticket)

                                                <tr id="row{{$key}}">

                                                    <input id="is{{$key}}" class="is" type="hidden" name="is_this_ticket[]" value="0">
                                                    <input name="ticket_id[]" type="hidden" name="ticket_id" value="{{$ticket->id}}">

                                                    <td>{{$ticket->id}}</td>
                                                    <td>{{$ticket->user->email}}</td>
                                                    <td>{{$ticket->reward->name}}</td>
                                                    @if(!$ticket->is_rewarded)
                                                    <td>Non</td>
                                                    @else
                                                    <td>Oui</td>
                                                    @endif

                                                    @if(!$ticket->is_rewarded)
                                                    <td><button id="btn{{$key}}" onclick="event.preventDefault(); setval({{$key}})" type="submit" class="btn btn-warning m-0 btn-sm">Valider</button></td>
                                                    @else
                                                    <td></td>
                                                    @endif

                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
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

                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">Est
                                quis nulla laborum officia ad nisi ex nostrud culpa Lorem excepteur aliquip dolor aliqua irure ex.
                                Nulla ut duis ipsum nisi elit fugiat commodo sunt reprehenderit laborum veniam eu veniam. Eiusmod minim
                                exercitation fugiat irure ex labore incididunt do fugiat commodo aliquip sit id deserunt reprehenderit
                                aliquip nostrud. Amet ex cupidatat excepteur aute veniam incididunt mollit cupidatat esse irure officia
                                elit do ipsum ullamco Lorem. Ullamco ut ad minim do mollit labore ipsum laboris ipsum commodo sunt
                                tempor enim incididunt. Commodo quis sunt dolore aliquip aute tempor irure magna enim minim
                                reprehenderit. Ullamco consectetur culpa veniam sint cillum aliqua incididunt velit ullamco sunt
                                ullamco quis quis commodo voluptate. Mollit nulla nostrud adipisicing aliqua cupidatat aliqua pariatur
                                mollit voluptate voluptate consequat non.</div>
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


    <script>
            var setval;
        $(document).ready(function() {
            /* $(".submit").click(function(e) {
                e.preventDefault();

                var btnid = $(this).attr(id);
                var id = btnid.substring(3);
                $('#is'.id).text('1');

                // $('#is'.id).val(1);
                // alert("hello");

            }); */

            setval = function(id)
            {
                $('#is'+id).val('1');
                $('#form1').submit();

            }
        });
    </script>

</body>

</html>