
// carousel

document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll('.carousel-wrapper').forEach(wrapper => {
		const slides = wrapper.querySelectorAll('.carousel-slide');
		const navType = wrapper.dataset.navigationType || 'slideshow'; // fallback
		let current = 0;

		function showSlide(index) {
			slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
		}

		showSlide(current);

		if (navType === 'slideshow') {
			setInterval(() => {
				current = (current + 1) % slides.length;
				showSlide(current);
			}, 5000);
		}

		if (navType === 'arrows') {
			const leftArrow = wrapper.querySelector('.carousel-arrow.left');
			const rightArrow = wrapper.querySelector('.carousel-arrow.right');
			if (leftArrow && rightArrow) {
				leftArrow.addEventListener('click', () => {
					current = (current - 1 + slides.length) % slides.length;
					showSlide(current);
				});
				rightArrow.addEventListener('click', () => {
					current = (current + 1) % slides.length;
					showSlide(current);
				});
			}
		}
	});
});



// css animate observer
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
