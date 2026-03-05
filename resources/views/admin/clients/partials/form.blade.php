<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-slate-700">Full Name</label>
        <input type="text" name="name"
               value="{{ old('name', $client->name ?? '') }}"
               class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Email</label>
        <input type="email" name="email"
               value="{{ old('email', $client->email ?? '') }}"
               class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
    </div>

    @if(!$client)
        <div>
            <label class="block text-sm font-medium text-slate-700">Password</label>
            <input type="password" name="password"
                   class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
        </div>
    @endif

    <div>
        <label class="block text-sm font-medium text-slate-700">Company Name</label>
        <input type="text" name="company_name"
               value="{{ old('company_name', $client->clientProfile->company_name ?? '') }}"
               class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Contact Person</label>
        <input type="text" name="contact_person"
               value="{{ old('contact_person', $client->clientProfile->contact_person ?? '') }}"
               class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Phone</label>
        <input type="text" name="phone"
               value="{{ old('phone', $client->clientProfile->phone ?? '') }}"
               class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
    </div>
</div>
