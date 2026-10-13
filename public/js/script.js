// Zippy Store - Core Interaction Script
document.addEventListener('DOMContentLoaded', () => {
  // 1. Navbar scrolled state
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    const handleScroll = () => {
      navbar.classList.toggle('scrolled', window.scrollY > 30);
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  // 2. Reveal on scroll (Robust IntersectionObserver with immediate check)
  const revealElements = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('show');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    revealElements.forEach(el => io.observe(el));
  } else {
    // Fallback for older browsers
    revealElements.forEach(el => el.classList.add('show'));
  }

  // 3. Lightbox modal feed
  const lbModal = document.getElementById('lightboxModal');
  if (lbModal) {
    const lbImg = lbModal.querySelector('img');
    document.querySelectorAll('.gallery-item').forEach(item => {
      item.addEventListener('click', () => {
        const img = item.querySelector('img');
        if (img && lbImg) {
          lbImg.src = img.src;
          bootstrap.Modal.getOrCreateInstance(lbModal).show();
        }
      });
    });
  }

  // 4. Gallery filter (param URL)
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const k = btn.dataset.kategori;
      const url = new URL(window.location.href);
      if (k && k !== 'semua') {
        url.searchParams.set('kategori', k);
      } else {
        url.searchParams.delete('kategori');
      }
      window.location.href = url.toString();
    });
  });
});