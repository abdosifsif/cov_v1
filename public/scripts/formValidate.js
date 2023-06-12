const form = document.getElementById('registration-form');
const submitButton = document.getElementById('submit-button');

submitButton.addEventListener('click', function(event) {
  event.preventDefault();

  // Get form input values
  const nom = form.querySelector('input[name="nom"]');
  const prenom = form.querySelector('input[name="prenom"]');
  const telephone = form.querySelector('input[name="telephone"]');
  const date = form.querySelector('input[name="date"]');
  const sexe = form.querySelector('input[name="sexe"]:checked');
  const email = form.querySelector('input[name="email"]');
  const ville = form.querySelector('select[name="ville"]');
  const selectBox = document.querySelector('.select-box');
  const villeErrorMessage = form.querySelector('select[name="ville"] + .error-message');
  const password = form.querySelector('input[name="password"]');
  const passwordConfirmation = form.querySelector('input[name="password_confirmation"]');

  // Validate form input values
  if (nom.value.trim() === '') {
    nom.style.borderColor = 'red';
    const errorMessage = nom.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez entrer votre nom.';
    }
    return;
  } else {
    nom.style.borderColor = 'initial';
    const errorMessage = nom.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  if (prenom.value.trim() === '') {
    prenom.style.borderColor = 'red';
    const errorMessage = prenom.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez entrer votre prénom.';
    }
    return;
  } else {
    prenom.style.borderColor = 'initial';
    const errorMessage = prenom.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  if (telephone.value.trim() === '') {
    telephone.style.borderColor = 'red';
    const errorMessage = telephone.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez entrer votre numéro de téléphone.';
    }
    return;
  } else if (!/^(06|07)\d{8}$/.test(telephone.value.trim())) {
    telephone.style.borderColor = 'red';
    const errorMessage = telephone.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Le numéro de téléphone doit commencer par 06 ou 07 et contenir 10 chiffres.';
    }
    return;
  } else {
    telephone.style.borderColor = 'initial';
    const errorMessage = telephone.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  if (date.value === '') {
    date.style.borderColor = 'red';
    const errorMessage = date.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez entrer votre date de naissance.';
    }
    return;
  } else {
    date.style.borderColor = 'initial';
    const errorMessage = date.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  if (email.value.trim() === '') {
    email.style.borderColor = 'red';
    const errorMessage = email.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez entrer votre adresse email.';
    }
    return;
  } else if (!/^\S+@\S+\.\S+$/.test(email.value.trim())) {
    email.style.borderColor = 'red';
    const errorMessage = email.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez entrer une adresse email valide.';
    }
    return;
  } else {
    email.style.borderColor = 'initial';
    const errorMessage = email.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  if (ville.value === 'Ville') {
    selectBox.style.borderColor = 'red';
    if (villeErrorMessage !== null) {
      villeErrorMessage.textContent = 'Veuillez choisir votre ville.';
    }
    return;
  } else {
    selectBox.style.borderColor = 'initial';
    if (villeErrorMessage !== null) {
      villeErrorMessage.textContent = '';
    }
  }
  if (password.value.length < 8) {
    password.style.borderColor = 'red';
    const errorMessage = password.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
    }
    return;
  } else {
    password.style.borderColor = 'initial';
    const errorMessage = password.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }
  if (password.value === '') {
    password.style.borderColor = 'red';
    const errorMessage = password.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez entrer votre mot de passe.';
    }
    return;
  } else {
    password.style.borderColor = 'initial';
    const errorMessage = password.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  if (passwordConfirmation.value === '') {
    passwordConfirmation.style.borderColor = 'red';
    const errorMessage = passwordConfirmation.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Veuillez confirmer votre mot de passe.';
    }
    return;
  } else {
    passwordConfirmation.style.borderColor = 'initial';
    const errorMessage = passwordConfirmation.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  if (password.value !== passwordConfirmation.value) {
    password.style.borderColor = 'red';
    passwordConfirmation.style.borderColor = 'red';
    const errorMessage = passwordConfirmation.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = 'Les mots de passe ne correspondent pas.';
    }
    return;
  } else {
    password.style.borderColor = 'initial';
    passwordConfirmation.style.borderColor = 'initial';
    const errorMessage = passwordConfirmation.nextElementSibling;
    if (errorMessage !== null) {
      errorMessage.textContent = '';
    }
  }

  // Check if email is already in the database
  const xhr = new XMLHttpRequest();
  xhr.open('GET', `/api/check-email?email=${encodeURIComponent(email.value.trim())}`);
  xhr.onload = function() {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.exists) {
        // Display an error message for the email input if it already exists in the database
        email.style.borderColor = 'red';
        const errorMessage = email.nextElementSibling;
        if (errorMessage !== null) {
          errorMessage.textContent = 'Cet email est déjà utilisé.';
        }
      } else {
        // Submit the form if the email doesn't exist in the database and all input values are valid
        nom.style.borderColor = 'initial';
        prenom.style.borderColor = 'initial';
        telephone.style.borderColor = 'initial';
        date.style.borderColor = 'initial';
        email.style.borderColor = 'initial';
        selectBox.style.borderColor = 'initial';
        password.style.borderColor = 'initial';
        passwordConfirmation.style.borderColor = 'initial';
        form.submit();
      }
    }
  };
  xhr.send();
});

var profileImage = document.getElementById('profile-image');
var imageInput = document.getElementById('image-input');
var previewImage = document.getElementById('preview-image');

profileImage.addEventListener('click', function() {
  imageInput.click();
});

imageInput.addEventListener('change', function() {
  if (imageInput.files && imageInput.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      console.log(e.target.result);
      previewImage.src = e.target.result;
    };

    reader.readAsDataURL(imageInput.files[0]);
  }
});
