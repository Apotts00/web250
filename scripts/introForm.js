document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("introForm");
    const introSection = document.getElementById("introSection");
    const formSection = document.getElementById("formSection");
    const previewImage = document.getElementById("previewImage");
    const displayImage = document.getElementById("displayImage");
    const addCourseBtn = document.getElementById("add-course-btn");
    const courseList = document.getElementById("courseList");

    // Add new course input
    addCourseBtn.addEventListener("click", () => {
        const input = document.createElement("input");
        input.type = "text";
        input.name = "courses[]";
        input.className = "course-input";
        input.placeholder = "Course-ID: Reason for taking it";
        courseList.insertBefore(input, addCourseBtn);
    });

    // Handle form submission
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        // Hide form, show intro
        formSection.style.display = "none";
        introSection.style.display = "block";

        // Update image if uploaded
        const imageInput = document.getElementById("imageInput");
        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                displayImage.src = e.target.result;
                displayImage.style.display = "block";
                previewImage.style.display = "none";
            };
            reader.readAsDataURL(imageInput.files[0]);
        }

        // Display name in header if needed
        const name = document.getElementById("name").value;
        document.querySelector("h2").textContent = `About ${name}`;

        // Display location
        document.getElementById("locationDisplay").textContent =
            document.getElementById("location").value;

        // Display text fields
        document.getElementById("personalBackgroundDisplay").textContent =
            document.getElementById("personalBackground").value;

        document.getElementById("professionalDisplay").textContent =
            document.getElementById("professional").value;

        document.getElementById("academicDisplay").textContent =
            document.getElementById("academic").value;

        document.getElementById("subjectBackgroundDisplay").textContent =
            document.getElementById("subjectBackground").value;

        document.getElementById("platformDisplay").textContent =
            document.getElementById("platform").value;

        document.getElementById("funnyDisplay").textContent =
            document.getElementById("funny").value;

        document.getElementById("otherDisplay").textContent =
            document.getElementById("other").value;

        // Display courses
        const coursesDisplay = document.getElementById("coursesDisplay");
        coursesDisplay.innerHTML = ""; // Clear previous

        const courseInputs = form.querySelectorAll("input[name='courses[]']");
        courseInputs.forEach((input) => {
            const [courseId, ...rest] = input.value.split(":");
            const reason = rest.join(":").trim();
            const li = document.createElement("li");
            li.innerHTML = `<strong>${courseId.trim()}</strong>: ${reason}`;
            coursesDisplay.appendChild(li);
        });

        // Add reset button
        if (!document.getElementById("resetButton")) {
            const resetBtn = document.createElement("button");
            resetBtn.textContent = "Reset Form";
            resetBtn.id = "resetButton";
            resetBtn.style.marginTop = "20px";
            introSection.appendChild(resetBtn);

            resetBtn.addEventListener("click", () => {
                form.reset();
                // Remove dynamic course fields except first three
                const allInputs = courseList.querySelectorAll("input[name='courses[]']");
                allInputs.forEach((input, index) => {
                    if (index > 2) input.remove();
                });

                previewImage.style.display = "block";
                displayImage.style.display = "none";
                formSection.style.display = "block";
                introSection.style.display = "none";
            });
        }
    });
});
