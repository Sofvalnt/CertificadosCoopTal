<x-guest-layout>
    
     <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #005A47;">
     <section class="h-100 gradient-form" style="background-color: #005A47;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">  
         </nav>          

         <x-button class="ms-4">
                    @if (Route::has('register'))
                                <a href="{{ route('register') }}">¿No tienes cuenta? Registrate</a>
                            @endif
                            </x-button>

    <x-authentication-card>
        <x-slot name="logo">
        <div class="text-center">
                <img src="build/assets/logo.png" style="width: 185px; center" alt= "logo" > 
                </div>
            <x-authentication-card-logo />
        </x-slot>


        <h1 align= "center" class="mt-8 text-2xl font-medium text-gray-900">Contraseña incorrecta </h1>

        <x-button class="ms-4">
                    @if (Route::has('register'))
                                <a href="{{ route('register') }}">¿No tienes cuenta? Registrate</a>
                            @endif
                            </x-button>


        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

                              </div>
                       </div>
                   </div>
                 </div>
             </div>
           </div>
        </div>

    </section>
</x-guest-layout>
