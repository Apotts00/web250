document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("introForm");
  const resetBtn = document.getElementById("resetBtn");
  const imageInput = document.getElementById("imageInput");
  const displayImage = document.getElementById("displayImage");
  const previewImage = document.getElementById("previewImage");
  const formSection = document.getElementById("formSection");
  const introSection = document.getElementById("introSection");
  const addCourseBtn = document.getElementById("add-course-btn");
  const deleteCourseBtn = document.getElementById("delete-course-btn");
  const courseList = document.getElementById("courseList");

  // Show uploaded image
  imageInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (event) => {
        displayImage.src = event.target.result;
        displayImage.style.display = "block";
        previewImage.style.display = "none";
      };
      reader.readAsDataURL(file);
    }
  });

  // Add new course field
  addCourseBtn.addEventListener("click", () => {
    const input = document.createElement("input");
    input.type = "text";
    input.name = "courses[]";
    input.placeholder = "New Course: Reason";
    input.classList.add("course-input");
    courseList.insertBefore(input, addCourseBtn.parentElement);
  });

  // Delete last course field if more than one exists
  deleteCourseBtn.addEventListener("click", () => {
    const courseInputs = courseList.querySelectorAll("input.course-input");
    if (courseInputs.length > 1) {
      courseInputs[courseInputs.length - 1].remove();
    } else {
      alert("At least one course must remain.");
    }
  });

  // Handle form submit
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    formSection.style.display = "none";
    introSection.style.display = "block";

    document.getElementById("locationDisplay").textContent = form.location.value;
    document.getElementById("personalBackgroundDisplay").textContent = form.personalBackground.value;
    document.getElementById("professionalDisplay").textContent = form.professional.value;
    document.getElementById("academicDisplay").textContent = form.academic.value;
    document.getElementById("subjectBackgroundDisplay").textContent = form.subjectBackground.value;
    document.getElementById("platformDisplay").textContent = form.platform.value;
    document.getElementById("funnyDisplay").textContent = form.funny.value;
    document.getElementById("otherDisplay").textContent = form.other.value;

    const coursesDisplay = document.getElementById("coursesDisplay");
    coursesDisplay.innerHTML = "";

    const courses = form.querySelectorAll("input[name='courses[]']");
    courses.forEach((course) => {
      const li = document.createElement("li");
      li.textContent = course.value;
      coursesDisplay.appendChild(li);
    });
  });

  // Reset form and display
  resetBtn.addEventListener("click", () => {
    form.reset();
    previewImage.style.display = "block";
    displayImage.style.display = "none";
    formSection.style.display = "block";
    introSection.style.display = "none";
  });
});
