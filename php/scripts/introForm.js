document.getElementById('introForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const userData = {
            name: document.getElementById('name').value,
            location: document.getElementById('location').value,
            personalBackground: document.getElementById('personalBackground').value,
            professional: document.getElementById('professional').value,
            academic: document.getElementById('academic').value,
            subjectBackground: document.getElementById('subjectBackground').value,
            platform: document.getElementById('platform').value,
            courses: document.getElementById('courses').value,
            funny: document.getElementById('funny').value,
            other: document.getElementById('other').value,
        };


        document.getElementById('formSection').style.display = 'none';
        document.getElementById('introSection').style.display = 'block';

        
        document.getElementById('locationDisplay').textContent = userData.location;
        document.getElementById('personalBackgroundDisplay').textContent = userData.personalBackground;
        document.getElementById('professionalDisplay').textContent = userData.professional;
        document.getElementById('academicDisplay').textContent = userData.academic;
        document.getElementById('subjectBackgroundDisplay').textContent = userData.subjectBackground;
        document.getElementById('platformDisplay').textContent = userData.platform;
        document.getElementById('coursesDisplay').innerHTML = userData.courses.split('\n').map(course => `<li>${course}</li>`).join('');
        document.getElementById('funnyDisplay').textContent = userData.funny;
        document.getElementById('otherDisplay').textContent = userData.other;

        let coursesList = userData.courses.split('\n').map(course => `<li>${course}</li>`).join('');
    });
