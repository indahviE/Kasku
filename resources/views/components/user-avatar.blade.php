@props(['user' => auth()->user(), 'size' => 'md', 'clickable' => true])

@php
    $sizeClasses = [
        'sm' => 'w-8 h-8 text-xs',
        'md' => 'w-10 h-10 text-sm',
        'lg' => 'w-12 h-12 text-base',
    ];

    $initials = substr(collect(explode(' ', $user->name))
        ->map(fn($part) => strtoupper(substr($part, 0, 1)))
        ->join(''), 0, 2);

    $colors = [
        'bg-blue-100 text-blue-700',
        'bg-indigo-100 text-indigo-700',
        'bg-purple-100 text-purple-700',
        'bg-pink-100 text-pink-700',
        'bg-rose-100 text-rose-700',
        'bg-orange-100 text-orange-700',
        'bg-amber-100 text-amber-700',
        'bg-teal-100 text-teal-700',
    ];

    $colorIndex = crc32($user->email) % count($colors);
    $colorClass = $colors[$colorIndex];
@endphp

@if($user->profile_photo_path)
    <!-- Profile Photo -->
    <img
        src="{{ asset('storage/' . $user->profile_photo_path) }}"
        alt="{{ $user->name }}"
        class="{{ $sizeClasses[$size] }} rounded-full object-cover {{ $clickable ? 'cursor-pointer' : '' }} border border-gray-200"
        title="{{ $user->name }}"
    >
@else
    <!-- Avatar Initials -->
    <div class="{{ $sizeClasses[$size] }} {{ $colorClass }} rounded-full font-semibold flex items-center justify-center {{ $clickable ? 'cursor-pointer' : '' }} border border-gray-200"
        title="{{ $user->name }}">
        {{ $initials }}
    </div>
@endif
