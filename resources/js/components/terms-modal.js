/**
 * Inicializa el modal de Términos y Condiciones.
 * Se abre automáticamente al cargar la página.
 * Solo se cierra al aceptar los términos y confirmar.
 * Al confirmar, escribe accepted_terms = 1 en el hidden input del form y cierra el modal.
 */
export const initTermsModal = () => {

    const modal    = document.getElementById('modal-terms');
    if (!modal) return;

    const panel    = document.getElementById('modal-terms-panel');
    const backdrop = document.getElementById('modal-terms-backdrop');
    const checkbox = document.getElementById('terms-checkbox');
    const btnConfirm = document.getElementById('btn-confirmar-terms');

    const activeForm = document.querySelector('form input[name="accepted_terms"]')?.closest('form');
    const hiddenInput = activeForm?.querySelector('input[name="accepted_terms"]');

    // Si ya aceptó los términos (old value), no abrir el modal
    if (hiddenInput && hiddenInput.value === '1') return;

    const openModal = () => {
        modal.classList.remove('pointer-events-none');
        backdrop.classList.remove('opacity-0');
        panel.classList.remove('translate-y-full', 'opacity-0');
        document.body.style.overflow = 'hidden';
    };

    // Abrir automáticamente al cargar
    openModal();

    // Checkbox habilita/deshabilita botón confirmar
    checkbox.addEventListener('change', () => {
        btnConfirm.disabled = !checkbox.checked;
    });

    // Confirmar: escribir valor booleano en hidden input y submit
    btnConfirm.addEventListener('click', () => {
        if (!activeForm) return;

        const hiddenInput = activeForm.querySelector('input[name="accepted_terms"]');
        if (hiddenInput) {
            hiddenInput.value = '1';
        }

        // Cerrar modal
        backdrop.classList.add('opacity-0');
        panel.classList.add('translate-y-full', 'opacity-0');
        document.body.style.overflow = '';
        panel.addEventListener('transitionend', () => {
            modal.classList.add('pointer-events-none');
        }, { once: true });
    });

};
