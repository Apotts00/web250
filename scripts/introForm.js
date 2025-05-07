
    document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("introForm");
      const formSection = document.getElementById("formSection");
      const introSection = document.getElementById("introSection");
      const coursesContainer = document.getElementById("coursesContainer");
      const addCourseBtn = document.getElementById("addCourseBtn");
      const resetBtn = document.getElementById("resetBtn");

      function addCourseField(name = "", reason = "") {
        const div = document.createElement("div");
        div.classList.add("courseField");

        const nameInput = document.createElement("input");
        nameInput.type = "text";
        nameInput.name = "courseName";
        nameInput.value = name;

        const reasonInput = document.createElement("input");
        reasonInput.type = "text";
        reasonInput.name = "courseReason";
        reasonInput.value = reason;

        const removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.textContent = "Remove";
        removeBtn.className = "removeCourseBtn";
        removeBtn.addEventListener("click", () => div.remove());

        div.appendChild(nameInput);
        div.appendChild(reasonInput);
        div.appendChild(removeBtn);

        coursesContainer.appendChild(div);
      }

      addCourseBtn.addEventListener("click", () => addCourseField());

      resetBtn.addEventListener("click", () => {
        form.reset();
        coursesContainer.innerHTML = "";
        addCourseField("CSC221- Advanced Python Programming", "It is required for my degree program, lol");
        introSection.style.display = "none";
        formSection.style.display = "block";
      });

      form.addEventListener("submit", function (e) {
        e.preventDefault();
        formSection.style.display = "none";
        introSection.style.display = "block";

        const fileInput = document.getElementById("imageInput");
        const displayImage = document.getElementById("displayImage");
        const previewImage = document.getElementById("previewImage");

        if (fileInput.files.length > 0) {
          const reader = new FileReader();
          reader.onload = function (event) {
            displayImage.src = event.target.result;
            displayImage.style.display = "block";
            previewImage.style.display = "none";
          };
          reader.readAsDataURL(fileInput.files[0]);
        }

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
        const courseNames = form.querySelectorAll("input[name='courseName']");
        const courseReasons = form.querySelectorAll("input[name='courseReason']");

        for (let i = 0; i < courseNames.length; i++) {
          const li = document.createElement("li");
          li.innerHTML = `<strong>${courseNames[i].value}</strong>: ${courseReasons[i].value}`;
          coursesDisplay.appendChild(li);
        }
      });

      if (coursesContainer.children.length === 0) {
        addCourseField("CSC221- Advanced Python Programming", "It is required for my degree program, lol");
      }
    });
 
