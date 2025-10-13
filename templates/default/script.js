const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const type = el.dataset.animate;
      if (type) {
        el.classList.add('animate-' + type); // e.g., animate-fade
      }
      observer.unobserve(el); // Optional: stop observing after animation
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('[data-animate]').forEach(el => {
  observer.observe(el);
});
