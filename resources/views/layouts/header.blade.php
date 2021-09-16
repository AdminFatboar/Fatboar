<!-- Menu nav -->


<nav class="navbar navbar-expand-lg navbar-light">

<div class="container" > 

<a class="navbar-brand w-25" href="{{route('home')}}">
    <img src="{{asset('/public/assets/images/logo.webp')}}" class="img-fluid w-25" alt="logo burger de fatboar">
</a>


<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>


<div class="collapse navbar-collapse" id="basicExampleNav">


    <ul class="navbar-nav mr-auto">
        @if(Auth::guard('web')->check())
        <li class="nav-item active">
			<a href="{{route('competition')}}" class="nav-link waves-effect">Jeu-concours</a>
		</li>
        @endif
        <!-- <li class="nav-item">
            <a class="nav-link waves-effect">Jeu-concours</a>
        </li> -->
    </ul>
	@if(Auth::guard('web')->check())
    <div class="form-inline">
        <div class="md-form my-0">
            <a href="{{url('/profile')}}" class="btn btn-outline btn-rounded waves-effect border-dark">Espace client</a>
        </div>
    </div>	
	
	@else
	<div class="form-inline">
        <div class="md-form my-0">
            <a href="{{url('/login')}}" class="btn btn-outline btn-rounded waves-effect border-dark">Vérifier votre ticket</a>
        </div>
    </div>
	@endif
</div>

</div>

</nav>