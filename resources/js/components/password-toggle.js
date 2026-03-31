export const initPasswordToggles = () => {
    document.querySelectorAll('[data-toggle-password]').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.togglePassword);
            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            const iconShow = btn.querySelector('[data-icon-show]');
            const iconHide = btn.querySelector('[data-icon-hide]');

            iconShow.classList.toggle('hidden', !isPassword);
            iconShow.classList.toggle('block', isPassword);
            iconHide.classList.toggle('hidden', isPassword);
            iconHide.classList.toggle('block', !isPassword);
        });
    });
};
