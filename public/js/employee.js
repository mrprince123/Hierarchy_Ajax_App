{/* // Steps 
// Get the Date input from the dab input
// After that get the today date 
// After calculating the value 
// Show the value into the value attribute. */}

function myFun() {

    const dob_input_Data = document.getElementById('dob_input').value;
    const dobYear = new Date(dob_input_Data).getFullYear();

    var today = new Date();
    const currentYear = today.getFullYear();

    const age = currentYear - dobYear;
    console.log(age);

    const age_input = document.getElementById('age');
    age_input.style.opacity = '0.5';
    age_input.value = age + " Years";
}


// For the Phone number Validation
function myPhoneCount() {
    let phoneNumber = document.getElementById('mobile_number').value;
    if (phoneNumber.length < 12 || phoneNumber.length > 12) {
        let phoneCo = document.getElementById('mobile_number');
        phoneCo.style.borderColor = "#FF0000";
        let phoneErrorText = document.getElementById('phone_error_text');
        phoneErrorText.innerText = "Phone number must of 10 digit only";
    }
}

// For the Emergency number Validation
function myEmergencyPhoneCount() {
    let emergencyNumber = document.getElementById('emergency_number').value;
    if (emergencyNumber.length < 12 || emergencyNumber.length > 12) {
        let emergencyCo = document.getElementById('emergency_number');
        emergencyCo.style.borderColor = "#FF0000";
        let errorText = document.getElementById('emergency_error_text');
        errorText.innerText = "Emergency Phone number must of 10 digit only";
    }
}


// This is for the Phone Number 
function formatPhoneNumber(value) {
    if (!value) return value;
    const phoneNumber = value.replace(/[^\d]/g, '');
    const phoneNumberLength = phoneNumber.length;
    if (phoneNumberLength < 4) return phoneNumber;
    if (phoneNumberLength < 7) {
        return `(${phoneNumber.slice(0, 3)}-${phoneNumber.slice(3)}`;
    }
    return `${phoneNumber.slice(0, 3)}-${phoneNumber.slice(3, 6)
        }-${phoneNumber.slice(6, 9)}`;
}

function myInputFun() {
    // Get the phone input field
    const phoneInputValue = document.getElementById('mobile_number');
    const formattedInputValue = formatPhoneNumber(phoneInputValue.value);
    phoneInputValue.value = formattedInputValue;
}


// This is for the Emergency Phone Number 
function formatEmergencyPhoneNumber(value) {
    if (!value) return value;
    const EmergencyPhoneNumber = value.replace(/[^\d]/g, '');
    const EmergencyPhoneNumberLength = EmergencyPhoneNumber.length;
    if (EmergencyPhoneNumberLength < 4) return EmergencyPhoneNumber;
    if (EmergencyPhoneNumberLength < 7) {
        return `(${EmergencyPhoneNumber.slice(0, 3)}-${EmergencyPhoneNumber.slice(3)}`;
    }
    return `${EmergencyPhoneNumber.slice(0, 3)}-${EmergencyPhoneNumber.slice(3, 6)
        }-${EmergencyPhoneNumber.slice(6, 9)}`;
}

function myEmerFun() {
    // Get the phone input field
    const EmergencyPhoneInputValue = document.getElementById('emergency_number');
    const formattedEmerInputValue = formatEmergencyPhoneNumber(EmergencyPhoneInputValue.value);
    EmergencyPhoneInputValue.value = formattedEmerInputValue;
}