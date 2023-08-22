// slideshow.js

const images = document.querySelectorAll('.work__img img');
const totalImages = images.length;
const shuffleInterval = 3000; // Change images every 3 seconds

function shuffleImages() {
  const imageIndices = Array.from({ length: totalImages }, (_, index) => index);
  for (let i = totalImages - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [imageIndices[i], imageIndices[j]] = [imageIndices[j], imageIndices[i]];
  }

  images.forEach((image, index) => {
    image.src = `assets/img/work${imageIndices[index] + 1}.jpg`;
  });
}

// Shuffle the images initially
shuffleImages();

// Set an interval to shuffle the images every `shuffleInterval` milliseconds
setInterval(shuffleImages, shuffleInterval);
