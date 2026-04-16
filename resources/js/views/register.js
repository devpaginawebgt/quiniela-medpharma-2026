import { initTermsModal } from '../components/terms-modal';

document.addEventListener('DOMContentLoaded', () => {
    initTermsModal();

    const codeInput = document.getElementById('codigo');
    const countryInput = document.getElementById('paisId');
    const codeHelper = document.getElementById('codigoHelper');

    async function validateCode() {
        const code = codeInput.value;
        const countryId = countryInput.value;

        codeInput.classList.remove('border-green-600', 'border-red-600');
        codeInput.classList.add('border-secondary');
        codeHelper.classList.add('hidden');
        codeHelper.classList.remove('text-red-600', 'text-green-600');

        try {
            const codeResponse = await axios.post('/codigo', {
                code,
                country_id: countryId
            });
            
            console.log(codeResponse);
            const message = codeResponse.data.data?.message ?? 'Código de invitación validado';
            codeHelper.innerHTML = message;
            codeInput.classList.remove('border-secondary');
            codeInput.classList.add('border-green-600');
            codeHelper.classList.add('text-green-600');
            codeHelper.classList.remove('hidden');

        } catch (error) {
            const message = error.response?.data?.message ?? 'Error al validar el código de invitaicón';

            codeHelper.innerHTML = message;
            codeInput.classList.remove('border-secondary');
            codeInput.classList.add('border-red-600');
            codeHelper.classList.add('text-red-600');
            codeHelper.classList.remove('hidden');
        }
    }

    if (codeInput && countryInput) {
        codeInput.addEventListener('focusout', validateCode)
    }
});
