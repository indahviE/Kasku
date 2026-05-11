
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite('resources/css/app.css')

    {{-- Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-zinc-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm lg:max-w-5xl bg-zinc-200 rounded-[32px] overflow-hidden shadow-2xl relative">

        <div class="flex min-h-[800px] lg:min-h-[700px]">

            {{-- SIDEBAR DESKTOP --}}
            <aside class="hidden lg:flex w-72 bg-white border-r border-zinc-200 p-6 flex-col justify-between">

                <div>
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-lg">
                            N
                        </div>

                        <div>
                            <h2 class="font-bold text-lg">Nixio AI</h2>
                            <p class="text-sm text-zinc-500">Assistant Dashboard</p>
                        </div>
                    </div>

                    {{-- SEARCH DESKTOP --}}
                    <div class="bg-zinc-100 rounded-2xl px-4 py-3 flex items-center gap-3 mb-8">
                        <i data-lucide="search" class="w-5 h-5 text-zinc-500"></i>
                        <input
                            type="text"
                            placeholder="Search"
                            class="bg-transparent outline-none w-full text-sm"
                        >
                    </div>

                    <nav class="space-y-3">
                        <button class="w-full flex items-center gap-3 bg-black text-white rounded-2xl px-4 py-4">
                            <i data-lucide="sparkles"></i>
                            <span>Ask AI</span>
                        </button>

                        <button class="w-full flex items-center gap-3 bg-zinc-100 rounded-2xl px-4 py-4 hover:bg-zinc-200 transition">
                            <i data-lucide="scan-search"></i>
                            <span>Scan</span>
                        </button>

                        <button class="w-full flex items-center gap-3 bg-zinc-100 rounded-2xl px-4 py-4 hover:bg-zinc-200 transition">
                            <i data-lucide="edit-3"></i>
                            <span>Edit</span>
                        </button>
                    </nav>
                </div>

                <div class="bg-zinc-100 rounded-2xl p-4">
                    <p class="text-sm text-zinc-500 mb-1">Current Plan</p>
                    <h3 class="font-semibold">Free Version</h3>
                </div>
            </aside>


            {{-- MAIN CONTENT --}}
            <main class="flex-1 p-5 lg:p-10 relative pb-32 lg:pb-10">

                {{-- TOP BAR MOBILE --}}
                <div class="flex items-center justify-between mb-10 lg:hidden">
                    <button class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow">
                        <i data-lucide="help-circle" class="w-4 h-4"></i>
                    </button>

                    <button class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow relative">
                        <i data-lucide="bell" class="w-4 h-4"></i>

                        <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-orange-500"></span>
                    </button>
                </div>

                {{-- HEADER --}}
                <div class="mb-8">
                    <h2 class="text-3xl lg:text-5xl font-medium text-zinc-500">
                        Hi Nixio,
                    </h2>

                    <h1 class="text-4xl lg:text-6xl font-bold leading-tight mt-1 max-w-2xl">
                        How can I help you today?
                    </h1>
                </div>

                {{-- SEARCH DESKTOP (PINDAH KE ATAS SAAT LAPTOP) --}}
                <div class="hidden lg:flex bg-white rounded-2xl px-5 py-4 items-center gap-3 max-w-2xl shadow-sm mb-10">
                    <i data-lucide="search" class="w-5 h-5 text-zinc-500"></i>

                    <input
                        type="text"
                        placeholder="Search anything..."
                        class="bg-transparent outline-none w-full"
                    >

                    <button class="bg-black text-white rounded-xl px-5 py-2 text-sm hover:opacity-90 transition">
                        Ask AI
                    </button>
                </div>

                {{-- GRID MENU --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                    <div class="bg-white rounded-3xl p-5 hover:-translate-y-1 transition duration-300 shadow-sm">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-100 flex items-center justify-center mb-4">
                            <i data-lucide="scan-search"></i>
                        </div>

                        <h3 class="font-semibold text-lg">Scan</h3>
                        <p class="text-sm text-zinc-500 mt-1">
                            Documents, ID cards, Sign and more.
                        </p>
                    </div>

                    <div class="bg-white rounded-3xl p-5 hover:-translate-y-1 transition duration-300 shadow-sm">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-100 flex items-center justify-center mb-4">
                            <i data-lucide="edit-3"></i>
                        </div>

                        <h3 class="font-semibold text-lg">Edit</h3>
                        <p class="text-sm text-zinc-500 mt-1">
                            Sign & edit text quickly.
                        </p>
                    </div>

                    <div class="bg-white rounded-3xl p-5 hover:-translate-y-1 transition duration-300 shadow-sm">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-100 flex items-center justify-center mb-4">
                            <i data-lucide="file-up"></i>
                        </div>

                        <h3 class="font-semibold text-lg">Convert</h3>
                        <p class="text-sm text-zinc-500 mt-1">
                            PDF, DOCX, JPG, PNG.
                        </p>
                    </div>

                    <div class="bg-white rounded-3xl p-5 hover:-translate-y-1 transition duration-300 shadow-sm">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center mb-4">
                            <i data-lucide="sparkles"></i>
                        </div>

                        <h3 class="font-semibold text-lg">Ask AI</h3>
                        <p class="text-sm text-zinc-500 mt-1">
                            Summarize, translate and more.
                        </p>
                    </div>
                </div>


                {{-- BOTTOM BAR MOBILE --}}
                <div class="lg:hidden fixed bottom-5 left-1/2 -translate-x-1/2 w-[92%] max-w-sm z-50">

                    <div class="bg-white rounded-full shadow-2xl px-3 py-3 flex items-center gap-3">

                        <button class="w-12 h-12 rounded-full bg-black text-white flex items-center justify-center shrink-0">
                            <i data-lucide="sparkles"></i>
                        </button>

                        <div class="flex-1 flex items-center gap-2 px-3">
                            <i data-lucide="search" class="w-5 h-5 text-zinc-500"></i>

                            <input
                                type="text"
                                placeholder="Search"
                                class="w-full bg-transparent outline-none text-sm"
                            >
                        </div>

                        <button class="w-12 h-12 rounded-full bg-black text-white flex items-center justify-center shrink-0">
                            <i data-lucide="mic"></i>
                        </button>
                    </div>
                </div>

            </main>
        </div>
    </div>


    <script>
        lucide.createIcons();
    </script>

</body>
</html>


