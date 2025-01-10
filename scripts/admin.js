document.getElementById('addFilmForm').addEventListener('input', function (event) {
    const target = event.target;
    if (target.value.trim() === '') {
        target.style.borderColor = 'red';
    } else {
        target.style.borderColor = 'green';
    }


    localStorage.setItem(target.id, target.value);
});


window.addEventListener('load', function () {
    const inputs = document.querySelectorAll('#addFilmForm input');
    inputs.forEach(input => {
        if (localStorage.getItem(input.id)) {
            input.value = localStorage.getItem(input.id);
        }
    });
});


document.getElementById('addFilmForm').addEventListener('submit', function (event) {
    const inputs = document.querySelectorAll('#addFilmForm input');
    let isValid = true;

    inputs.forEach(input => {
        const value = input.value.trim();


        if (value === '') {
            isValid = false;
            input.style.borderColor = 'red';
        } else {
            input.style.borderColor = 'green';
        }


        if (input.id === 'title') { 
            if (value.length < 3) {
                isValid = false;
                input.style.borderColor = 'red';
                alert('Title must be at least 3 characters long.');
            }
        }

        if (input.id === 'year') { 
            const year = parseInt(value, 10);
            if (!/^\d{4}$/.test(value) || year < 1888 || year > new Date().getFullYear()) {
                isValid = false;
                input.style.borderColor = 'red';
                alert('Enter a valid year (e.g., 1995).');
            }
        }

        if (input.id === 'rating') { 
            const rating = parseFloat(value);
            if (isNaN(rating) || rating < 0 || rating > 10) {
                isValid = false;
                input.style.borderColor = 'red';
                alert('Rating must be a number between 0 and 10.');
            }
        }
    });

    if (!isValid) {
        event.preventDefault();
        alert('Please correct the highlighted errors before submitting.');
    }
});
