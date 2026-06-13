{{-- Aset & inisialisasi DataTables bersama (client-side). Sertakan dengan @include('partials.datatables') --}}

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css">
<style>
    /* ============ Tema gelap LabLoans untuk DataTables ============ */
    .dt-container { color: #cbd5e1; font-size: 0.875rem; }

    /* Kontrol atas: panjang halaman & pencarian */
    .dt-container .dt-length,
    .dt-container .dt-search,
    .dt-container .dt-info { color: #94a3b8; font-size: 0.8rem; }

    .dt-container .dt-length select,
    .dt-container .dt-search input {
        background-color: #111827;
        color: #e2e8f0;
        border: 1px solid #374151;
        border-radius: 0.5rem;
        padding: 0.45rem 0.65rem;
        outline: none;
    }
    .dt-container .dt-search input { margin-left: 0.5rem; min-width: 220px; }
    .dt-container .dt-length select { margin: 0 0.4rem; }
    .dt-container .dt-search input:focus,
    .dt-container .dt-length select:focus { border-color: #137fec; box-shadow: 0 0 0 2px rgba(19,127,236,0.3); }

    /* Tabel */
    table.dataTable { color: #cbd5e1; border-collapse: collapse !important; width: 100% !important; }
    table.dataTable > thead > tr > th {
        background-color: #111827;
        color: #94a3b8;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.03em;
        border-bottom: 1px solid #374151 !important;
        padding: 1rem 1.5rem;
    }
    table.dataTable > tbody > tr { background-color: transparent !important; }
    table.dataTable > tbody > tr > td {
        padding: 1rem 1.5rem;
        border-top: 1px solid #1f2937;
        vertical-align: middle;
    }
    table.dataTable td.dt-empty { color: #94a3b8; text-align: center; padding: 3rem 1rem; }

    /* Ikon sorting */
    table.dataTable thead th.dt-orderable-asc:hover,
    table.dataTable thead th.dt-orderable-desc:hover { background-color: #1e2a35; cursor: pointer; }

    /* Info & paginasi */
    .dt-container .dt-paging { margin-top: 0.5rem; }
    .dt-container .dt-paging .dt-paging-button {
        color: #cbd5e1 !important;
        background: transparent !important;
        border: 1px solid transparent !important;
        border-radius: 0.5rem !important;
        padding: 0.35rem 0.75rem !important;
        margin: 0 0.1rem !important;
    }
    .dt-container .dt-paging .dt-paging-button:hover {
        background: #233648 !important;
        color: #fff !important;
        border-color: #374151 !important;
    }
    .dt-container .dt-paging .dt-paging-button.current,
    .dt-container .dt-paging .dt-paging-button.current:hover {
        background: #137fec !important;
        color: #fff !important;
        border-color: #137fec !important;
    }
    .dt-container .dt-paging .dt-paging-button.disabled,
    .dt-container .dt-paging .dt-paging-button.disabled:hover {
        color: #475569 !important;
        background: transparent !important;
        border-color: transparent !important;
        cursor: default;
    }

    /* Tombol ekspor (Buttons) */
    .dt-buttons { display: inline-flex; gap: 0.4rem; flex-wrap: wrap; }
    .dt-button {
        background: #233648 !important;
        color: #e2e8f0 !important;
        border: 1px solid #374151 !important;
        border-radius: 0.5rem !important;
        padding: 0.45rem 0.85rem !important;
        font-size: 0.78rem !important;
        font-weight: 600 !important;
    }
    .dt-button:hover { background: #2a3b4c !important; color: #fff !important; }

    /* Tata letak baris kontrol */
    .dt-layout-row { margin-bottom: 0.75rem; align-items: center; }
    .dt-layout-row:last-child { margin-top: 0.75rem; margin-bottom: 0; }

    /* Mode terang (jika tema diubah) */
    html:not(.dark) .dt-container { color: #334155; }
    html:not(.dark) table.dataTable > thead > tr > th { background-color: #f8fafc; color: #64748b; border-bottom-color: #e2e8f0 !important; }
    html:not(.dark) table.dataTable > tbody > tr > td { border-top-color: #e2e8f0; }
    html:not(.dark) .dt-container .dt-length select,
    html:not(.dark) .dt-container .dt-search input { background-color: #fff; color: #0f172a; border-color: #e2e8f0; }
    html:not(.dark) .dt-button { background: #f1f5f9 !important; color: #334155 !important; border-color: #e2e8f0 !important; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
<script>
    // Bahasa Indonesia (inline, tanpa file eksternal)
    window.LAB_DT_LANG = {
        lengthMenu: "Tampilkan _MENU_ data",
        search: "Cari:",
        searchPlaceholder: "Ketik kata kunci...",
        info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data",
        infoFiltered: "(disaring dari _MAX_ total)",
        zeroRecords: "Tidak ada data yang cocok dengan pencarian.",
        emptyTable: "Belum ada data.",
        paginate: { first: "«", last: "»", next: "›", previous: "‹" }
    };

    // Tombol ekspor standar (kolom ber-class .no-export dikecualikan)
    window.LAB_DT_BUTTONS = function (title) {
        var common = { title: title, exportOptions: { columns: ':not(.no-export)' } };
        return [
            Object.assign({ extend: 'copyHtml5', text: 'Salin' }, common),
            Object.assign({ extend: 'csvHtml5', text: 'CSV' }, common),
            Object.assign({ extend: 'excelHtml5', text: 'Excel' }, common),
            Object.assign({ extend: 'print', text: 'Cetak' }, common)
        ];
    };

    // Helper inisialisasi dengan default LabLoans
    window.initLabDataTable = function (selector, opts) {
        opts = opts || {};
        var layout = {
            topStart: 'pageLength',
            topEnd: 'search',
            bottomStart: 'info',
            bottomEnd: 'paging'
        };
        if (opts.buttons && opts.buttons.length) {
            layout.top1Start = { buttons: opts.buttons };
        }
        var columnDefs = [
            { targets: 'no-sort', orderable: false },
            { targets: 'no-search', searchable: false }
        ].concat(opts.columnDefs || []);

        return new DataTable(selector, {
            responsive: true,
            autoWidth: false,
            pageLength: opts.pageLength || 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'Semua']],
            order: opts.order || [],
            columnDefs: columnDefs,
            layout: layout,
            language: window.LAB_DT_LANG
        });
    };
</script>
@endpush
