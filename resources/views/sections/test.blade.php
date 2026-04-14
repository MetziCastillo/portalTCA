<section id="Test">
    <div class="test-card-main">
        <div class="test-banner-top">
            <div class="test-banner-title">
                <span class="test-icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1A3537" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                </span>
                <h2>Test de Autoevaluación</h2>
            </div>
            <p>Cuestionario breve de detección (Basado en SCOFF)</p>
        </div>

        <div class="test-content-area">
            <div id="view-start" class="test-step-view view-active">
                <div class="test-disclaimer-box">
                    <p><strong>Descargo de responsabilidad importante:</strong> Este test es solo una herramienta orientativa y <u>NO sustituye un diagnóstico médico profesional</u>. Los resultados no confirman la presencia de un trastorno alimentario.</p>
                </div>
                <h3 class="test-heading-text">¿Crees que podrías tener un TCA?</h3>
                <p class="test-paragraph">Responde a estas 5 preguntas sencillas con honestidad. Tus respuestas son totalmente anónimas y no se guardan en ningún lugar.</p>
                <button id="btn-start" class="test-btn-cyan">Comenzar Test &rarr;</button>
            </div>

            <div id="view-questions" class="test-step-view">
                <div class="test-progress-labels">
                    <span id="question-number">Pregunta 1 de 5</span>
                    <span id="progress-percent">0% completado</span>
                </div>
                <div class="test-progress-track">
                    <div id="progress-fill" class="test-progress-bar"></div>
                </div>
                
                <div class="test-question-box">
                    <h3 id="question-text" class="test-question-label"></h3>
                    <div class="test-grid-options">
                        <button class="test-btn-choice" onclick="handleAnswer(true)">Sí</button>
                        <button class="test-btn-choice" onclick="handleAnswer(false)">No</button>
                    </div>
                </div>
            </div>

            <div id="view-results" class="test-step-view">
                <div id="result-icon-wrapper" class="test-result-indicator"></div>
                <h3 class="test-heading-text">Resultado del Test</h3>
                
                <div id="result-message-box" class="test-message-card">
                    <h4 id="result-status-title"></h4>
                    <p id="result-description"></p>
                    <h4 id="result-status-title p2"></h4>
                    <p id="result-description p2"></p>
                </div>

                <div class="test-flex-buttons">
                    <a href="#" class="test-btn-cyan">Ver Recursos de Ayuda</a>
                    <button id="btn-restart" class="test-btn-ghost">
                        Repetir Test
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>