document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("introForm");
  const resetBtn = document.getElementById("resetBtn");
  const imageInput = document.getElementById("imageInput");
  const displayImage = document.getElementById("displayImage");
  const previewImage = document.getElementById("previewImage");
  const formSection = document.getElementById("formSection");
  const introSection = document.getElementById("introSection");
  const addCourseBtn = document.getElementById("add-course-btn");
  const courseList = document.getElementById("courseList");

  // Dynamically create Delete Course button
  const deleteCourseBtn = document.createElement("button");
  deleteCourseBtn.type = "button";
  deleteCourseBtn.id = "delete-course-btn";
  deleteCourseBtn.textContent = "Delete Last Course";
  deleteCourseBtn.className = "delete-course";
  courseList.appendChild(deleteCourseBtn);

  // Image preview
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

  // Add course field
  addCourseBtn.addEventListener("click", () => {
    const input = document.createElement("input");
    input.type = "text";
    input.name = "courses[]";
    input.placeholder = "New Course: Reason";
    input.classList.add("course-input");
    courseList.insertBefore(input, addCourseBtn);
  });

  // Delete last course field
  deleteCourseBtn.addEventListener("click", () => {
    const courseInputs = courseList.querySelectorAll("input.course-input");
    if (courseInputs.length > 1) {
      courseInputs[courseInputs.length - 1].remove();
    } else {
      alert("At least one course must remain.");
    }
  });

  // Submit form
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
      const strong = document.createElement("strong");
      strong.textContent = course.value;
      li.appendChild(strong);
      coursesDisplay.appendChild(li);
    });

    // Add a reset button below the generated intro
    if (!document.getElementById("resetIntroBtn")) {
      const resetIntroBtn = document.createElement("button");
      resetIntroBtn.id = "resetIntroBtn";
      resetIntroBtn.textContent = "Edit My Info";
      resetIntroBtn.className = "edit-info-btn";
      resetIntroBtn.style.marginTop = "20px";
      introSection.appendChild(resetIntroBtn);

      resetIntroBtn.addEventListener("click", () => {
        form.reset();
        previewImage.style.display = "block";
        displayImage.style.display = "none";
        introSection.style.display = "none";
        formSection.style.display = "block";
      });
    }
  });

  // Reset button (top form)
  resetBtn.addEventListener("click", () => {
    form.reset();
    previewImage.style.display = "block";
    displayImage.style.display = "none";
    introSection.style.display = "none";
    formSection.style.display = "block";
  });
});
