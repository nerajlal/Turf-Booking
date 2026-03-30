@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-20">
    <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
        <div>
            <div class="inline-flex items-center px-4 py-1.5 bg-blue-50 rounded-full border border-blue-100 mb-4">
                <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest">Athlete Metrics</span>
            </div>
            <h1 class="text-5xl font-black text-playo-dark leading-none tracking-tight">PERFORMANCE TRACKING</h1>
        </div>
        <button onclick="document.getElementById('logModal').classList.remove('hidden')" class="btn-playo-primary h-14 px-10 uppercase tracking-widest text-[11px] shadow-xl shadow-playo-green/20">
            LOG NEW ACTIVITY <i class="fa-solid fa-plus ml-2"></i>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
        <div class="card-playo p-8 bg-playo-dark border-none flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Total Sessions</p>
                <p class="text-4xl font-black text-white">{{ $logs->total() }}</p>
            </div>
            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-playo-green">
                <i class="fa-solid fa-bolt text-2xl"></i>
            </div>
        </div>
        <div class="card-playo p-8 bg-blue-600 border-none flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-blue-100 uppercase tracking-widest mb-2">Top Metric</p>
                <p class="text-4xl font-black text-white">SPEED</p>
            </div>
            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                <i class="fa-solid fa-gauge-high text-2xl"></i>
            </div>
        </div>
        <div class="card-playo p-8 bg-white flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-2">Last Active</p>
                <p class="text-4xl font-black text-playo-dark">{{ $logs->first() ? $logs->first()->logged_at->diffForHumans() : 'N/A' }}</p>
            </div>
            <div class="w-16 h-16 bg-playo-light rounded-2xl flex items-center justify-center text-playo-green">
                <i class="fa-solid fa-calendar-check text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[40px] shadow-xl overflow-hidden border border-gray-100 mb-12">
        <div class="p-8 bg-playo-light/50 border-b border-gray-100">
            <h4 class="text-lg font-black text-playo-dark">Activity History</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] uppercase font-black text-playo-muted tracking-widest border-b border-gray-100">
                        <th class="px-8 py-6">Date</th>
                        <th class="px-8 py-6">Metric Type</th>
                        <th class="px-8 py-6">Value</th>
                        <th class="px-8 py-6">Unit</th>
                        <th class="px-8 py-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($logs as $log)
                    <tr class="group hover:bg-playo-light/30 transition-colors">
                        <td class="px-8 py-6 font-bold text-playo-dark">{{ $log->logged_at->format('M d, Y') }}</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-playo-light rounded-full text-[10px] font-black text-playo-green uppercase tracking-widest">{{ $log->metric }}</span>
                        </td>
                        <td class="px-8 py-6 font-black text-xl text-playo-dark group-hover:scale-110 transition-transform origin-left">{{ number_format($log->value, 1) }}</td>
                        <td class="px-8 py-6 font-bold text-playo-muted italic">{{ $log->unit }}</td>
                        <td class="px-8 py-6">
                            <i class="fa-solid fa-circle-check text-playo-green mr-2"></i> Verified
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-playo-muted font-black uppercase tracking-widest">No activities logged yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 bg-playo-light/50 border-t border-gray-100">
            {{ $logs->links() }}
        </div>
    </div>
</div>

<!-- Modal -->
<div id="logModal" class="fixed inset-0 z-[1000] hidden">
    <div class="absolute inset-0 bg-playo-dark/60 backdrop-blur-md"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-6">
        <div class="bg-white rounded-[40px] shadow-2xl p-10 relative">
            <button onclick="document.getElementById('logModal').classList.add('hidden')" class="absolute top-6 right-6 w-10 h-10 bg-playo-light rounded-full flex items-center justify-center text-playo-dark hover:bg-gray-200">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h3 class="text-2xl font-black text-playo-dark mb-8">LOG ACTIVITY</h3>
            <form action="{{ route('performance.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-playo-muted uppercase tracking-widest mb-2">Metric Type</label>
                    <select name="metric" class="w-full h-14 px-6 bg-playo-light border-none rounded-2xl font-bold text-playo-dark focus:ring-2 focus:ring-playo-green/20">
                        <option value="Speed">Speed</option>
                        <option value="Distance">Distance</option>
                        <option value="Duration">Duration</option>
                        <option value="Heart Rate">Heart Rate</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-playo-muted uppercase tracking-widest mb-2">Value</label>
                        <input type="number" step="0.1" name="value" class="w-full h-14 px-6 bg-playo-light border-none rounded-2xl font-bold text-playo-dark focus:ring-2 focus:ring-playo-green/20" placeholder="10.5">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-playo-muted uppercase tracking-widest mb-2">Unit</label>
                        <input type="text" name="unit" class="w-full h-14 px-6 bg-playo-light border-none rounded-2xl font-bold text-playo-dark focus:ring-2 focus:ring-playo-green/20" placeholder="km/h">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-playo-muted uppercase tracking-widest mb-2">Date</label>
                    <input type="date" name="logged_at" value="{{ date('Y-m-d') }}" class="w-full h-14 px-6 bg-playo-light border-none rounded-2xl font-bold text-playo-dark focus:ring-2 focus:ring-playo-green/20">
                </div>
                <button type="submit" class="w-full btn-playo-primary h-14 uppercase tracking-widest text-[11px] mt-4">RECORD METRIC</button>
            </form>
        </div>
    </div>
</div>
@endsection
