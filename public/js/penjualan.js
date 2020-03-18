$(document).on('click', '.btn-pilih-penjualan', function(e){
    e.preventDefault();

    var barcode = $(this).data('barcode');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "add-list",
        data: {'barcode' : barcode},
        success: function (data) {
            $('#table-list-penjualan').load(document.URL +  ' #table-list-penjualan');
            $('#kode_barcode').focus();
        },
    });

    $('#modalBarang').modal('hide');
    $('#kode_barcode').val('');
});

$('#kode_barcode').change(function() {

    var barcode = $('#kode_barcode').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: "add-list",
        data: {'barcode' : barcode},
        success: function (data) {
            if (data == '0') {
                alert('Maaf, Stok tidak cukup !');
            }
            else {
                $('#table-list-penjualan').load(document.URL + ' #table-list-penjualan');
            }
        },
    });

    $('#kode_barcode').val('');
    $('#kode_barcode').focus();
    
});

$(document).on('click', '.btnTambahQtyListPenjualan', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({ 
        type: 'GET',
        url:"increase-qty-list",
        data:{'id' : id},
        success: function(data){
            if (data == '0') {
                alert('Maaf, Stok tidak cukup !');
            }
            else {
                $('#table-list-penjualan').load(document.URL + ' #table-list-penjualan');
            }
        },
    });
});

$(document).on('click', '.btnKurangQtyListPenjualan', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({ 
        type: 'GET',
        url:"decrease-qty-list",
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

$(document).on('change', '.dataHargaJual', function(e){
    e.preventDefault();

    var id          = $(this).data('id');
    var harga_nego  = $(this).data('nego');
    var harga_jual  = document.getElementById("dataHargaJual-" + id).value;
    var harga_jual2 = harga_jual.split(".").join("");

    if (harga_jual2 < harga_nego) {
        alert('Maaf, Harga tidak diperbolehkan !');
        $('#table-list-penjualan').load(document.URL + ' #table-list-penjualan');
    }
    else {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: "change-price-list",
            data: {'id' : id, 'harga_jual' : harga_jual2},
            success: function (data) {
                $('#table-list-penjualan').load(document.URL + ' #table-list-penjualan');
            },
        });
    }
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
                alert('Sukses menyimpan Transaksi !');
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