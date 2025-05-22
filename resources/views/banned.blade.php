<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banned</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md">
        <h1 class="text-3xl font-bold text-red-600 mb-4">Access Denied</h1>
        <p class="text-gray-700 text-lg">You have been banned.</p>
        <p class="mt-2 text-sm text-gray-500 mb-6">{{ $reason ?? 'Please contact support.' }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline font-bold text-blue-600 hover:text-blue-800">
                Go to Welcome Page
            </button>
        </form>
    </div>
</body>
</html>
