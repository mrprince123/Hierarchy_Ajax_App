
// This is for showing the live photo selected by the user. 
function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    var imgtag = document.getElementById("profilePic");
    imgtag.title = selectedFile.name;

    reader.onload = function (event) {
        imgtag.src = event.target.result;
    };

    reader.readAsDataURL(selectedFile);
}

// Steps 
// Get the Date input from the dab input
// After that get the today date 
// After calculating the value 
// Show the value into the value attribute.

function myFun() {

    const dob_input_Data = document.getElementById('dob_input').value;
    const dobYear = new Date(dob_input_Data).getFullYear();

    var today = new Date();
    const currentYear = today.getFullYear();

    const age = currentYear - dobYear;
    console.log(age);

    const age_input = document.getElementById('age');
    age_input.value = age + " Years";
}
