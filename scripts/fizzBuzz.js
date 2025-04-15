
    document.getElementById('fizzBuzzForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    const firstName = document.getElementById('firstName').value;
    const middleInitial = document.getElementById('middleInitial').value;
    const lastName = document.getElementById('lastName').value;
    const defaultWord = document.getElementById('defaultWord').value;
    const count = parseInt(document.getElementById('count').value, 10);
    const word1 = document.getElementById('word1').value;
    const word2 = document.getElementById('word2').value;
    const word3 = document.getElementById('word3').value;
    const divisor1 = parseInt(document.getElementById('divisor1').value, 10);
    const divisor2 = parseInt(document.getElementById('divisor2').value, 10);
    const divisor3 = parseInt(document.getElementById('divisor3').value, 10);

    // Construct the welcome message
    let welcomeMessage = `Welcome, ${firstName} ${middleInitial ? middleInitial + '. ' : ''}${lastName}!`;
    document.getElementById('welcomeMessage').textContent = welcomeMessage;

    // Generate FizzBuzz list
    const fizzbuzzResults = [];
    for (let i = 1; i <= count; i++) {
        let result = '';
        if (i % divisor1 === 0) result += word1;
        if (i % divisor2 === 0) result += word2;
        if (i % divisor3 === 0) result += word3;
        if (result === '') result = defaultWord;
        fizzbuzzResults.push(`<li>${i}: ${result}</li>`);
    }

    // Display the results in the <ul>
    document.getElementById('fizzbuzzResults').innerHTML = fizzbuzzResults.join('');
});
