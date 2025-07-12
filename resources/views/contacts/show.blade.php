<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Contato') }}
            </h2>
            <a href="{{ route('contacts.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-6" :status="session('success')" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-8">
                    <!-- Nome do Contato -->
                    <div class="mb-8">
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $contact->name }}</h1>
                        <p class="text-gray-600">{{ $contact->email }}</p>
                    </div>

                    <!-- Informações -->
                    <div class="space-y-6 mb-8">
                        <div class="flex items-center py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500 w-24">{{ __('Telefone') }}</span>
                            <span class="text-gray-900">{{ $contact->contact }}</span>
                        </div>

                        <div class="flex items-center py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500 w-24">{{ __('Email') }}</span>
                            <span class="text-gray-900">{{ $contact->email }}</span>
                        </div>

                        <div class="flex items-center py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500 w-24">{{ __('Criado em') }}</span>
                            <span class="text-gray-900">{{ $contact->created_at->format('d/m/Y H:i') }}</span>
                        </div>

                        <div class="flex items-center py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500 w-24">{{ __('Atualizado') }}</span>
                            <span class="text-gray-900">{{ $contact->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>

                    <!-- Ações -->
                    @auth
                        <div class="flex space-x-4">
                            <a href="{{ route('contacts.edit', $contact) }}" class="flex-1">
                                <x-secondary-button class="w-full justify-center">
                                    {{ __('Editar') }}
                                </x-secondary-button>
                            </a>

                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="w-full justify-center" onclick="openDeleteModal({{ $contact->id }}, '{{ $contact->name }}'); return false;">
                                    {{ __('Excluir') }}
                                </x-danger-button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @include('contacts.components.delete-modal')
</x-app-layout>
