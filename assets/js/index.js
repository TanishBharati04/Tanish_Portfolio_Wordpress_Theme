// Project Slider
let scrollAmount = 0;
const scrollStep = 500;
const projectGrid = document.querySelector(".project-grid");

const slideLeft = () => {
  scrollAmount -= scrollStep;

  if(scrollAmount < 0) {
    scrollAmount = 0;
  }

  projectGrid.scrollTo({
    left: scrollAmount,
    behavior: "smooth"
  });
};

const slideRight = () => {
  const maxScroll = projectGrid.scrollWidth - projectGrid.clientWidth;
  scrollAmount += scrollStep;

  if(scrollAmount > maxScroll) {
    scrollAmount = maxScroll;
  }

  projectGrid.scrollTo({
    left: scrollAmount,
    behavior: "smooth"
  });
};

// Dark Mode Toggle Button
const toggleBtn = document.getElementById("toggle-btn");
const lightIcon = document.getElementById("light-icon");
const darkIcon = document.getElementById("dark-icon");

const savedDarkMode = localStorage.getItem("dark-mode");

if(savedDarkMode === "enabled") {
  document.body.classList.add("dark-mode");
  darkIcon.style.display = "none";
  lightIcon.style.display = "block";
} else {
  darkIcon.style.display = "block";
  lightIcon.style.display = "none";
}

toggleBtn.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");

  if(document.body.classList.contains("dark-mode")) {
    localStorage.setItem("dark-mode", "enabled");
    
    darkIcon.style.display = "none";
    lightIcon.style.display = "block";
  } else {
    localStorage.setItem("dark-mode", "disabled");
    
    darkIcon.style.display = "block";
    lightIcon.style.display = "none";
  }
});

// Scroll Top Button
const scrollTopBtn = document.getElementById("scroll-top-btn");

window.onscroll = () => {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    scrollTopBtn.style.display = "block";
  } else {
    scrollTopBtn.style.display = "none";
  }
};

scrollTopBtn.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});