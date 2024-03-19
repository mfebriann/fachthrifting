const uploadImages = document.getElementById("submit-images");
if (uploadImages != null) {
  uploadImages.addEventListener("click", () => {
    const container = document.getElementById("container-images");
    const inputHidden = document.getElementById("id-images");
    const inputFile = document.getElementById("images");

    sendFiles(container, inputHidden, inputFile);
  });
}

const sendFiles = (container, inputHidden, inputFile) => {
  const file = inputFile.files[0];
  if (file) {
    const formData = new FormData();
    formData.append("action", "files");
    formData.append("files", file);
    formData.append("files_hidden", inputHidden.value);

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = this.responseText;
        if (response === "error") {
          Swal.fire("Gambar gagal di upload", "", "error");
        } else {
          const result = JSON.parse(response);
          previewAttachment(file, container, result["id"]);
          inputHidden.setAttribute("value", result["files"]);

          const btnDeleteElement = document.getElementById(result["id"]);
          btnDeleteElement.addEventListener("click", function () {
            btnDelete("no", btnDeleteElement);
          });
        }
      }
    };

    xhr.open("POST", "../utils/functions.php", true);
    xhr.send(formData);
  }
};

const previewAttachment = (file, container, id) => {
  const image = URL.createObjectURL(file);
  const fileName = file.name;

  const div = document.createElement("div");
  div.innerHTML = `<div class="w-40 bg-slate-100">
			<div class="header-files">
			${
        file.type.includes("image")
          ? `<img src="${image}" alt="attachment" class="h-40 w-full object-cover">`
          : `<div class="flex items-center justify-center h-full">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="80" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 438 512.37"><path fill-rule="nonzero" d="M107.62 54.52V25.03c0-6.9 2.82-13.16 7.34-17.69C119.49 2.82 125.75 0 132.65 0h191.46c3.22 0 6.1 1.45 8.03 3.74l102.87 105.4c1.97 2.03 2.96 4.66 2.96 7.29l.03 316.39c0 6.82-2.82 13.07-7.36 17.62l-.04.05c-4.57 4.54-10.82 7.36-17.63 7.36h-82.59v29.49c0 6.84-2.81 13.09-7.35 17.64l-.04.04c-4.57 4.54-10.8 7.35-17.64 7.35H25.03c-6.9 0-13.16-2.82-17.69-7.34C2.82 500.5 0 494.24 0 487.34V79.56c0-6.91 2.82-13.17 7.34-17.69 4.53-4.53 10.79-7.35 17.69-7.35h82.59zm309.41 76.03h-78.85c-8.54 0-16.31-3.51-21.95-9.14l-.04-.04c-5.64-5.64-9.14-13.41-9.14-21.95V20.97h-174.4c-1.1 0-2.12.46-2.86 1.2-.73.74-1.2 1.76-1.2 2.86v29.49h57.68c3.21 0 6.09 1.45 8.01 3.73l133.07 135.56c2 2.03 3 4.69 3 7.33l.03 235.73h82.59c1.11 0 2.12-.45 2.84-1.17l.04-.04c.72-.72 1.18-1.73 1.18-2.84V130.55zm-11.69-20.97-77.32-78.77v68.61c0 2.8 1.14 5.35 2.97 7.19 1.84 1.83 4.39 2.97 7.19 2.97h67.16zm-95.93 107.27h-106.4c-10.24 0-19.55-4.19-26.29-10.92-6.73-6.73-10.92-16.05-10.92-26.29V75.5H25.03c-1.1 0-2.12.46-2.86 1.2-.73.73-1.2 1.75-1.2 2.86v407.78c0 1.1.47 2.12 1.2 2.86.74.74 1.76 1.2 2.86 1.2h280.32c1.13 0 2.14-.45 2.85-1.16l.05-.05c.71-.71 1.16-1.72 1.16-2.85V216.85zm-12.14-20.97L186.77 83.31v96.33c0 4.45 1.84 8.52 4.78 11.46 2.95 2.95 7.01 4.78 11.46 4.78h94.26z"/></svg>
				</div>`
      }
			</div>
			<div class="flex flex-wrap justify-end gap-2 px-2 py-4">
						<a href="${image}" title="download" download="${fileName}" class="no-underline action-file block px-1 text-sm rounded cursor-pointer hover:opacity-70">
							<svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M0.583252 8.45829C0.583252 7.10006 1.29742 5.9086 2.37074 5.23899C2.66265 2.94229 4.62392 1.16663 6.99992 1.16663C9.37589 1.16663 11.3372 2.94229 11.6291 5.23899C12.7024 5.9086 13.4166 7.10006 13.4166 8.45829C13.4166 10.4542 11.8744 12.09 9.91659 12.2389L4.08325 12.25C2.12546 12.09 0.583252 10.4542 0.583252 8.45829ZM9.82809 11.0756C11.1892 10.9721 12.2499 9.83268 12.2499 8.45829C12.2499 7.54071 11.7765 6.70608 11.0116 6.22885L10.5416 5.93561L10.4717 5.3861C10.2511 3.65048 8.76672 2.33329 6.99992 2.33329C5.2331 2.33329 3.74869 3.65048 3.52809 5.3861L3.45825 5.93561L2.98827 6.22885C2.22333 6.70608 1.74992 7.54071 1.74992 8.45829C1.74992 9.83268 2.81061 10.9721 4.17174 11.0756L4.27284 11.0833H9.727L9.82809 11.0756ZM7.58325 6.99996H9.33325L6.99992 9.91663L4.66659 6.99996H6.41659V4.66663H7.58325V6.99996Z"
                  fill="#0B6AF8" />
              </svg>
						</a>
            <button type="button" class="cbtn-close btnDelete no-underline action-file flex items-center justify-center text-sm rounded cursor-pointer hover:opacity-70" id="${id}" title="Delete">
              <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-delete-file-attachment">
                <path
                  d="M2.16667 4.5H11.5V12.0833C11.5 12.4055 11.2388 12.6667 10.9167 12.6667H2.75C2.42784 12.6667 2.16667 12.4055 2.16667 12.0833V4.5ZM3.33333 5.66667V11.5H10.3333V5.66667H3.33333ZM5.08333 6.83333H6.25V10.3333H5.08333V6.83333ZM7.41667 6.83333H8.58333V10.3333H7.41667V6.83333ZM3.91667 2.75V1.58333C3.91667 1.26117 4.17784 1 4.5 1H9.16667C9.48884 1 9.75 1.26117 9.75 1.58333V2.75H12.6667V3.91667H1V2.75H3.91667ZM5.08333 2.16667V2.75H8.58333V2.16667H5.08333Z"
                  fill="#FF0000" />
              </svg>
						</button>
			</div>
		</div>`;

  container.prepend(div);
};

const btnDelete = (int = "no", btnDeleteElement, notAdd = false) => {
  const transactionId = document.getElementById("transaction-id").value;
  let delId = notAdd ? btnDeleteElement.id : $(btnDeleteElement).attr("id");
  const cardFile = btnDeleteElement.parentElement.parentElement.parentElement;
  const inputHidden = cardFile.parentElement.previousElementSibling.children[0];
  Swal.fire({
    title: "Apa kamu yakin mau menghapus?",
    text: "Kamu mau menghapus gambar ini?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Iya, hapus saja!",
  }).then(function (action) {
    if (action.isConfirmed) {
      var arrFileCode = inputHidden.value;
      $.ajax({
        url: "../utils/functions.php",
        type: "post",
        data: {
          action: "delDoc",
          delId,
          arrCode: arrFileCode,
          integer: int,
          transactionId,
          notAddPage: notAdd == true ? "true" : "false",
        },
        success: function (response) {
          console.log(response);
          const jsonResponse = JSON.parse(response);
          if (jsonResponse["success"] == "success") {
            cardFile.remove();
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
            if (jsonResponse["listArray"] == 0) {
              inputHidden.setAttribute("value", "");
            } else {
              inputHidden.setAttribute("value", jsonResponse["listArray"]);
            }
          }
        },
      });
    }
  });
};

// Delete image
const buttonsDeleteImage = document.querySelectorAll("button.action-file");
buttonsDeleteImage.forEach((buttonDeleteImage) => {
  buttonDeleteImage.addEventListener("click", function () {
    btnDelete("no", this, true);
  });
});
