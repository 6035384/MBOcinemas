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
        if (input.value.trim() === '') {
            isValid = false;
            input.style.borderColor = 'red';
        }
    });

    if (!isValid) {
        event.preventDefault(); 
        alert('Vul alle velden in.');
    }
});
