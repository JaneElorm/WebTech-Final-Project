function openCourseModal(schoolCode, schoolName, categoryID) {
  var modal = document.getElementById("courseModal");
  modal.style.display = "block";

  document.getElementById('hiddenSchoolCode').value = schoolCode;
  document.getElementById('hiddenSchoolName').value = decodeURIComponent(schoolName);
  document.getElementById('hiddenSchoolCategory').value = categoryID;
}

document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("courseModal");
  var span = document.getElementsByClassName("close")[0];
  var confirmButton = document.getElementById("confirmCourseSelection");
  var radioButtons = document.querySelectorAll('input[name="course"]');

  // Function to close modal
  span.onclick = function() {
      modal.style.display = "none";
  }

  // Clicking anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }

  // Event listener for radio buttons
  radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
          confirmButton.disabled = false; // Enable the button when a course is selected
      });
  });

  // Function to handle confirmation button click
  confirmButton.onclick = function() {
      // You can add your logic here to handle the selected course
      modal.style.display = "none"; // Close the modal after confirmation
  }
});




