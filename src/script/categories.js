const category = document.getElementById("category");
const newCategory = document.getElementById("new-category");
const addNewCategory = document.getElementById("add-category");
const cancelNewCategory = document.getElementById("cancel-category");

const toggleCategory = (categoryIsVisible = true) => {
  if (categoryIsVisible) {
    addNewCategory.classList.add("hidden");
    cancelNewCategory.classList.remove("hidden");
    newCategory.classList.remove("hidden");
    newCategory.focus();
    category.removeAttribute("required");
    category.classList.add("hidden");
  } else {
    addNewCategory.classList.remove("hidden");
    cancelNewCategory.classList.add("hidden");
    newCategory.classList.add("hidden");
    category.setAttribute("required", "true");
    category.classList.remove("hidden");
  }
};

addNewCategory.addEventListener("click", toggleCategory);
cancelNewCategory.addEventListener("click", () => toggleCategory(false));
