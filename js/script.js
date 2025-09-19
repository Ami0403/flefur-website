let slides = document.querySelectorAll(".offer-slide");
let currentIndex = 0;
let slideInterval;

// Show slide
function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
  });

  slides[index].classList.add("active");
  currentIndex = index;
}

// Next slide
function nextSlide() {
  currentIndex++;
  if (currentIndex >= slides.length) {
    currentIndex = 0;
  }
  showSlide(currentIndex);
}

// Auto play
function startSlider() {
  slideInterval = setInterval(nextSlide, 4000); // 3s delay
}

// Start slider
startSlider();

document.addEventListener('DOMContentLoaded', () => {
  const sections = document.querySelectorAll('.stagger');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target); // animate only once
      }
    });
  }, {
    threshold: 0.2  // trigger when 20% of section is visible
  });

  sections.forEach(el => observer.observe(el));
});

    document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab-btn");
  const contents = document.querySelectorAll(".tab-content");

  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      // Remove active from all tabs
      tabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");

      // Hide all contents
      contents.forEach(c => c.classList.add("hidden"));

      // Show target section
      const target = document.getElementById(tab.dataset.target);
      target.classList.remove("hidden");
    });
  });
});


  document.querySelectorAll(".clickable-text").forEach(item => {
    item.addEventListener("click", function () {
      const targetId = this.getAttribute("data-target");
      const target = document.getElementById(targetId);
      if (target) {
        target.scrollIntoView({ behavior: "smooth" });
      }
    });
  });

   // Redirect to addtocart.php when button clicked
            viewproduct.addEventListener('click', () => {
                window.location.href = "addtocart.php";
            });



