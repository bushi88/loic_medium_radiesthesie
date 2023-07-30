// Script pour gérer l'affichage ou non du mot de passe
const showPasswordButtons = document.querySelectorAll('.show-password');
showPasswordButtons.forEach(button => {
    const passwordInput = button.previousElementSibling;
    button.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        const icon = button.querySelector('span');
        if (type === 'password') {
            icon.classList.remove('bx-show');
            button.classList.remove('btn-primary');
            icon.classList.add('bx-hide');
            button.classList.add('btn-danger');
        } else {
            icon.classList.remove('bx-hide');
            button.classList.remove('btn-danger');
            icon.classList.add('bx-show');
            button.classList.add('btn-primary');
        }
    });
});