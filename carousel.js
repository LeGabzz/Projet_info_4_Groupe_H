const slideshowInner = document.querySelector('.slideshow-inner');
const images = slideshowInner.querySelectorAll('img');
const totalWidth = images.length * images[0].getBoundingClientRect().width;

let cloneFirstHalf = false;

function setup() {
  // Clone the first half of the images
  if (!cloneFirstHalf) {
    images.forEach(img => {
      const clone = img.cloneNode(true);
      slideshowInner.appendChild(clone);
    });
    cloneFirstHalf = true;
  }

  // Set the width of the slideshow inner to fit all images
  slideshowInner.style.width = `${totalWidth * 2}px`;

  // Start the animation
  startAnimation();
}

function startAnimation() {
  slideshowInner.style.animation = 'slide 40s linear infinite';
}

function resetAnimation() {
  slideshowInner.style.animation = 'none';
  slideshowInner.offsetHeight; // Trigger reflow
  startAnimation();
}

slideshowInner.addEventListener('animationiteration', resetAnimation);

window.addEventListener('load', setup);
