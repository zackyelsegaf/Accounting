@extends('layouts.app')

@section('content')
<div class="container">
    <div id="tab-container" class="nav nav-tabs mb-3" role="tablist">
        <!-- Tabs akan dirender oleh JS -->
    </div>

    <iframe id="tab-content-frame" src="" class="w-100" style="height: 75vh; border: 1px solid #dee2e6;"></iframe>
</div>
@endsection

@push('scripts')
<script>
    const tabContainer = document.getElementById('tab-container');
    const iframe = document.getElementById('tab-content-frame');
    let openTabs = JSON.parse(sessionStorage.getItem('openTabs') || '[]');
    let activeUrl = sessionStorage.getItem('activeUrl') || '';

    function addTab(title, url) {
        // Cek duplikat
        if (!openTabs.find(tab => tab.url === url)) {
            openTabs.push({ title, url });
            sessionStorage.setItem('openTabs', JSON.stringify(openTabs));
        }
        sessionStorage.setItem('activeUrl', url);
        renderTabs();
    }

    function closeTab(index, event) {
        event.stopPropagation(); // Biar gak aktifin tab
        const closingTab = openTabs[index];
        openTabs.splice(index, 1);
        sessionStorage.setItem('openTabs', JSON.stringify(openTabs));

        // Ganti iframe jika tab aktif ditutup
        if (closingTab.url === activeUrl) {
            const lastTab = openTabs[openTabs.length - 1];
            activeUrl = lastTab ? lastTab.url : '';
            sessionStorage.setItem('activeUrl', activeUrl);
        }
        renderTabs();
    }

    function renderTabs() {
        tabContainer.innerHTML = '';
        openTabs.forEach((tab, index) => {
            const isActive = tab.url === activeUrl;
            const tabBtn = document.createElement('button');
            tabBtn.className = `nav-link ${isActive ? 'active' : ''}`;
            tabBtn.setAttribute('type', 'button');
            tabBtn.innerHTML = `${tab.title} <span class="ms-1 text-danger" style="cursor:pointer" onclick="closeTab(${index}, event)">×</span>`;
            tabBtn.onclick = () => {
                activeUrl = tab.url;
                sessionStorage.setItem('activeUrl', activeUrl);
                renderTabs();
            };
            tabContainer.appendChild(tabBtn);
        });
        iframe.src = activeUrl;
    }

    // Jalankan saat halaman load
    document.addEventListener('DOMContentLoaded', () => {
        renderTabs();
    });

    // Untuk bisa dipanggil dari luar (misal tombol)
    window.addTab = addTab;
</script>
@endpush
