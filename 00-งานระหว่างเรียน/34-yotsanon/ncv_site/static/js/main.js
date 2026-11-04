document.addEventListener('DOMContentLoaded', () => {
  // เมนูมือถือ
  const btn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  if (btn && mobileMenu) {
    btn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
  }

  // แถบประกาศหมุนเวียน
  const items = document.querySelectorAll('[data-ticker]');
  if (items.length > 1) {
    let t = 0;
    setInterval(() => {
      items[t].classList.add('hidden');
      t = (t + 1) % items.length;
      items[t].classList.remove('hidden');
    }, 4000);
  }

  // สไลด์แบนเนอร์
  const slides = document.querySelectorAll('[data-slide]');
  const dots = document.querySelectorAll('[data-dot]');
  if (slides.length) {
    let i = 0;
    let timer = null;
    const show = (n) => {
      i = (n + slides.length) % slides.length;
      slides.forEach((s, k) => {
        s.classList.toggle('opacity-100', k === i);
        s.classList.toggle('opacity-0', k !== i);
        s.classList.toggle('z-10', k === i);
        s.classList.toggle('pointer-events-none', k !== i);
      });
      dots.forEach((d, k) => {
        d.classList.toggle('bg-white', k === i);
        d.classList.toggle('bg-white/40', k !== i);
      });
    };
    const start = () => { if (slides.length > 1) timer = setInterval(() => show(i + 1), 5500); };
    const reset = () => { clearInterval(timer); start(); };
    document.querySelector('[data-prev]')?.addEventListener('click', () => { show(i - 1); reset(); });
    document.querySelector('[data-next]')?.addEventListener('click', () => { show(i + 1); reset(); });
    dots.forEach((d, k) => d.addEventListener('click', () => { show(k); reset(); }));
    show(0);
    start();
  }
});
