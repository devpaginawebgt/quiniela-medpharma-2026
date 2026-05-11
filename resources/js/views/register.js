import { initTermsModal } from '../components/terms-modal';

document.addEventListener('DOMContentLoaded', () => {
    initTermsModal();

    const codeInput = document.getElementById('codigo');
    const countryInput = document.getElementById('paisId');
    const codeHelper = document.getElementById('codigoHelper');

    function resetCodeError() {
        codeInput.classList.remove('border-green-600', 'border-red-600');
        codeInput.classList.add('border-secondary');
        codeHelper.classList.add('hidden');
        codeHelper.classList.remove('text-red-600', 'text-green-600');
        codeHelper.innerHTML = '';
    }

    function addCodeError(message) {
        codeHelper.innerHTML = message;
        codeInput.classList.remove('border-secondary');
        codeInput.classList.add('border-red-600');
        codeHelper.classList.add('text-red-600');
        codeHelper.classList.remove('hidden');
    }

    function addCodeSuccess(message) {
        codeHelper.innerHTML = message;
        codeInput.classList.remove('border-secondary');
        codeInput.classList.add('border-green-600');
        codeHelper.classList.add('text-green-600');
        codeHelper.classList.remove('hidden');
    }

    async function validateCode() {
        const code = codeInput.value;
        const countryId = countryInput.value;

        resetCodeError()

        if (!code.length) {
            return;
        }

        if (code.length !== 8) {
            addCodeError('El código de invitación debe contener 8 caracteres.')
            return;
        }

        try {
            const codeResponse = await axios.post('/codigo', {
                code,
                country_id: countryId
            });
            
            const message = codeResponse.data.data?.message ?? 'Código de invitación validado';
            addCodeSuccess(message)

        } catch (error) {
            const message = error.response?.data?.message ?? 'Error al validar el código de invitaicón';
            addCodeError(message)
        }
    }

    if (codeInput && countryInput) {
        codeInput.addEventListener('focusout', validateCode)
    }

    const form = document.getElementById('register-form');
    const submitButton = document.getElementById('register-submit');

    if (form && submitButton) {
        form.addEventListener('submit', () => {
            submitButton.disabled = true;
            submitButton.querySelector('[data-submit-icon]').className = 'icon-[fluent--spinner-ios-16-filled] w-5 h-5 animate-spin';
            submitButton.querySelector('[data-submit-label]').textContent = 'Registrando...';
        });
    }
});
