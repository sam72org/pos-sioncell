<div class="modal fade" id="modalMenu"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Daftar Menu</h4>
            </div>
            <div class="modal-body" id="modal-body">
                <table class="table table-bordered table-stripped tabel-json" id="">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Kode Menu</th>
                            <th style="text-align: center;">Nama Menu</th>
                            <th style="text-align: center;">Harga</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    $('.tabel-json').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/ta-penjualan/get-menu',
        columns: [
            { data: 'kode', name: 'kode' },
            { data: 'menu', name: 'menu' },
            { data: 'harga', name: 'harga' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush