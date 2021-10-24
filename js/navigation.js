//Show section/name when button is clicked
let buttonitems = document.querySelectorAll(".btn");
let activeButton = document.querySelector(".btn.active");
let activetext = document.querySelector(".section.active");

buttonitems.forEach((item) => {
  const text = document.querySelector(".section");

  item.addEventListener("mouseover", function (e) {
    if (this.classList.contains("active")) return;
    this.classList.add("active");
    if (activeButton) {
      activeButton.classList.remove("active");
    }
    activeButton = this;
  });
});

