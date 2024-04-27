document.getElementById('input-file').addEventListener('change', function(event) {
    var profilePicture = document.getElementById('profilePicture');
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        profilePicture.src = e.target.result;
    };
    reader.readAsDataURL(file);
});