<?php

namespace App\Http\Controllers;

use App\Models\Contact;

use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Services\ContactService;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $contacts = $this->contactService->searchContacts($search);
        
        return view('contacts.index', compact('contacts', 'search'));
    }

    public function create(): View
    {
        return view('contacts.create');
    }

    public function store(ContactStoreRequest $request): RedirectResponse
    {
        $contact = Contact::create($request->validated());

        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contato criado com sucesso!');
    }

    public function show(Contact $contact): View
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact): View
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(ContactUpdateRequest $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->validated());

        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contato excluído com sucesso!');
    }

    public function trashed(Request $request): View
    {
        $search = $request->get('search');
        $contacts = $this->contactService->getTrashedContacts($search);
        
        return view('contacts.trashed', compact('contacts', 'search'));
    }

    public function restore($id): RedirectResponse
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->route('contacts.index')
            ->with('success', 'Contato restaurado com sucesso!');
    }
} 