/* capture.js — ativa só com ?capture na URL: achata a página inteira (sem scroll-jacking, sem
   reveals escondidos) e avisa o pai (via postMessage) a altura real, pra montagem de prints/frames */
(function () {
  var params = new URLSearchParams(location.search);
  if (!params.has('capture')) return;

  function apply() {
    try {
      if (window.ScrollTrigger) {
        window.ScrollTrigger.getAll().forEach(function (st) { st.kill(); });
      }
    } catch (e) {}

    var style = document.createElement('style');
    style.textContent =
      '.hscroll-pin{height:auto!important;overflow:visible!important;position:static!important}' +
      '.hscroll-track{flex-direction:column!important;width:100%!important;transform:none!important;height:auto!important}' +
      '.hscroll-panel{width:100%!important;height:auto!important;min-height:560px;padding-block:3rem!important}' +
      '.hscroll-progress,.hscroll-hint{display:none!important}' +
      '.pin-spacer{height:auto!important;padding:0!important}' +
      '.whatsapp-float{display:none!important}' +
      /* .hero e .about usam min-height:100vh — se a janela de captura for redimensionada pra
         altura total da página, esses blocos "inflam" e engolem o resto do conteúdo. Trava em auto. */
      '.hero{min-height:auto!important}' +
      '.about{min-height:auto!important}' +
      '.about-media{min-height:auto!important}' +
      /* na tela ao vivo o card de confiança flutua propositalmente por cima da foto do hero —
         num print estático isso lê como sobreposição estranha, então só na captura a gente
         separa o card num bloco próprio, abaixo do hero. */
      '.trust-bar{margin-top:64px!important}';
    document.head.appendChild(style);

    document.querySelectorAll('.reveal,.reveal-word').forEach(function (el) { el.classList.add('is-visible'); });
    document.querySelectorAll('.signature-reveal').forEach(function (el) {
      el.style.animation = 'none';
      el.style.opacity = '1';
      el.style.transform = 'none';
    });
    document.querySelectorAll('[data-count-to]').forEach(function (el) {
      el.textContent = el.getAttribute('data-count-to');
    });

    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        var h = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight);
        var scrollY = parseInt(params.get('scrollY'), 10);
        if (!isNaN(scrollY)) window.scrollTo(0, scrollY);
        try {
          window.parent.postMessage({ source: 'twodevs-capture', height: h }, '*');
        } catch (e) {}
      });
    });
  }

  window.addEventListener('load', apply);
})();
