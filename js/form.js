/*---------------for form--------------------*/

function validation(form) {

    function removeError(input) {
        const parent = input.parentNode;

        if (parent.classList.contains('error')) {
            parent.querySelector('.error-label').remove()
            parent.classList.remove('error')
        }
    }

    function createError(input, text) {
        const parent = input.parentNode;
        const errorLabel = document.createElement('label')

        errorLabel.classList.add('error-label')
        errorLabel.textContent = text

        parent.classList.add('error')

        parent.append(errorLabel)
    }


    let result = true;

    const allInputs = form.querySelectorAll('input');

    const checkbox = document.getElementById('check');

    const password = document.getElementById('password');

    for (const input of allInputs) {

        removeError(input)

        if (input.dataset.required == "true") {
            if (input.value == "") {
                removeError(input)
                createError(input, 'Doplnte!')
                result = false
            }
        }
        
    }
    return result
}


document.getElementById('add-form').addEventListener('submit', function (event) {
    event.preventDefault()

    if (validation(this) == true) {
        alert('Good!')
        window.location.href="admin.php"; 
    }

})
