
Validator({
    form: '#form_register',
    errorSelector: '.form-message',
    rules: [
        Validator.isUsername('#username'),
        Validator.isEmail('#email'),
        Validator.isPassword('#password'),
        Validator.confirmPassword('#confirm_password', function(){
            return document.querySelector('#form_register #password').value;
        })
    ]
});