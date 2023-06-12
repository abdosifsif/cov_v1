
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
 // Sélectionne les boutons
 const btnSection1 = document.getElementById('btnprofile');
 const btnSection2 = document.getElementById('btntrajets');
 const btnSection3 = document.getElementById('btnpreferences');
 const btnSection4 = document.getElementById('btnvoiture');

 // Sélectionne les sections correspondantes
 const section1 = document.getElementById('profile');
 const section2 = document.getElementById('trajets');
 const section3 = document.getElementById('preferences');
 const section4 = document.getElementById('voiture');

 // Fonctions pour afficher/cacher les sections
 function afficherSection1() {
     section1.style.display = 'block';
     section2.style.display = 'none';
     section3.style.display = 'none';
     section4.style.display = 'none';
     btnSection1.classList.add('active');
     btnSection2.classList.remove('active');
     btnSection3.classList.remove('active');
     btnSection4.classList.remove('active');
 }

 function afficherSection2() {
     section1.style.display = 'none';
     section2.style.display = 'flex';
     section3.style.display = 'none';
     section4.style.display = 'none';
     btnSection1.classList.remove('active');
     btnSection2.classList.add('active');
     btnSection3.classList.remove('active');
     btnSection4.classList.remove('active');
 }

 function afficherSection3() {
     section1.style.display = 'none';
     section2.style.display = 'none';
     section3.style.display = 'block';
     section4.style.display = 'none';
     btnSection1.classList.remove('active');
     btnSection2.classList.remove('active');
     btnSection3.classList.add('active');
     btnSection4.classList.remove('active');
 }

 function afficherSection4() {
     section1.style.display = 'none';
     section2.style.display = 'none';
     section3.style.display = 'none';
     section4.style.display = 'block';
     btnSection1.classList.remove('active');
     btnSection2.classList.remove('active');
     btnSection3.classList.remove('active');
     btnSection4.classList.add('active');
 }

 // Affiche la section Profile par défaut
 afficherSection1();

 // Associe les fonctions aux événements de clic sur les boutons
 btnSection1.addEventListener('click', afficherSection1);
 btnSection2.addEventListener('click', afficherSection2);
 btnSection3.addEventListener('click', afficherSection3);
 btnSection4.addEventListener('click', afficherSection4);

 function updateRadioStyle(groupName) {
     var radios = document.getElementsByName(groupName);
     radios.forEach(function(radio) {
         var label = radio.nextElementSibling;
         if (radio.checked) {
             label.classList.add("selected");
         } else {
             label.classList.remove("selected");
         }
     });
 };



 var input = document.getElementById('image-input');

 input.addEventListener('change', function(event) {
     console.log('File selected');
     var file = event.target.files[0];

     var reader = new FileReader();

     reader.onload = function(e) {
         var previewImage = document.getElementById('preview-image');

         previewImage.src = e.target.result;
     }

     reader.readAsDataURL(file);
 });