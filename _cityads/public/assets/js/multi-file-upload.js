document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".multi-file-upload").forEach(uploadBox => {
        let fileInput = uploadBox.querySelector(".multi-file-input");
        let previewContainer = uploadBox.querySelector(".multi-preview");

        let selectedFiles = []; // new files

        // 🔹 New files select
        fileInput.addEventListener("change", function () {
            [...this.files].forEach(file => {
                selectedFiles.push(file);

                let reader = new FileReader();
                reader.onload = e => {
                    let box = document.createElement("div");
                    box.classList.add("preview-box");
                    box.innerHTML = `
                        <img src="${e.target.result}" class="preview-img">
                        <button type="button" class="remove-btn">&times;</button>
                    `;
                    box.querySelector(".remove-btn").addEventListener("click", () => {
                        selectedFiles = selectedFiles.filter(f => f !== file);
                        box.remove();
                    });
                    previewContainer.appendChild(box);
                };
                reader.readAsDataURL(file);
            });

            this.value = "";
        });

        // 🔹 Already uploaded images remove
        previewContainer.querySelectorAll(".remove-btn").forEach(btn => {
            btn.addEventListener("click", function () {
                let box = this.closest(".preview-box");
                let existing = box.getAttribute("data-existing"); // filename

                if (existing) {
                    // Add hidden input remove_images[]
                    let removeInput = document.createElement("input");
                    removeInput.type = "hidden";
                    removeInput.name = "remove_images[]";
                    removeInput.value = existing;
                    uploadBox.appendChild(removeInput);
                }

                box.remove();
            });
        });

        // 🔹 Form submit: bind all selectedFiles to input
        uploadBox.closest("form").addEventListener("submit", function () {
            let dt = new DataTransfer();
            selectedFiles.forEach(f => dt.items.add(f));
            fileInput.files = dt.files;
        });
    });
});
