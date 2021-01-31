<!DOCTYPE html>
<html>
<head>
    <title>24Slides Catering App</title>
     <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <style type="text/css">
      body,html{
        font-family: 'Poppins', sans-serif;
        background-color: transparent;
      }
    </style>
</head>
<body>
  <div class="app min-w-screen min-h-screen bg-grey-lighter py-8 px-4">

    <div class="max-w-md mx-auto">

      <div class="bg-white p-8 shadow-md">

        <div class="h-28 flex flex-col items-center justify-center text-center tracking-wide leading-normal bg-black -mx-8 -mt-8" style="background: linear-gradient( rgb(0 0 0 / 45%), rgb(60 68 80) ),url('https://assets.kompasiana.com/items/album/2018/04/16/suasana-kantor-24slides-indonesia-3-5ad4a44bcaf7db40dd0deff2.jpg?t=o&v=760');background-size:cover;">
          
          <p class="text-white text-2xl">New Account Registered !</p>
        </div>

        <div class="py-8 border-b">
          <p>
            Hey Jakub !<br><br>
            Congratulations , your account has been successfully created<br>        
            Now you can use this catering application by entering the following email and password<br><br>
            This your password  <b>{{$data['password']}}</b> <br><br> 
            You can also change it on the profile view on the web page  
          </p>
          <button class="text-white text-sm tracking-wide bg-blue-500 rounded w-full my-8 p-4 font-semibold">ACTIVED YOUR ACCOUNT</button>
          <p class="text-sm">
            Best Regard !<br>
            Your The App team
          </p>
        </div>

        <div class="mt-8 text-center text-gray-600">
          <h3 class="text-base sm:text-lg mb-4">Thanks for using Catering App!</h3>
          <img class="h-10 mx-auto" src="{{ asset('resources/image/logo2.png')}}" alt="24Slides Logo" >
        </div>

      </div>

      <div class="text-center text-sm text-grey-darker mt-8">

        <div class="meta__social flex justify-center my-4">
          <a href="#" class="flex items-center justify-center mr-4 bg-red-500 text-white rounded-full w-8 h-8 no-underline"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="flex items-center justify-center mr-4 bg-red-500 text-white rounded-full w-8 h-8 no-underline"><i class="fab fa-instagram"></i></a>
          <a href="#" class="flex items-center justify-center bg-red-500 text-white rounded-full w-8 h-8 no-underline"><i class="fab fa-twitter"></i></a>
        </div>

        <div class="">
          <p class="leading-loose">
            Questions or concerns? <a href="#" class="text-grey-darkest">help@24slides.com</a>

            
          </p>
        </div>

      </div>


    </div>

  </div>

</body>
</html>