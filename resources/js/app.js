document.addEventListener("DOMContentLoaded", () => {
    // Menú hamburguesa
    const hamburger = document.querySelector(".hamburger");
    const navLinks = document.querySelector(".nav-links");
    if (hamburger && navLinks) {
        hamburger.addEventListener("click", () => {
            navLinks.classList.toggle("active");
        });
    }

    // Botón de like foro
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function () {
            let postId = this.getAttribute('data-id');

            this.classList.toggle("liked");

            fetch(`/foro/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    document.getElementById(`likes-${postId}`).innerText = data.total;
                });
        });
    });

    //BOTÓN PARA DESPLEGAR CUANDO HAY AUTENTICADO 
        const carduser = document.getElementById('openOpcions');
        const userOptions = document.getElementById('userOptions');

        if (carduser && userOptions) {
            // 1. Abre y cierra el menú al hacer clic en el botón
            carduser.addEventListener('click', (event) => {
                event.stopPropagation(); // Evita que el evento se propague al document
                userOptions.classList.toggle('hidden');
            });

            // 2. Si el menú está abierto y hacen clic fuera, se cierra solo
            document.addEventListener('click', (event) => {
                if (!userOptions.contains(event.target) && !carduser.contains(event.target)) {
                    userOptions.classList.add('hidden');
                }
            });
        }


    // CATEGORIAS PARA COMENTARIOS
    const modal = document.getElementById('newcommentform');
    const btn = document.querySelector('.newcomment');
    const closeElements = document.querySelectorAll('.close, #btnCancelar');

    if (modal && btn) {
        btn.onclick = () => {
            modal.style.display = 'flex';
        };

        closeElements.forEach(el => {
            el.onclick = () => {
                modal.style.display = 'none';
            };
        });

        window.onclick = (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        };
    }
    //NÚMEROS SOLO VÁLIDOS PARA INPUT OTP  
    const otps = document.querySelectorAll('.ipcdv');

    otps.forEach(input => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '').slice(0, 6);
        });

    });
    // Manejo de errores en login
    const inputs = document.querySelectorAll('.input-lg');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            // Esto oculta el mensaje de error de Laravel cuando el usuario corrige
            const laravelError = document.querySelector('.text-danger');
            if (laravelError) laravelError.style.display = 'none';
        });
    });

    // Test
    const questions = [
        "¿Te provocas el vómito porque te sientes insoportablemente lleno/a?",
        "¿Te preocupa haber perdido el control sobre la cantidad de comida que ingieres?",
        "¿Has perdido más de 6 kg en un período de 3 meses recientemente?",
        "¿Crees que estás gordo/a aunque los demás digan que estás demasiado delgado/a?",
        "¿Dirías que la comida domina tu vida?"
    ];

    let currentStep = 0;
    let score = 0;

    const viewStart = document.getElementById('view-start');
    const viewQuestions = document.getElementById('view-questions');
    const viewResults = document.getElementById('view-results');

    // Verificar que los elementos existan antes de añadir el listener
    if (document.getElementById('btn-start')) {
        document.getElementById('btn-start').addEventListener('click', () => {
            switchView('questions');
            updateUI();
        });
    }

    if (document.getElementById('btn-restart')) {
        document.getElementById('btn-restart').addEventListener('click', () => {
            currentStep = 0;
            score = 0;
            switchView('start');
        });
    }

    window.handleAnswer = function (isYes) {
        if (isYes) score++;
        if (currentStep < questions.length - 1) {
            currentStep++;
            updateUI();
        } else {
            finishTest();
        }
    };

    function updateUI() {
        document.getElementById('question-text').innerText = questions[currentStep];
        const progress = (currentStep / questions.length) * 100;
        document.getElementById('progress-fill').style.width = `${progress}%`;
        document.getElementById('question-number').innerText = `Pregunta ${currentStep + 1} de 5`;
        document.getElementById('progress-percent').innerText = `${Math.round(progress)}% completado`;
    }

    function finishTest() {
        switchView('results');
        const isHighRisk = score >= 2;
        const icon = document.getElementById('result-icon-wrapper');
        const box = document.getElementById('result-message-box');

        if (isHighRisk) {
            icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#FF6900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>';
            box.className = "test-message-card risk-high";
            document.getElementById('result-status-title').innerText = "Posibles indicadores de riesgo detectados";
            document.getElementById('result-description').innerText = "Tus respuestas sugieren que podrías estar experimentando síntomas relacionados con un Trastorno de la Conducta Alimentaria.";
            document.getElementById('result-status-title p2').innerText = "Recomendación:";
            document.getElementById('result-description p2').innerText = "Te recomendamos encarecidamente que consultes con un profesional de la salud (médico de cabecera o psicólogo) para una evaluación adecuada. No tengas miedo de pedir ayuda.";
        } else {
            icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#00C950" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>';
            box.className = "test-message-card risk-low";
            document.getElementById('result-status-title').innerText = "Bajo riesgo detectado";
            document.getElementById('result-description').innerText = "Tus respuestas no indican síntomas claros de un TCA según este cuestionario básico. Sin embargo, si sientes malestar con tu cuerpo o tu alimentación, siempre es buena idea hablar con un profesional.";
            document.getElementById('result-status-title p2').innerText = "";
            document.getElementById('result-description p2').innerText = "";
        }
    }

    function switchView(view) {
        if (!viewStart || !viewQuestions || !viewResults) return;
        [viewStart, viewQuestions, viewResults].forEach(v => v.classList.remove('view-active'));
        if (view === 'start') viewStart.classList.add('view-active');
        if (view === 'questions') viewQuestions.classList.add('view-active');
        if (view === 'results') viewResults.classList.add('view-active');
    }

    // Login
    const formLogin = document.getElementById("loginForm");
    if (formLogin) {
        formLogin.addEventListener("submit", async (e) => {
            e.preventDefault();
            const datos = new FormData(formLogin);
            const mensaje = document.getElementById("loginMessage");
            mensaje.innerText = "";

            let camposVacios = false;
            for (let [, value] of datos.entries()) {
                if (value.trim() === "") camposVacios = true;
            }

            if (camposVacios) {
                mensaje.innerText = "No debe haber campos vacios!";
                mensaje.classList.add("text-danger");
                return;
            }

            try {
                const response = await fetch("/login", {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: datos
                });

                if (response.status === 429) {
                    if (mensaje) {
                        mensaje.innerText = "Demasiados intentos. Intenta de nuevo en 1 minuto.";
                        mensaje.classList.add("text-danger");
                    }
                    return;
                }

                const json = await response.json();
                if (json.success) {
                    localStorage.clear();

                    localStorage.setItem("email", formLogin.querySelector("[name='email']").value);
                    window.location.href = "/otp";
                } else if (json.disabled) {
                    alert("Tu cuenta está desactivada. Debes recuperarla.");
                    localStorage.clear();

                    localStorage.setItem("email", formLogin.querySelector("[name='email']").value);
                    localStorage.setItem("flow", "reset");
                    window.location.href = "/forgot-password";
                } else {
                    mensaje.style.display = "block";
                    mensaje.innerText = json.message;
                }
            } catch (error) {
                mensaje.innerText = "Error de conexión con el servidor";
            }
        });
    }

    // Registro
    const formRegister = document.getElementById("registerForm");

    if (formRegister) {
        formRegister.addEventListener("submit", (e) => {
            e.preventDefault();

            const email = formRegister.querySelector("[name='usuario']").value;

            localStorage.clear();
            localStorage.setItem("email", email);
            localStorage.setItem("flow", "register");

            formRegister.submit();
        });
    }

    // OTP
    const otpForm = document.getElementById("otpForm");
    if (otpForm) {
        const flow = localStorage.getItem("flow") || "";

        otpForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const datos = new FormData(otpForm);
            const mensaje = document.getElementById("otpMessage");
            let email = localStorage.getItem("email");

            if (!email) {
                email = document.getElementById("emailHidden")?.value;
            }

            if (email) {
                datos.append("email", email);
            }


            try {
                let url = "/verify-otp";

                if (flow === "register") {
                    url = "/verify-otp-register";
                } else if (flow === "reset") {
                    url = "/verify-otp-reset";
                }
                const response = await fetch(url, {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: datos
                });

                if (response.status === 429) {
                    if (mensaje) {
                        mensaje.innerText = "Demasiados intentos. Espera un momento antes de intentar de nuevo.";
                    }
                    return;
                }

                const json = await response.json();

                if (json.success) {
                    localStorage.removeItem("email");
                    if (flow === "register") {
                        localStorage.removeItem("flow");
                        window.location.href = "/login";
                    }
                    else if (flow === "reset") {
                        window.location.href = "/forgot-password";
                    }
                    else {
                        localStorage.removeItem("flow");
                        window.location.href = "/foro";
                    }

                } else {
                    mensaje.style.display = "block";
                    mensaje.innerText = json.message;
                }
            } catch (error) {
                mensaje.innerText = "Error al verificar código";
            }
        });
    }

    // Reenviar código OTP
    const resendBtn = document.getElementById("resendOtpBtn");
    if (resendBtn) {
        resendBtn.addEventListener("click", async () => {
            const mensaje = document.getElementById("resendMessage");
            mensaje.innerText = "Enviando...";
            let email = localStorage.getItem("email");

            if (!email) {
                email = document.getElementById("emailHidden")?.value;
            }

            try {
                let url = "/resend-otp";

                if (localStorage.getItem("flow") === "register") {
                    url = "/resend-otp-register";
                }

                const response = await fetch(url, {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ email })
                });
                const json = await response.json();
                if (json.success) {
                    mensaje.innerText = "Se volvió a enviar el código";
                    resendBtn.disabled = true;
                    setTimeout(() => { resendBtn.disabled = false; }, 30000);
                } else {
                    mensaje.style.display = "block";
                    mensaje.innerText = json.message;
                }
            } catch (error) {
                mensaje.innerText = "Error al reenviar código";
            }
        });
    }

    // Filtrado
    const categoriasFiltro = document.querySelectorAll(".categories");
    const temas = document.querySelectorAll(".cardcomment");
    const buscador = document.querySelector(".bi");

    if (categoriasFiltro.length && temas.length) {

        let categoriaActual = "todos";

        categoriasFiltro.forEach(cat => {
            cat.addEventListener("click", function () {

                categoriaActual = this.dataset.category;

                categoriasFiltro.forEach(c => c.classList.remove("active"));
                this.classList.add("active");

                filtrar();
            });
        });

        if (buscador) {
            buscador.addEventListener("input", filtrar);
        }

        function filtrar() {
            const texto = buscador.value.toLowerCase();
            const userId = document.body.dataset.userid;

            temas.forEach(tema => {

                const categoria = tema.dataset.category;
                const usuario = tema.dataset.user;
                const titulo = tema.dataset.title;
                const mensaje = tema.dataset.message;

                let mostrar = true;

                // Categorias
                if (categoriaActual !== "todos") {

                    if (categoriaActual === "mis-publicaciones") {
                        mostrar = usuario == userId;
                    } else {
                        mostrar = categoria === categoriaActual;
                    }
                }

                // Busqueda
                if (texto && !(titulo.includes(texto) || mensaje.includes(texto))) {
                    mostrar = false;
                }

                tema.style.display = mostrar ? "block" : "none";
            });
        }
    }

    // Mostrar comentarios
    document.querySelectorAll('.toggle-comments').forEach(btn => {
        btn.addEventListener('click', function () {

            let id = this.getAttribute('data-id');
            let box = document.getElementById(`comentarios-${id}`);

            if (box.style.display === "none") {
                box.style.display = "block";
            } else {
                box.style.display = "none";
            }

        });
    });

    // Eliminar temas (ocultar)
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {

            let postId = this.getAttribute('data-id');

            fetch(`/foro/${postId}/eliminar`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.cardcomment').remove();
                    }
                });
        });
    });

    // Boton de editar (Admin)
    window.editar = function (id) {
        document.getElementById('view' + id).style.display = 'none';
        document.getElementById('edit' + id).style.display = 'table-row';
    }

    // Boton de cancelar (Admin)
    window.cancelar = function (id) {
        document.getElementById('view' + id).style.display = 'table-row';
        document.getElementById('edit' + id).style.display = 'none';
    }

    // Crear user (Admin)
    window.crearUsuario = function () {
        let fila = document.getElementById('createRow');

        if (fila) {
            fila.style.display = 'table-row';
        }
    }

    // Cancelar creacion de user (Admin)
    window.cancelarCrear = function () {
        let fila = document.getElementById('createRow');

        if (fila) {
            fila.style.display = 'none';
        }
    }

    // Forgot Password
    const forgotForm = document.getElementById("forgotForm");

    if (forgotForm) {
        forgotForm.addEventListener("submit", () => {

            localStorage.removeItem("flow");
            localStorage.setItem("flow", "reset");

            const email = forgotForm.querySelector("[name='usuario']").value;
            localStorage.setItem("email", email);
        });
    }

    // Buscador (Admin)
    const buscadorAdmin = document.getElementById("buscarUsuario");

    if (buscadorAdmin) {
        buscadorAdmin.addEventListener("input", function () {

            let texto = this.value.toLowerCase();
            let filas = document.querySelectorAll(".fila-usuario");

            filas.forEach(fila => {
                let contenido = fila.innerText.toLowerCase();

                if (contenido.includes(texto)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });

        });
    }

    let resultadosBusqueda = [];
    let indiceBusqueda = -1;

    window.toggleBuscadorNavbar = function () {
        const input = document.getElementById("globalSearch");
        const up = document.getElementById("btnUpSearch");
        const down = document.getElementById("btnDownSearch");

        if (!input) return;

        if (input.style.display === "none" || input.style.display === "") {
            input.style.display = "inline-block";

            if (up) up.style.display = "inline-block";
            if (down) down.style.display = "inline-block";
            input.focus();
        } else {
            input.style.display = "none";

            if (up) up.style.display = "none";
            if (down) down.style.display = "none";

            input.value = "";
            limpiarMarcadosBusqueda();
        }
    };

    const buscadorGlobal = document.getElementById("globalSearch");

    if (buscadorGlobal) {

        buscadorGlobal.addEventListener("input", function () {
            ejecutarBusquedaGlobal(this.value.trim());
        });

        buscadorGlobal.addEventListener("keydown", function (e) {

            if (e.key === "ArrowDown") {
                e.preventDefault();
                moverBusqueda(1);
            }

            if (e.key === "ArrowUp") {
                e.preventDefault();
                moverBusqueda(-1);
            }
        });
    }

    function limpiarMarcadosBusqueda() {

        document.querySelectorAll(".resultado-busqueda").forEach(el => {
            el.classList.remove("resultado-busqueda");
        });

        document.querySelectorAll(".resultado-activo").forEach(el => {
            el.classList.remove("resultado-activo");
        });

        resultadosBusqueda = [];
        indiceBusqueda = -1;
    }

    function ejecutarBusquedaGlobal(texto) {

        limpiarMarcadosBusqueda();

        if (texto === "") return;

        let elementos = document.querySelectorAll(
            "body *:not(nav *):not(.fixed-top *):not(.nav-links *):not(.container_logo *)"
        );

        elementos.forEach(el => {

            if (el.children.length > 0) return;
            if (!el.innerText) return;

            let contenido = el.innerText.trim().toLowerCase();

            if (contenido.includes(texto.toLowerCase())) {
                el.classList.add("resultado-busqueda");
                resultadosBusqueda.push(el);
            }
        });

        if (resultadosBusqueda.length > 0) {
            indiceBusqueda = 0;
            enfocarResultado();
        }
    }

    function moverBusqueda(direccion) {

        if (resultadosBusqueda.length === 0) return;

        indiceBusqueda += direccion;

        if (indiceBusqueda >= resultadosBusqueda.length) {
            indiceBusqueda = 0;
        }

        if (indiceBusqueda < 0) {
            indiceBusqueda = resultadosBusqueda.length - 1;
        }

        enfocarResultado();
    }

    window.moverBusqueda = moverBusqueda;

    function enfocarResultado() {

        document.querySelectorAll(".resultado-activo").forEach(el => {
            el.classList.remove("resultado-activo");
        });

        const actual = resultadosBusqueda[indiceBusqueda];

        if (!actual) return;

        actual.classList.add("resultado-activo");

        actual.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });
    }
});