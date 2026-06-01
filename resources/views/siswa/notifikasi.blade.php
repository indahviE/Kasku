<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Notifikasi - Kasku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen text-gray-900 pb-12 antialiased">

<div class="max-w-4xl mx-auto px-4 py-6 md:py-10">
    
    <div class="flex flex-row items-center gap-4 mb-6 md:mb-8">
        <a href="/siswa/index" class="w-10 h-10 rounded-xl border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition active:scale-95 shadow-sm shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-xl md:text-2xl font-bold tracking-tight text-gray-900">Pusat Notifikasi</h1>
            <p class="text-xs md:text-sm text-gray-500 hidden sm:block">Pantau semua informasi dan riwayat pembaruan akun kasmu</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl md:rounded-3xl shadow-sm overflow-hidden">
        
        <div class="px-4 py-4 md:px-6 border-b border-gray-100 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <span class="text-sm font-bold text-gray-900">Daftar Pemberitahuan</span>
                @if($unreadCount > 0)
                    <span class="text-[11px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold animate-pulse">
                        {{ $unreadCount }} Baru
                    </span>
                @endif
            </div>
            
            <div class="flex bg-gray-100 p-1 rounded-xl items-center w-full sm:w-auto grid grid-cols-2 sm:flex">
                <button onclick="filterNotif('all')" id="tab-all" class="px-4 py-1.5 rounded-lg text-xs font-semibold bg-white text-gray-900 shadow-sm transition text-center text-nowrap">
                    Semua
                </button>
                <button onclick="filterNotif('unread')" id="tab-unread" class="px-4 py-1.5 rounded-lg text-xs font-semibold text-gray-500 hover:text-gray-900 transition relative text-center text-nowrap">
                    Belum Dibaca
                    @if($unreadCount > 0)
                        <span class="absolute top-1 right-2 w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    @endif
                </button>
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($allNotifications as $notif)
                @php
                    $titleLower = strtolower($notif->title);

                    $bgColor = 'bg-white hover:bg-gray-50/50';
                    $borderColor = 'border-gray-100';
                    $textColor = 'text-gray-900';
                    $msgColor = 'text-gray-500';
                    $iconBg = 'bg-gray-100 text-gray-500';
                    $btnColor = 'text-gray-600';
                    $statusClass = 'notif-read';
                    
                    $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';

                    if (!$notif->is_read) {
                        $statusClass = 'notif-unread';
                        
                        if (str_contains($titleLower, 'tunggakan') || str_contains($titleLower, 'menunggak')) {
                            $bgColor = 'bg-red-50 border-red-100 hover:bg-red-100/50'; $borderColor = 'border-red-200'; $textColor = 'text-red-900';
                            $msgColor = 'text-red-700'; $iconBg = 'bg-red-100 text-red-600'; $btnColor = 'text-red-600';
                            $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>';
                        
                        } elseif (str_contains($titleLower, 'deadline') || str_contains($titleLower, 'dekat')) {
                            $bgColor = 'bg-amber-50 border-amber-100 hover:bg-amber-100/50'; $borderColor = 'border-amber-200'; $textColor = 'text-amber-900';
                            $msgColor = 'text-amber-700'; $iconBg = 'bg-amber-100 text-amber-600'; $btnColor = 'text-amber-700';
                            $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>';
                        
                        } elseif (str_contains($titleLower, 'menunggu') || str_contains($titleLower, 'verifikasi')) {
                            $bgColor = 'bg-indigo-50/80 border-indigo-100 hover:bg-indigo-100/60'; $borderColor = 'border-indigo-200'; $textColor = 'text-indigo-900';
                            $msgColor = 'text-indigo-700'; $iconBg = 'bg-indigo-100 text-indigo-600'; $btnColor = 'text-indigo-600';
                            $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';

                        } elseif (str_contains($titleLower, 'berhasil') || str_contains($titleLower, 'lunas') || str_contains($titleLower, 'ditolak')) {
                            if (str_contains($titleLower, 'ditolak')) {
                                $bgColor = 'bg-rose-50 border-rose-100 hover:bg-rose-100/50'; $borderColor = 'border-rose-200'; $textColor = 'text-rose-900';
                                $msgColor = 'text-rose-700'; $iconBg = 'bg-rose-100 text-rose-600'; $btnColor = 'text-rose-600';
                                $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';
                            } else {
                                $bgColor = 'bg-emerald-50 border-emerald-100 hover:bg-emerald-100/50'; $borderColor = 'border-emerald-200'; $textColor = 'text-emerald-900';
                                $msgColor = 'text-emerald-700'; $iconBg = 'bg-emerald-100 text-emerald-600'; $btnColor = 'text-emerald-600';
                                $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>';
                            }
                        
                        } elseif (str_contains($titleLower, 'baru') || str_contains($titleLower, 'info')) {
                            $bgColor = 'bg-blue-50 border-blue-100 hover:bg-blue-100/50'; $borderColor = 'border-blue-200'; $textColor = 'text-blue-900';
                            $msgColor = 'text-blue-700'; $iconBg = 'bg-blue-100 text-blue-600'; $btnColor = 'text-blue-600';
                            $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>';
                        }
                    }
                @endphp

                <div class="notif-item {{ $statusClass }} p-4 md:p-6 transition relative {{ $bgColor }} {{ !$notif->is_read ? 'border-l-4 md:border-l-[6px]' : '' }} {{ $borderColor }}">
                    <div class="flex items-start gap-3 md:gap-4">
                        
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm font-bold {{ $iconBg }}">
                            {!! $iconSvg !!}
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-1">
                                <h3 class="text-sm md:text-base font-bold tracking-tight truncate {{ $textColor }}">
                                    {{ $notif->title }}
                                </h3>
                                <span class="text-[11px] text-gray-400 font-medium whitespace-nowrap">
                                    {{ $notif->created_at?->translatedFormat('d M Y, H:i') ?? 'Baru saja' }}
                                </span>
                            </div>
                            
                            <p class="text-xs md:text-sm mt-1 leading-relaxed text-balance {{ $msgColor }}">
                                {{ $notif->message }}
                            </p>
                            
                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                <span class="text-[11px] text-gray-400 truncate max-w-[180px] sm:max-w-none">
                                    Target: <span class="font-medium capitalize text-gray-600">{{ $notif->target_type }}</span>
                                </span>
                                
                                @if(!$notif->is_read)
                                    <form method="POST" action="/siswa/notifikasi/read/{{ $notif->id }}" class="inline m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-[11px] md:text-xs font-bold hover:bg-gray-50 bg-white border border-gray-200 rounded-lg md:rounded-xl px-3 py-1.5 md:px-4 md:py-2 transition active:scale-95 shadow-sm {{ $btnColor }}">
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[11px] text-gray-400 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Selesai dibaca
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-gray-400 bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-4m-8 0H4" />
                    </svg>
                    <p class="text-sm font-bold text-gray-500">Tidak ada riwayat notifikasi</p>
                    <p class="text-xs text-gray-400 mt-1">Semua pemberitahuan baru akunmu akan muncul di sini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function filterNotif(type) {
        const items = document.querySelectorAll('.notif-item');
        const tabAll = document.getElementById('tab-all');
        const tabUnread = document.getElementById('tab-unread');

        if (type === 'all') {
            tabAll.className = "px-4 py-1.5 rounded-lg text-xs font-semibold bg-white text-gray-900 shadow-sm transition text-center text-nowrap";
            tabUnread.className = "px-4 py-1.5 rounded-lg text-xs font-semibold text-gray-500 hover:text-gray-900 transition relative text-center text-nowrap";
            items.forEach(item => item.classList.remove('hidden'));
        } else {
            tabUnread.className = "px-4 py-1.5 rounded-lg text-xs font-semibold bg-white text-gray-900 shadow-sm transition text-center text-nowrap relative";
            tabAll.className = "px-4 py-1.5 rounded-lg text-xs font-semibold text-gray-500 hover:text-gray-900 transition text-center text-nowrap";
            
            items.forEach(item => {
                if (item.classList.contains('notif-unread')) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }
    }
</script>

</body>
</html>