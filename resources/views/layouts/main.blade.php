<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield("title")</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="#">Quotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-5">
              @if(Auth::guest())
                <a class="nav-link active" href="{{route("login")}}">Login</a>
                <a class="nav-link active" href="{{route("register")}}">Register</a>
              @endif
              @if(Auth::user())
                <div class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Notifications 
                      <span class="badge bg-secondary">{{Auth::user()->notifications->where("seen",0)->count()}}</span>
                    </a>
                    <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                      @if(Auth::user()->getNotifications()->count() > 0 )
                        @foreach (Auth::user()->getNotifications() as $notif)
                          <li class="text-center  pb-3  mt-2" style="width:400px;">
                            <a href="/quotes/{{$notif->quote->slug}}" class="pb-2 border-2 border-bottom border-primary text-decoration-none text-black">
                              {{$notif->subject." in quote ".$notif->quote->title}}
                            </a>
                          </li>
                        @endforeach
                        <a onclick="return confirm('Are you sure you want to mark all as read?')" href="/notification" class="float-end me-3 text-decoration-none" style="cursor: pointer" >mark read</a>
                      @else
                          <p class="text-center">no notification</p>
                      @endif
                    </ul>
                </div>
                <a class="nav-link active" href="/profile">Profile</a>
              @endif
              <a class="nav-link active" href="{{url("/quotes")}}">Home</a>
            </div>
          </div>
        </div>
      </nav>
      @yield("container")
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="/js/script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>