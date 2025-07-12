<x-modal name="confirm-restore" :show="false" maxWidth="md">
    <div class="p-6">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('Confirmar Restauração') }}
                </h3>
            </div>
        </div>

        <div class="mt-2">
            <p class="text-sm text-gray-600">
                {{ __('Tem certeza que deseja restaurar o contato') }} <strong id="contact-name"></strong>?
            </p>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-restore')">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <form id="restore-form" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <x-primary-button type="submit">
                    {{ __('Restaurar') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-modal>

<script>
    function openRestoreModal(contactId, contactName) {
        document.getElementById('contact-name').textContent = contactName;
        document.getElementById('restore-form').action = `/contacts/${contactId}/restore`;
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'confirm-restore' }));
    }
</script> 