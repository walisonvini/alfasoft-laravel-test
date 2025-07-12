<x-modal name="confirm-delete" :show="false" maxWidth="md">
    <div class="p-6">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('Confirmar Exclusão') }}
                </h3>
            </div>
        </div>

        <div class="mt-2">
            <p class="text-sm text-gray-600">
                {{ __('Tem certeza que deseja excluir o contato') }} <strong id="contact-name"></strong>?
            </p>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-delete')">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <form id="delete-form" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <x-danger-button type="submit">
                    {{ __('Excluir') }}
                </x-danger-button>
            </form>
        </div>
    </div>
</x-modal>

<script>
    function openDeleteModal(contactId, contactName) {
        document.getElementById('contact-name').textContent = contactName;
        document.getElementById('delete-form').action = `/contacts/${contactId}`;
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'confirm-delete' }));
    }
</script> 