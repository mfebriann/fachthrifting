const checkboxProduct = document.querySelector("#product-check");
const isProducts = document.querySelectorAll(".isproduct");
const isLabelProduct = document.querySelector(".islabelproduct");
const requiredInputs = Array.from(
  document.querySelectorAll("input[required], select[required]"),
);
const requiredInputsFirst = requiredInputs.slice(2, 4);
const requiredInputsLast = requiredInputs[5];
const mergeRequiredInputs = [...requiredInputsFirst, requiredInputsLast];

const checkedProduct = (checkbox) => {
  if (!checkbox.checked) {
    isProducts.forEach((isProduct) => {
      isProduct.classList.add("hidden");
    });

    mergeRequiredInputs.forEach((mergeRequired) => {
      mergeRequired.removeAttribute("required");
    });

    checkbox.value = "no";
    isLabelProduct.textContent = "Bukti Transfer";
  } else {
    isProducts.forEach((isProduct) => {
      isProduct.classList.remove("hidden");
    });

    mergeRequiredInputs.forEach((mergeRequired) => {
      mergeRequired.setAttribute("required", "true");
    });

    checkbox.value = "yes";
    isLabelProduct.textContent = "Gambar produk/Bukti transfer";
  }
};

document.addEventListener("DOMContentLoaded", () => {
  checkedProduct(checkboxProduct);

  checkboxProduct.addEventListener("change", () => {
    checkedProduct(checkboxProduct);
  });
});
