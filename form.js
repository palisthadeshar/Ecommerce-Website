function validate() {
  alert('ldskf');
  var name = document.getElementById("name").value;
  var subject = document.getElementById("subject").value;
  var phone = document.getElementById("phone").value;
  var email = document.getElementById("email").value;
  var message = document.getElementById("message").value;
  var error_message = document.getElementById("error_message");

  error_message.style.padding = "10px";

  if (name.length < 5) {
    error_message.innerHTML = "Please Enter valid Name";

    return false;
  }
  if (subject.length < 10) {

    error_message.innerHTML = "Please Enter Correct Subject";
    return false;
  }
  if (isNaN(phone) || phone.length != 10) {

    error_message.innerHTML = "Please Enter valid Phone Number";
    return false;
  }
  if (email.indexOf("@") == -1 || email.length < 6) {

    error_message.innerHTML = "Please Enter valid Email";
    return false;
  }
  if (message.length <= 140) {

    error_message.innerHTML = "Please Enter More Than 140 Characters";
    return false;
  }
  alert("Form Submitted Successfully!");
  return true;
}