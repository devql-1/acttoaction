document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".file-upload").forEach(uploadBox => {
        let fileInput = uploadBox.querySelector(".file-input");
        let previewBox = uploadBox.querySelector(".file-preview");
        let removeBtn = uploadBox.querySelector(".remove-btn");
        let removeFlag = uploadBox.querySelector(".remove-flag");

        if (!fileInput) return;

        fileInput.addEventListener("change", function () {
            if (this.files && this.files[0]) {
                let file = this.files[0];
                let fileURL = URL.createObjectURL(file);

                // clear previous preview
                previewBox.innerHTML = "";

                if (file.type.startsWith("video")) {
                    previewBox.innerHTML = `
                        <video src="${fileURL}" controls muted class="preview-img" style="hieght:150px;max-height:200px;"></video>
                        <div class="file-info"><span class="file-name">${file.name}</span></div>
                        <button type="button" class="remove-btn">&times;</button>
                    `;
                } else {
                    previewBox.innerHTML = `
                        <img src="${fileURL}" class="preview-img" style="max-height:200px;">
                        <div class="file-info"><span class="file-name">${file.name}</span></div>
                        <button type="button" class="remove-btn">&times;</button>
                    `;
                }

                previewBox.classList.remove("d-none");
                if (removeFlag) removeFlag.value = "0";

                // rebind remove button
                previewBox.querySelector(".remove-btn").addEventListener("click", function () {
                    fileInput.value = "";
                    previewBox.classList.add("d-none");
                    if (removeFlag) removeFlag.value = "1";
                });
            }
        });
    });
});
