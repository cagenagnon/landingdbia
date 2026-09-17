<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès administrateur - DBIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 flex items-center justify-center px-4">
    <main class="w-full max-w-md rounded-xl bg-white p-8 shadow-sm">
        <h1 class="text-2xl font-semibold">Accès administrateur</h1>
        <p class="mt-2 text-sm text-slate-600">Saisissez votre code pour consulter les inscriptions.</p>

        <form method="POST" action="{{ route('admin.login.store', [], false) }}" class="mt-6 space-y-4">
            @csrf
            <label for="code" class="block text-sm font-medium">Code administrateur</label>
            <input id="code" name="code" type="password" required autocomplete="current-password"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-slate-600 focus:outline-none"
                @error('code') aria-invalid="true" @enderror>
            @error('code')
                <p class="text-sm text-red-700">{{ $message }}</p>
            @enderror
            <button type="submit" class="w-full rounded-lg bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-700">
                Se connecter
            </button>
        </form>
    </main>
</body>
</html>
