const submenu = document.getElementById("submenu");
const checkbox = document.getElementById("checkbox");

window.addEventListener("click", ({ target }) => {
  if (checkbox.checked && target.id === "checkbox") {
    submenu.classList.replace("hidden", "flex");
  } else {
    checkbox.checked = false;
    submenu.classList.replace("flex", "hidden");
  }
});
