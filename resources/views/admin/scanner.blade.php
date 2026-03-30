@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-20 text-center max-w-2xl">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-playo-dark mb-4 tracking-tight">QR SCANNER</h1>
        <p class="text-playo-muted font-bold">Admin Check-in Tool for Events</p>
    </div>

    <!-- Scanner Window -->
    <div class="card-playo p-2 overflow-hidden mb-12 shadow-2xl">
        <div id="reader" class="w-full aspect-square bg-playo-dark rounded-2xl flex items-center justify-center">
            <div class="text-white/20 text-center">
                <i class="fa-solid fa-camera text-6xl mb-4"></i>
                <p class="font-black text-xs uppercase tracking-widest">Camera initializing...</p>
            </div>
        </div>
    </div>

    <div id="result" class="hidden glass-playo p-8 rounded-[32px] border-playo-green/30 animate-float">
        <div class="w-16 h-16 bg-playo-green/10 rounded-full flex items-center justify-center text-playo-green mx-auto mb-6">
            <i class="fa-solid fa-check text-2xl"></i>
        </div>
        <h3 class="text-2xl font-black text-playo-dark mb-2">TICKET VALIDATED!</h3>
        <p class="text-sm font-bold text-playo-muted mb-6" id="ticketIdDisplay">ID: #---</p>
        <button class="btn-playo-primary px-10 h-12" onclick="resetScanner()">SCAN NEXT</button>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-12">
        <div class="bg-gray-50 p-4 rounded-2xl text-center">
            <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Total Scanned</p>
            <p class="text-2xl font-black text-playo-dark">142</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-2xl text-center">
            <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Pending</p>
            <p class="text-2xl font-black text-playo-dark">58</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code scanned = ${decodedText}`, decodedResult);
        document.getElementById('reader').classList.add('hidden');
        document.getElementById('result').classList.remove('hidden');
        document.getElementById('ticketIdDisplay').innerText = `ID: #${decodedText}`;
        
        // Mock API call to validate
        // fetch(`/api/admin/validate-ticket?id=${decodedText}`)
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);

    function resetScanner() {
        document.getElementById('reader').classList.remove('hidden');
        document.getElementById('result').classList.add('hidden');
    }
</script>
@endsection
