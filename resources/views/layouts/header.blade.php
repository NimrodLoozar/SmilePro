 <header class="bg-blue-800 text-white shadow-md">
     <div class="container mx-auto flex justify-between items-center py-4 px-6">
         <div>
             <h1 class="text-2xl font-bold">SmilePro</h1>
             <p class="text-sm italic">Uw glimlach, onze zorg</p>
         </div>
         @if (Route::has('login'))
             <nav class="-mx-3 flex flex-1 justify-end">
                 @auth
                     <a href="{{ url('/dashboard') }}"
                         class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                         Dashboard
                     </a>
                 @else
                     <a href="{{ route('login') }}"
                         class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                         Log in
                     </a>

                     @if (Route::has('register'))
                         <a href="{{ route('register') }}"
                             class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                             Register
                         </a>
                     @endif
                 @endauth
             </nav>
         @endif

     </div>
 </header>
 <!-- Header -->
