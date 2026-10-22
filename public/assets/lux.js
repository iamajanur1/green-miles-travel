/* Lightweight progressive enhancements: the content and links remain usable without JS. */
(() => {
  'use strict';
  const viewport = document.querySelector('[data-experiences-slider]');
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  if (viewport) {
    const track = viewport.querySelector('.arch-track');
    const cards = Array.from(track?.querySelectorAll('.arch-card') ?? []);
    const prev = document.querySelector('[data-experiences-prev]');
    const next = document.querySelector('[data-experiences-next]');
    let index = 0, startX = null, interval = null;
    const visible = () => window.innerWidth < 480 ? 1 : window.innerWidth < 768 ? 2 : 3;
    const render = () => {
      const count = visible();
      const max = Math.max(0, cards.length - count);
      index = Math.min(Math.max(0, index), max);
      if (cards.length) {
        const step = cards[0].getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap || '18');
        track.style.transform = `translate3d(${-index * step}px, 0, 0)`;
      }
      if (prev) prev.disabled = index === 0;
      if (next) next.disabled = index >= max;
    };
    const move = direction => { const max=Math.max(0,cards.length-visible());index=index+direction;if(index>max)index=0;if(index<0)index=max;render(); };
    prev?.addEventListener('click',() => {move(-1);restart();});
    next?.addEventListener('click',() => {move(1);restart();});
    viewport.addEventListener('touchstart',e=>{startX=e.touches[0]?.clientX??null;},{passive:true});
    viewport.addEventListener('touchend',e=>{if(startX===null)return;const diff=(e.changedTouches[0]?.clientX??startX)-startX;if(Math.abs(diff)>45){move(diff<0?1:-1);restart();}startX=null;},{passive:true});
    const stop = () => {if(interval!==null)window.clearInterval(interval);interval=null;};
    const start = () => {if(!reducedMotion.matches && cards.length>visible() && !document.hidden && interval===null)interval=window.setInterval(()=>move(1),4000);};
    const restart = () => {stop();start();};
    viewport.addEventListener('mouseenter',stop);
    viewport.addEventListener('mouseleave',start);
    viewport.addEventListener('focusin',stop);
    viewport.addEventListener('focusout',start);
    window.addEventListener('resize',()=>{render();restart();},{passive:true});
    document.addEventListener('visibilitychange',()=>{document.hidden?stop():start();});
    reducedMotion.addEventListener?.('change',restart);
    render(); start();
  }
  // Prevent animation-only elements from showing a split, mid-animation state for reduced motion.
  document.querySelectorAll('a[href^="#"]').forEach(link=>link.addEventListener('click',event=>{
    const id=link.getAttribute('href');if(!id || id==='#')return;
    const target=document.querySelector(id);if(target){event.preventDefault();target.scrollIntoView({behavior:reducedMotion.matches?'instant':'smooth'});}
  }));
})();
