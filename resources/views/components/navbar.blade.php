<nav class="main-navbar">
  <div class="container_logo">
    <a href="" class="logo">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#8DF1F8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart">
        <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
      </svg>
      Portal de la Información sobre el TCA
    </a>
  </div>
  <!-- Botón hamburguesa responsive -->
  <div class="hamburger">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <ul class="nav-links">
    <li><a href="{{ request()->is('/') ? '#Inicio' : route('home') }}" class="nav_link">Inicio</a></li>
    <li><a href="{{ request()->is('/') ? '#Sobre-TCA' : route('home') . '#Sobre-TCA' }}" class="nav_link">Sobre TCA</a></li>
    <li><a href="{{ request()->is('/') ? '#Test' : route('home') . '#Test' }}" class="nav_link fz">Test</a></li>
    <li><a href="{{ route('foro') }}" class="nav_link">Foro</a></li>
    <li><a href="{{ request()->is('/') ? '#Tipos' : route('home') . '#Tipos' }}" class="nav_link">Tipos</a></li>
    <li><a href="{{ request()->is('/') ? '#Síntomas' : route('home') . '#Síntomas' }}" class="nav_link">Síntomas</a></li>
    <li class="nav-search-box">
      <a class="search" href="javascript:void(0);" onclick="toggleBuscadorNavbar()">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6A7282" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m21 21-4.34-4.34" />
          <circle cx="11" cy="11" r="8" />
        </svg>
      </a>
    </li>

    <!-- CARD EN DONDE SE ABREN LAS OPCIONES DEL USUARIO -->

    <!-- SOLO VALIDO USUARIO NORMAL -->
    @auth
    <!-- VISTA PC -->
    <!-- Se cambió 'hidden md:flex' por 'desktop-only' -->
    <li class="desktop-only">
      <div class="relative">
        <button
          id="openOpcions"
          type="button"
          class="flex border-none items-center gap-2 bg-white hover:bg-gray-100 px-3 py-1.5 rounded-full">

          <div class="w-8 h-8 rounded-full border overflow-hidden border-transparent group-hover:border-[#87C8CD] transition-colors">
            <img src="{{ auth()->user()->avatar_url ?? '' }}" alt="Imagen del usuario" class="w-full h-full object-cover">
          </div>

          <!-- Se cambió 'hidden lg:inline' por 'hide-text-custom' para que se adapte a tus 1050px -->
          <span class="hide-text-custom font-medium">{{ auth()->user()->username ?: auth()->user()->usuario }}</span>

          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#364153" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg>
        </button>

        <div id="userOptions"
          class="hidden absolute top-full right-0 mt-2 z-50 bg-white border border-gray-200 rounded-lg shadow-lg w-64 overflow-hidden">
          <div class="px-4 py-2 border-b border-gray-400">
            <p class="text-base font-semibold text-gray-900 mb-0">{{ auth()->user()->username ?: auth()->user()->usuario }}</p>
            <p class="text-sm text-gray-500 truncate mb-2">{{ auth()->user()->usuario }}</p>
          </div>
          <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#364153" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-round">
              <path d="M17.925 20.056a6 6 0 0 0-11.851.001" />
              <circle cx="12" cy="11" r="4" />
              <circle cx="12" cy="12" r="10" />
            </svg>
            <span>Mi perfil</span>
          </a>

          <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#364153" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings">
              <path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915" />
              <circle cx="12" cy="12" r="3" />
            </svg>
            <span>Configuración</span>
          </a>

          <div class="border-t border-gray-100 mt-1 pt-1">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 bg-transparent hover:bg-red-50 transition-colors text-left border-none outline-none rounded-b-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                  <polyline points="16 17 21 12 16 7" />
                  <line x1="21" x2="9" y1="12" y2="12" />
                </svg>
                Cerrar Sesión
              </button>
            </form>
          </div>
        </div>
      </div>
    </li>
    @endauth

    @auth
    <!-- VISTA MOVIL -->
    <!-- Se cambió 'md:hidden' por 'mobile-only' -->
    <li class="mobile-only">
      <div class="border-t border-gray-100 mt-4 pt-4 w-full">

        <div class="flex items-start gap-3  mb-4">
          <div class="w-8 h-8 rounded-full border overflow-hidden border-transparent group-hover:border-[#87C8CD] transition-colors">
            <img src="{{ auth()->user()->avatar_url }}" alt="Imagen del usuario" class="w-full h-full object-cover">
          </div>
          <div class="text-left truncate">
            <p class="font-semibold text-gray-900 text-sm leading-none mb-1">
              {{ auth()->user()->username ?: auth()->user()->usuario }}
            </p>
            <p class="text-xs text-gray-500 truncate m-0">
              {{ auth()->user()->usuario }}
            </p>
          </div>
        </div>

        <div class="flex flex-col gap-1 px-2">

          <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors text-sm no-underline font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#617678" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-round">
              <path d="M17.925 20.056a6 6 0 0 0-11.851.001" />
              <circle cx="12" cy="11" r="4" />
              <circle cx="12" cy="12" r="10" />
            </svg>
            <span>Mi perfil</span>
          </a>

          <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors text-sm no-underline font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#617678" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings">
              <path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915" />
              <circle cx="12" cy="12" r="3" />
            </svg>
            <span>Configuración</span>
          </a>

          <!-- Formulario Cerrar Sesión -->
          <div class="border-t border-gray-100 mt-1 pt-1">
            <form action="/logout" method="POST" class="w-full mt-2">
              @csrf
              <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E7000B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 12H9" />
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                </svg>
                Cerrar sesión
              </button>
            </form>
          </div>
        </div>
      </div>
    </li>
    @endauth


    <li>
      @guest
      <a class="login" href="{{ route('login') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6A7282" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
          <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
          <circle cx="12" cy="7" r="4" />
        </svg>
        Iniciar Sesión
      </a>
      @endguest

      @auth
      @if(auth()->user()->tipo_usuario == 1)
      <a class="login" href="/admin">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6A7282" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
          <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
          <circle cx="12" cy="7" r="4" />
        </svg>
        Admin
      </a>
      @endif
      @endauth
    </li>
    <li>
      <a class="help" href="{{ request()->is('/') ? '#Ayuda' : route('home') . '#Ayuda' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#183133" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone">
          <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
        </svg>
        Ayuda
      </a>
    </li>
  </ul>

  <div id="navbarSearchOverlay" class="navbar-search-overlay" style="display: none;">
    <div class="navbar-search-container">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#99A1AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m21 21-4.34-4.34" />
        <circle cx="11" cy="11" r="8" />
      </svg>

      <input type="text" id="globalSearch" placeholder="Buscar información, síntomas, recursos...">

      <button type="button" class="navbar-search-close" onclick="toggleBuscadorNavbar()">×</button>
    </div>
  </div>

</nav>