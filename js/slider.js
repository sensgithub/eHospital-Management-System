const slider = document.querySelector('.slider');
const slides = document.querySelector('.slides');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
let slideIndex = 0;

prevBtn.addEventListener('click', () => {
  slideIndex--;
  if (slideIndex < 0) {
    slideIndex = slides.children.length - 1;
  }
  updateSlide();
});

nextBtn.addEventListener('click', () => {
  slideIndex++;
  if (slideIndex >= slides.children.length) {
    slideIndex = 0;
  }
  updateSlide();
});

setInterval(() => {
  slideIndex++;
  if (slideIndex >= slides.children.length) {
    slideIndex = 0;
  }
  updateSlide();
}, 5000);

function updateSlide() {
  slides.style.transform = `translateX(-${slideIndex * 100 / slides.children.length}%)`;
}
