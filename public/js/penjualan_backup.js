$(document).on('click', '.btn-pilih-penjualan', function(e){
    e.preventDefault();

    var id          = $(this).data('id');
    var barcode     = $(this).data('barcode');
    var nama_barang = $(this).data('barang');
    var harga_beli  = $(this).data('beli');
    var harga_jual  = $(this).data('jual');
    var harga_nego  = $(this).data('nego');
    var harga_beli  = $(this).data('beli');
    var stok        = $(this).data('stok');
 
    $('#barang_id').val(id);
    $('#kode_barcode').val(barcode);
    $('#nm_barang').val(nama_barang);
    $('#harga_beli').val(harga_beli);
    $('#harga_jual').val(harga_jual);
    $('#harga_jual2').val(harga_jual);
    $('#harga_nego').val(harga_nego);
    $('#stok').val(stok);
    $('#modalBarang').modal('hide');
});

$('#kode_barcode').change(function() {
    var kode_barcode = $('#kode_barcode').val();
   
    $.ajax({ 
        type: 'GET',
        url:"get-barang",
        data:{'kode_barcode' : kode_barcode},
        success: function(data){

            $('#barang_id').val(data['id']);
            $('#nm_barang').val(data['nama_barang']);
            $('#harga_beli').val(data['harga_beli']);
            $('#harga_jual').val(data['harga_jual']);
            $('#harga_jual2').val(data['harga_jual']);
            $('#harga_nego').val(data['harga_jual_minimum']);
            $('#stok').val(data['stok']);
        },
    });
});

$(document).on('click', '#btnAddListPenjualan', function(e){
    e.preventDefault();

    var id              = $('#barang_id').val();
    var kode_barcode    = $('#kode_barcode').val();
    var qty             = $('#qty').val();
    var harga_jual      = $('#harga_jual').val();
    var harga_nego      = $('#harga_nego').val();
    var harga_beli      = $('#harga_beli').val();
    var stok            = $('#stok').val();
    var sisa            = stok - qty;

    if (kode_barcode == '') {
        alert ('Silahkan Input Kode Barcode !');
        $('#kode_barcode').focus();
    }
    else if (qty == '') {
        alert ('Silahkan Input Quantity !');
    }
    else if (harga_jual == '') {
        alert ('Silahkan Input Harga !');
    }
    else if (parseInt(harga_jual) < parseInt(harga_nego)) {
        alert ('Maaf, Harga tidak diperbolehkan !');
    }
    else if (sisa < 0) {
        alert ('Maaf, Stok tidak mencukupi. Silahkan input jumlah tidak melebihi stok !');
    }
    else {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "add-list",
            data: {'id' : id, 'qty' : qty, 'harga' : harga_jual},
            success: function (data) {
                $('#table-list-penjualan').load(document.URL +  ' #table-list-penjualan');
            },
        });

        $('#nm_barang').val('');
        $('#barang_id').val('');
        $('#harga_beli').val('');
        $('#stok').val('');
        $('#kode_barcode').val('');
        $('#nama_barang').val('');
        $('#qty').val('');
        $('#harga_jual').val('');
        $('#harga_jual2').val('');
        $('#kode_barcode').focus();
    } 
});

$(document).on('click', '.btnTambahQtyListPenjualan', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({ 
        type: 'GET',
        url:"tambah-qty-list",
        data:{'id' : id},
        success: function(data){
            $('#table-list-penjualan').load(document.URL + ' #table-list-penjualan');
        },
    });
});

$(document).on('click', '.btnKurangQtyListPenjualan', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({ 
        type: 'GET',
        url:"kurang-qty-list",
        data:{'id' : id},
        success: function(data){
            $('#table-list-penjualan').load(document.URL + ' #table-list-penjualan');
        },
    });
});

$(document).on('click', '.btnDeleteListPenjualan', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({ 
        type: 'GET',
        url:"delete-list",
        data:{'id' : id},
        success: function(data){
            $('#table-list-penjualan').load(document.URL + ' #table-list-penjualan');
        },
    });
});

$('#harga_jual2').blur(function() {
    var harga = $('#harga_jual2').val();
    var harga2 = harga.split(".").join("");

    $('#harga_jual').val(harga2);
    
});

$(document).on('click', '#btnSavePenjualan', function(e) {
    e.preventDefault();

    var pelanggan_id    = $('#pelanggan_id').val();
    var no_penjualan    = $('#no_penjualan').val();
    var tgl_penjualan   = $('#tgl_penjualan').val();
    var tgl_jatuh_tempo = $('#tgl_jatuh_tempo').val();
    var total           = $('#total').val();

    if (total <= 0) {
        alert ('Data tidak tersedia !');
    }
    else {
        $.ajax({
            type: "GET",
            url: "save-transaction",
            data: {
                'pelanggan_id' : pelanggan_id,
                'no_penjualan' : no_penjualan,
                'tgl_penjualan' : tgl_penjualan,
                'tgl_jatuh_tempo' : tgl_jatuh_tempo,
                'total' : total,
            },
            success: function(data){
                alert('Sukses menyimpan Penjualan !');
                $('#modalStruk').modal();
            },
        });
    }
});

$(document).on('click', '#btnPrintPenjualan', function(e) {
    e.preventDefault();

    var no_penjualan = $(this).data('id');
    
    window.open('print-transaction/' + no_penjualan, '_blank');
    window.location.href = "new-transaction";

});