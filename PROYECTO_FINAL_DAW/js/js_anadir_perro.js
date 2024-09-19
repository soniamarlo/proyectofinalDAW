function doClick() {
    var el = document.getElementById("fileElem");
    if (el) {
        el.click();
    }
}

function sendFiles() {
    var imgs = document.querySelectorAll(".obj");

    for (var i = 0; i < imgs.length; i++) {
        new FileUpload(imgs[i], imgs[i].file);
    }
}

function FileUpload(img, file) {
    this.ctrl = createThrobber(img);
    var xhr = new XMLHttpRequest();
    this.xhr = xhr;

    var self = this;
    this.xhr.upload.addEventListener("progress", function (e) {
        if (e.lengthComputable) {
            var percentage = Math.round((e.loaded * 100) / e.total);
            self.ctrl.update(percentage);
        }
    }, false);

    xhr.upload.addEventListener("load", function (e) {
        self.ctrl.update(100);
        var canvas = self.ctrl.ctx.canvas;
        canvas.parentNode.removeChild(canvas);
    }, false);

    xhr.open("POST", "../php/anadirPerro.php"); 
    xhr.setRequestHeader("Content-Type", file.type);
    xhr.send(file);
}

function handleFiles(files) {
    var d = document.getElementById("fileList");
    if (!files.length) {
        d.innerHTML = "<p>¡No se han seleccionado imagens!</p>";
    } else {
        var list = document.createElement("ul");
        d.appendChild(list);
        for (var i = 0; i < files.length; i++) {
            var li = document.createElement("li");
            list.appendChild(li);

            var img = document.createElement("img");
            img.src = window.URL.createObjectURL(files[i]);
            img.height = 60;
            img.onload = function () {
                window.URL.revokeObjectURL(this.src);
            }
            li.appendChild(img);

            var info = document.createElement("span");
            info.innerHTML = files[i].name + ": " + files[i].size + " bytes";
            li.appendChild(info);
        }
    }
}