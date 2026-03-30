@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-20">
    <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
        <div>
            <div class="inline-flex items-center px-4 py-1.5 bg-playo-light rounded-full border border-gray-100 mb-4">
                <span class="text-[10px] font-black text-playo-green uppercase tracking-widest">Expert Coaches</span>
            </div>
            <h1 class="text-5xl font-black text-playo-dark leading-none tracking-tight">FIND TRAINERS</h1>
        </div>
        <form action="{{ route('trainers.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
            <input type="text" name="search" placeholder="Search specialization..." class="h-14 px-6 bg-white border border-gray-100 rounded-2xl font-bold text-playo-dark focus:ring-2 focus:ring-playo-green/20 outline-none" value="{{ request('search') }}">
            <button type="submit" class="btn-playo-primary h-14 px-8 uppercase tracking-widest text-[11px]">Filter</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($trainers as $trainer)
        <div class="card-playo group p-0 overflow-hidden hover:shadow-2xl transition-all duration-500">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ $trainer->image ? asset($trainer->image) : asset('images/trainer_action.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $trainer->name }}">
                <div class="absolute top-4 right-4">
                    <div class="glass-playo px-3 py-1.5 rounded-xl flex items-center space-x-1 border-white/50">
                        <i class="fa-solid fa-star text-yellow-400 text-[10px]"></i>
                        <span class="text-xs font-black text-playo-dark">{{ $trainer->rating_avg }}</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-[10px] font-black text-playo-green uppercase tracking-widest mb-2">{{ $trainer->specialization }}</p>
                <h3 class="text-xl font-black text-playo-dark mb-4">{{ $trainer->name }}</h3>
                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    <div>
                        <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest">Rate / hr</p>
                        <p class="text-lg font-black text-playo-dark">£{{ number_format($trainer->hourly_rate, 2) }}</p>
                    </div>
                    <a href="{{ route('trainers.show', $trainer) }}" class="bg-playo-light hover:bg-playo-green text-playo-green hover:text-white p-3 rounded-xl transition-all">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-playo-light rounded-[40px] border border-dashed border-gray-200">
            <p class="font-black text-playo-muted uppercase tracking-widest">No trainers found matching your criteria</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $trainers->links() }}
    </div>
</div>
@endsection
