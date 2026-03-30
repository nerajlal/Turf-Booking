@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-black text-playo-dark mb-4 uppercase tracking-tight">Find a Playpal</h1>
        <p class="text-playo-muted font-bold">Connect with sports enthusiasts in Northern Ireland</p>
    </div>

    <!-- Filters -->
    <div class="glass-playo p-8 rounded-[32px] mb-12 flex flex-wrap gap-6 items-center justify-center">
        <div class="flex flex-col gap-2">
            <label class="text-[10px] font-black uppercase tracking-widest text-playo-muted px-2">Sport</label>
            <select class="bg-white border-2 border-gray-100 rounded-xl px-4 py-2.5 font-bold text-playo-dark min-w-[200px]">
                <option>All Sports</option>
                <option>Football</option>
                <option>Cricket</option>
                <option>Badminton</option>
            </select>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-[10px] font-black uppercase tracking-widest text-playo-muted px-2">Skill Level</label>
            <select class="bg-white border-2 border-gray-100 rounded-xl px-4 py-2.5 font-bold text-playo-dark min-w-[200px]">
                <option>All Levels</option>
                <option>Beginner</option>
                <option>Intermediate</option>
                <option>Pro</option>
            </select>
        </div>
        <button class="btn-playo-primary px-8 h-12 self-end">FIND BUDDIES</button>
    </div>

    <!-- Results Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($playpals as $pals)
        <div class="card-playo group p-6 text-center hover:-translate-y-2 transition-all">
            <div class="relative w-24 h-24 mx-auto mb-6">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($pals->name) }}&background=00B562&color=fff" class="w-full h-full rounded-full border-4 border-white shadow-xl" alt="{{ $pals->name }}">
                <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
            </div>
            
            <h3 class="text-xl font-black text-playo-dark mb-1">{{ $pals->name }}</h3>
            <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-4 italic">{{ $pals->skill_level ?? 'Intermediate' }}</p>
            
            <div class="flex flex-wrap gap-2 justify-center mb-8">
                @foreach($pals->sports ?? ['Football', 'Cricket'] as $sport)
                <span class="bg-playo-light text-playo-dark text-[10px] font-bold px-3 py-1 rounded-full border border-gray-100">{{ $sport }}</span>
                @endforeach
            </div>
            
            <button class="w-full btn-playo-outline py-2.5 text-xs">INVITE TO PLAY</button>
        </div>
        @empty
        <div class="col-span-full py-20 text-center text-playo-muted">
            <i class="fa-solid fa-users-slash text-4xl mb-4 opacity-20"></i>
            <p class="font-bold">No playpals found yet. Be the first to join!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
