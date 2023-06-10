const observer = new IntersectionObserver((entries)=>{
    entries.forEach((entry)=>{ 
        console.log(entry)
        if (entry.isIntersecting) {
            entry.target.classList.add('show')
        }else{
            entry.target.classList.remove('show')

        }

    })
})

const hiddenElemnts = document.querySelectorAll('.hidden');
hiddenElemnts.forEach((el)=>observer.observe(el));








function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function validateForm() {
    var password = document.getElementById("password").value;
    var password_confirmation = document.getElementById(
        "password_confirmation"
    ).value;

    if (password != password_confirmation) {
        document.getElementById("password").style.borderColor = "red";
        document.getElementById("password_confirmation").style.borderColor =
            "red";
        document.getElementById("password_confirmation").style.borderWidth = "2px";
        document.getElementById("password").style.borderWidth = "2px";
        // document.getElementById("password").style.borderStyle = "dotted";
        // document.getElementById("password_confirmation").style.borderStyle = "dotted";
        return false;
    }

    return true;
}

var passwordInput = document.getElementById("password");
var passwordConfirmationInput = document.getElementById(
    "password_confirmation"
);

passwordInput.addEventListener("input", function () {
    resetBorderColor(this);
    resetBorderWidth(this);
});

passwordConfirmationInput.addEventListener("input", function () {
    resetBorderColor(this);
    resetBorderWidth(this);
});

function resetBorderColor(inputElement) {
    inputElement.style.borderColor = "";
}
function resetBorderWidth(inputElement) {
  inputElement.style.borderWidth = "1px";
}

function showMenu() {
    var subMenu = document.getElementById("subMenu");
    if (subMenu.style.display === "block") {
        subMenu.style.display = "none";
    } else {
        subMenu.style.display = "block";
    }
}

document.addEventListener("click", function (event) {
    var subMenu = document.getElementById("subMenu");
    var userPic = document.querySelector(".user-pic");

    if (event.target !== userPic && !subMenu.contains(event.target)) {
        subMenu.style.display = "none";
    }
});