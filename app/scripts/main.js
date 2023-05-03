'use strict';

// Print the content of a div element
function printDiv(elem) {
    let mywindow = window.open();
    let content = document.getElementById(elem).innerHTML;
    let realContent = document.body.innerHTML;
    mywindow.document.write(content);
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
    mywindow.print();
    document.body.innerHTML = realContent;
    mywindow.close();

    return true;
}

// Preview Images before Upload
function readAndPreviewImage(file, elem) {
    // Make sure `file.name` matches our extensions criteria
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
        return alert(file.name + " is not an image");
    }

    var reader = new FileReader();
    reader.addEventListener("load", function () {
        var image = new Image();
        image.height = 80;
        image.width = 120;
        image.style.margin = "5px";
        image.title = file.name;
        image.src = this.result;
        elem.appendChild(image);
    });
    reader.readAsDataURL(file);
}