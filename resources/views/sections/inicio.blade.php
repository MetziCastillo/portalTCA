<section id="Inicio">

  <div class="containerhome">
    <div class="contau1">
      <p class="slogan">
        La recuperación es <span class="txt-blue">posible y real </span>
      </p>
      <p class="txtsubtitles">
        Información, apoyo y recursos sobre los Trastornos de la Conducta
        Alimentaria (TCA). No estás solo en este camino.
      </p>

      <!-- buttons -->
      <div class="ctnerbutton">
        <a href="{{ request()->is('/') ? '#Ayuda' : route('home') . '#Ayuda' }}" class="btn-fp">Buscar Ayuda</a>
          <a href="{{ request()->is('/') ? '#Sobre-TCA' : route('home') . '#Sobre-TCA' }}" class="btn-fp blue">Saber más
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#445C5E" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/>
                <path d="m12 5 7 7-7 7"/>
            </svg>
        </a>
      </div>
    </div>

    <div class="contau2">
      <img
        src="https://images.unsplash.com/photo-1760737307022-0c9dae21a88d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjYWxtJTIwbmF0dXJlJTIwbWVudGFsJTIwaGVhbHRoJTIwc3VwcG9ydHxlbnwxfHx8fDE3NzEyNjcwOTh8MA&ixlib=rb-4.1.0&q=80&w=1080"
        alt="cabina de telefono"
        class="imgpc"
      />
    </div>

  </div>

</section>
