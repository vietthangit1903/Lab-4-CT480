
function Validator(options) {

    function validate(inputElement, rule) {
        var errorMessage = rule.test(inputElement.value);
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
        if (errorMessage) {
            errorElement.innerText = errorMessage;
            errorElement.classList.add('invalid-feedback');
            inputElement.classList.add('is-invalid');
        } else {
            errorElement.innerText = '';
            errorElement.classList.remove('invalid-feedback');
            inputElement.classList.remove('is-invalid');
        }
    }

    var formElement = document.querySelector(options.form);

    if (formElement) {
        options.rules.forEach(function (rule) {
            var inputElement = formElement.querySelector(rule.selector);
            var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
            if (inputElement) {
                //Xu ly truong hop blur
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }

                //Xu ly khi nguoi dung nhap
                inputElement.oninput = function () {
                    errorElement.innerText = '';
                    errorElement.classList.remove('invalid-feedback');
                    inputElement.classList.remove('is-invalid');
                }
            }
        });
    }
}
// Dinh nghia cac rang buoc
Validator.isUsername = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            var regexUsername = /^[a-zA-Z0-9_]{6,20}$/
            return regexUsername.test(value) ? undefined : 'Only letters, numbers, underscore and at least 6 characters and maximum 20 characters';
        }
    };
};

Validator.isEmail = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            var regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return regexEmail.test(value) ? undefined : 'Invalid email format';
        }
    };
};

Validator.isPassword = function(selector){
    return{
        selector: selector,
        test: function(value){
            var regexPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/
            return regexPassword.test(value) ? undefined : 'Password must contains at least one capitalize letter, number and special character.'
        }
    }
}

Validator.confirmPassword = function(selector, getConfirmValue){
    return{
        selector: selector,
        test: function(value){
            return value === getConfirmValue() ? undefined : 'Password does not match.'
        }
    }
}

