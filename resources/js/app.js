import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';
gsap.registerPlugin(ScrollTrigger, SplitText);
const mm = gsap.matchMedia();
mm.add('(prefers-reduced-motion: no-preference)', () => {
  const hero = document.querySelector('.hero-home h1');
  if (hero) {
    SplitText.create(hero, {
      type: 'lines', mask:'lines', autoSplit:true,
      onSplit(split) { return gsap.from(split.lines,{y:42,autoAlpha:0,duration:.9,stagger:.1,ease:'power3.out',delay:.15}); }
    });
    gsap.from('.hero-intro,.hero-content .button',{y:22,opacity:0,duration:.85,stagger:.16,ease:'power3.out',delay:.65});
  }
  document.querySelectorAll('.section-head h2').forEach(el => {
    gsap.from(el,{y:35,autoAlpha:0,duration:.9,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 90%',once:true}});
  });
  document.querySelectorAll('.trip-card').forEach((el,index)=>{
    gsap.from(el,{y:45,opacity:0,duration:.8,delay:(index%3)*.08,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 96%',once:true}});
  });
  const collage = document.querySelector('.collage-photos');
  if(collage && innerWidth > 992) gsap.to(collage.querySelectorAll('img'),{y:-22,stagger:.08,ease:'none',scrollTrigger:{trigger:collage,start:'top bottom',end:'bottom top',scrub:.6}});
});
