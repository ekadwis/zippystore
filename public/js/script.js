// Navbar solid on scroll
const navbar = document.querySelector('.navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 40);
});

// Reveal on scroll
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('show'); });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));

// Lightbox: feed gambar ke Bootstrap modal
const lbModal = document.getElementById('lightboxModal');
if (lbModal) {
  const lbImg = lbModal.querySelector('img');
  document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', () => {
      lbImg.src = item.querySelector('img').src;
      bootstrap.Modal.getOrCreateInstance(lbModal).show();
    });
  });
}

// Gallery filter (ubah param kategori)
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const k = btn.dataset.kategori;
    const url = new URL(window.location.href);
    if (k && k !== 'semua') url.searchParams.set('kategori', k);
    else url.searchParams.delete('kategori');
    window.location.href = url.toString();
  });
});