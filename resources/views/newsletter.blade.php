<!DOCTYPE html>
<html>
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
    <h4>Newsletter</h4>
        <hr>
        <form method="post" action="{{url('profile/newsletter')}}">
            @csrf
            <div class="row">
                <div class="col-md-4"></div>
                    <div class="form-group col-md-2">
                        <label for="Email">Email:</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>   
                <div class="row">
                    <div class="col-md-4"></div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>    
        </form>
    </body>
</html>

<script type="text/javascript" src="/public/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/assets/js/popper.min.js"></script>
<script type="text/javascript" src="/public/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/public/assets/js/mdb.min.js"></script>
<script type="text/javascript" src="/public/assets/js/custom.js"></script>
<script type="text/javascript" src="/public/assets/js/bootbox.js"></script>