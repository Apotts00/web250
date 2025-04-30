<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/default.css" rel="stylesheet" type="text/css">
    <title>Adrienne Love 🐞 Ambitious Ladybug | Introduction</title>
    <link rel="icon" type="image/x-icon" href="images/favicon2.png">
    <script src="https://lint.page/kit/67ff88.js" crossorigin="anonymous"></script>
</head>
<body>
<div data-include="components/header.html"></div>

<main>
    <!-- Form Section -->
    <div id="formSection">
        <h2>Fill Your Intro</h2>
        <form id="introForm">
            <fieldset>
                <legend>Your Information</legend>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" value="Adrienne Love" required><br><br>

                <label for="imageInput">Upload Your Photo:</label>
                <input type="file" id="imageInput" name="profilePic" accept="image/*"><br><br> 
               
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="Charlotte, NC ❤️" required><br><br>

                <label for="personalBackground">Personal Background:</label>
                <textarea id="personalBackground" name="personalBackground" required>I was born and raised in Charlotte, NC. I am a wife, mother, and business owner.</textarea><br><br>

                <label for="professional">Professional Background:</label>
                <textarea id="professional" name="professional" required>I have a strong Financial background. I worked in Corporate America banking for almost 5 years and then transitioned to Real Estate. I currently work with a non-profit organization that enables me to give back and teach financial literacy to underserved communities.</textarea><br><br>

                <label for="academic">Academic Background:</label>
                <textarea id="academic" name="academic" required>I am a licensed Real Estate Agent and I am currently obtaining an Associate’s Degree in Full Stack Programming.</textarea><br><br>

                <label for="subjectBackground">Background in this Subject:</label>
                <textarea id="subjectBackground" name="subjectBackground" required>I am new to this subject. No prior experience.</textarea><br><br>

                <label for="platform">Primary Computer Platform:</label>
                <input type="text" id="platform" name="platform" value="Windows 10 Laptop" required><br><br>

                <label for="courses">Courses I'm Taking and Why:</label>
                <textarea id="courses" name="courses" required>
                    CSC221- Advanced Python Programming: It is required for my degree program, lol
                    CTS240- Project Management: It is required for my degree program, lol
                    WEB215- Advanced Web Markup and Scripting: It is required for my degree program, lol
                    WEB250 - Database Driven Websites: It is required for my degree program, lol
                </textarea><br><br>

                <label for="funny">Funny/Interesting Item:</label>
                <textarea id="funny" name="funny" required>I am the most introverted extrovert you will ever meet. 🙃</textarea><br><br>

                <label for="other">I'd also like to share:</label>
                <textarea id="other" name="other" required>I recently got married, and my new legal name is Adrienne Love!</textarea><br><br>

                <button type="submit">Generate My Page</button>
            </fieldset>
        </form>
    </div>
<script src="scripts/introForm.js"></script>
    
    <div id="introSection" style="display: none;">
        <h2>About The Owner</h2>
        <figure>
            
            
            <img id="previewImage" src="images/lover.png" alt="Beautiful Me ;-)" class="center" width="300" height="300">
            <img id="displayImage" src="images/lover.png" alt="Your Photo" class="center" width="300" height="300" style="display: none;">



            <figcaption><em id="locationDisplay">Charlotte, NC ❤️</em></figcaption>
        </figure>
        <ul>
            <li><strong>Personal Background:</strong> <span id="personalBackgroundDisplay">I was born and raised in Charlotte, NC. I am a wife, mother, and business owner.</span></li>
            <li><strong>Professional:</strong> <span id="professionalDisplay">I have a strong Financial background. I worked in Corporate America banking for almost 5 years and then transitioned to Real Estate. I currently work with a non-profit organization that enables me to give back and teach financial literacy to underserved communities.</span></li>
            <li><strong>Academic Background:</strong> <span id="academicDisplay">I am a licensed Real Estate Agent and I am currently obtaining an Associate’s Degree in Full Stack Programming.</span></li>
            <li><strong>Background in this Subject:</strong> <span id="subjectBackgroundDisplay">I am new to this subject. No prior experience.</span></li>
            <li><strong>Primary Computer Platform:</strong> <span id="platformDisplay">Windows 10 Laptop</span></li>
            <li><strong>Courses I'm Taking and Why:</strong>
                <ol id="coursesDisplay">
                    <li>CSC221- Advanced Python Programming: It is required for my degree program, lol</li>
                    <li>CTS240- Project Management: It is required for my degree program, lol</li>
                    <li>WEB215- Advanced Web Markup and Scripting: It is required for my degree program, lol</li>
                    <li>WEB250 - Database Driven Websites: It is required for my degree program, lol</li>
                </ol>
            </li>
            <li><strong>Funny/Interesting Item:</strong> <span id="funnyDisplay">I am the most introverted extrovert you will ever meet. 🙃</span></li>
            <li><strong>I'd also like to share:</strong> <span id="otherDisplay">I recently got married, and my new legal name is Adrienne Love!</span></li>
        </ul>
    </div>
</main>

<div data-include="components/footer.html"></div>
<script src="scripts/HTMLInclude.js"></script>


</body>
</html>
