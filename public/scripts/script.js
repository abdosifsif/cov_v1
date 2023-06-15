function openPopup(trajetId) {
    let overlay = document.getElementById(`overlay${trajetId}`);
    let popup = document.getElementById(`popup${trajetId}`);
    let qrCodeElement = document.getElementById(`qrcode${trajetId}`);

    overlay.style.visibility = "visible";
    qrCodeElement.style.visibility = "visible";
    popup.classList.add("open-popup");

    // Scroll to the popup
    popup.scrollIntoView({ behavior: "smooth" });
}

function closePopup(trajetId) {
    let overlay = document.getElementById(`overlay${trajetId}`);
    let popup = document.getElementById(`popup${trajetId}`);
    let qrCodeElement = document.getElementById(`qrcode${trajetId}`);


    overlay.style.visibility = "hidden";
    qrCodeElement.style.visibility = "hidden";
    popup.classList.remove("open-popup");
}

let qrCodeGenerated = {};

function generateQRCode(trajetId, phoneNumber) {
    let qrCodeElement = document.querySelector(`.qrcode${trajetId}`);

    if (!(trajetId in qrCodeGenerated)) {
        let qrCodeElement = document.getElementById(`qrcode${trajetId}`);
        let qrCode = new QRCode(qrCodeElement, {
            text: phoneNumber,
            width: 128,
            height: 128
        });

        qrCodeGenerated[trajetId] = true; // Set the flag to indicate QR code generation
    } 
}