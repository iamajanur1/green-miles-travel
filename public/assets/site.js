(() => {
  'use strict';
  const menuButton = document.getElementById('menuToggle');
  const header = document.getElementById('siteHeader');
  const menu = document.getElementById('siteMenu');
  const syncHeader = () => header?.classList.toggle('scrolled', window.scrollY > 80 || !document.querySelector('.hero-home'));
  syncHeader(); window.addEventListener('scroll', syncHeader, { passive:true });
  function closeMenu() { if (!menu || !menuButton) return; menu.hidden = true; menuButton.setAttribute('aria-expanded','false');menuButton.setAttribute('aria-label','Open navigation');header?.classList.remove('has-menu'); }
  function openMenu() { if (!menu || !menuButton) return; menu.hidden = false; menuButton.setAttribute('aria-expanded','true');menuButton.setAttribute('aria-label','Close navigation');header?.classList.add('has-menu'); }
  menuButton?.addEventListener('click', () => menu.hidden ? openMenu() : closeMenu());
  document.addEventListener('click', (e) => { if (!menu?.hidden && !header?.contains(e.target)) closeMenu(); });
  menu?.querySelectorAll('a').forEach(a=>a.addEventListener('click',closeMenu));
  const modal = document.getElementById('eventModal'); let previouslyFocused = null;
  function closeModal() { if (!modal) return; modal.hidden = true; modal.setAttribute('aria-hidden','true'); document.body.style.overflow = ''; try{ sessionStorage.setItem('gm-event-seen','1'); }catch{} previouslyFocused?.focus?.(); }
  function openModal() { if (!modal) return; previouslyFocused=document.activeElement; modal.hidden=false;modal.setAttribute('aria-hidden','false');document.body.style.overflow='hidden'; modal.querySelector('.modal-x')?.focus(); }
  if (modal) {
    modal.querySelectorAll('[data-close-modal],[data-book-event]').forEach(el=>el.addEventListener('click',closeModal));
    const hasSeen = (()=>{try{return sessionStorage.getItem('gm-event-seen') === '1';}catch{return false;}})();
    if(!hasSeen && !matchMedia('(prefers-reduced-motion: reduce)').matches) window.setTimeout(openModal,2500);
    else if(!hasSeen) window.setTimeout(openModal,500);
    modal.addEventListener('keydown',e => {
      if(e.key !== 'Tab')return;
      const items=[...modal.querySelectorAll('button,a')].filter(n=>n.offsetParent!==null);if(!items.length)return;
      const first=items[0],last=items[items.length-1];
      if(e.shiftKey&&document.activeElement===first){e.preventDefault();last.focus();}
      else if(!e.shiftKey&&document.activeElement===last){e.preventDefault();first.focus();}
    });
  }
  document.addEventListener('keydown',e=>{if(e.key==='Escape'){closeMenu();if(modal&&!modal.hidden)closeModal();}});
  const showcase=document.querySelector('[data-slider="destinations"]');
  if(showcase){
    const slides=[...showcase.querySelectorAll('[data-slide]')];let index=0;
    const current=document.querySelector('.slider-current');
    const move=delta=>{if(!slides.length)return;slides[index].classList.remove('is-active');index=(index+delta+slides.length)%slides.length;slides[index].classList.add('is-active');if(current)current.textContent=`${String(index+1).padStart(2,'0')} / ${String(slides.length).padStart(2,'0')}`};
    document.querySelector('[data-prev]')?.addEventListener('click',()=>move(-1));
    document.querySelector('[data-next]')?.addEventListener('click',()=>move(1));
  }
  // Progressive enhancements: never hide content permanently if JS errors or is unavailable.
  if('IntersectionObserver' in window && !matchMedia('(prefers-reduced-motion: reduce)').matches){
    const els=[...document.querySelectorAll('[data-reveal="heading"],[data-reveal="card"]')];
    const ob=new IntersectionObserver((entries,observer)=>entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.remove('is-pending');entry.target.classList.add('is-revealed');observer.unobserve(entry.target);}}),{threshold:.06,rootMargin:'0px 0px -12px 0px'});
    document.body.classList.add('js-effects');
    els.forEach(el=>{if(el.getBoundingClientRect().top > innerHeight*.86)el.classList.add('is-pending');ob.observe(el);});
  }
  // Contact form guards client-side only; server validation, CSRF and anti-spam are authoritative.
  document.querySelectorAll('form[data-enquiry-form]').forEach(form=>form.addEventListener('submit',()=>{
    const button=form.querySelector('[type="submit"]');if(button){button.disabled=true;button.textContent='Sending…';}
  }));
})();
