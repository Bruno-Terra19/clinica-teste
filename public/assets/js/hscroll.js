/* evita que o navegador restaure a posição de rolagem de uma visita anterior — sempre abre no painel 01 */
if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
window.scrollTo(0, 0);

document.addEventListener('DOMContentLoaded', () => {
  window.scrollTo(0, 0);
  if (window.lucide) lucide.createIcons();
});

function initHscroll() {
  window.scrollTo(0, 0);
  if (!window.gsap || !window.ScrollTrigger) return;
  gsap.registerPlugin(ScrollTrigger);

  const track = document.querySelector('.hscroll-track');
  const panels = gsap.utils.toArray('.hscroll-panel');
  const fill = document.querySelector('.hscroll-progress-fill');
  const labelNow = document.querySelector('[data-progress-now]');
  const hint = document.querySelector('.hscroll-hint');
  if (!track || panels.length < 2) return;

  gsap.set(track, { x: 0 });

  ScrollTrigger.matchMedia({
    '(min-width: 821px)': function () {
      const distance = () => track.scrollWidth - window.innerWidth;

      gsap.to(track, {
        x: () => -distance(),
        ease: 'none',
        scrollTrigger: {
          trigger: '.hscroll-pin',
          start: 'top top',
          end: () => '+=' + distance(),
          scrub: 0.4,
          pin: true,
          anticipatePin: 1,
          invalidateOnRefresh: true,
          onUpdate: (self) => {
            if (fill) fill.style.width = `${self.progress * 100}%`;
            const active = Math.min(panels.length - 1, Math.round(self.progress * (panels.length - 1)));
            if (labelNow) labelNow.textContent = String(active + 1).padStart(2, '0');
            if (hint && self.progress > 0.03) hint.classList.add('is-hidden');
          }
        }
      });

      /* garante que a distância de scroll seja recalculada depois que todas as imagens tiverem seu tamanho real aplicado */
      ScrollTrigger.refresh();
    }
  });
}

/* só monta o scroll horizontal depois que TODAS as imagens carregarem — senão o track é medido com largura errada e o "fim" do scroll acontece cedo demais */
const bgImages = Array.from(document.querySelectorAll('.hscroll-media img, .hscroll-panel-bg'));
const pending = bgImages.filter((img) => !img.complete);
if (pending.length === 0) {
  window.addEventListener('load', initHscroll);
} else {
  let remaining = pending.length;
  pending.forEach((img) => {
    img.addEventListener('load', () => {
      remaining -= 1;
      if (remaining === 0) initHscroll();
    });
    img.addEventListener('error', () => {
      remaining -= 1;
      if (remaining === 0) initHscroll();
    });
  });
}
