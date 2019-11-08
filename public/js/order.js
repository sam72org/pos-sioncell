$('body').on('click', '#modal-show', function (event) {
    event.preventDefault();

    $('#modalBarang').modal('show');
});

$(document).ready(function() {
    $("#moneyInput, #money_input, .currency_input, .money").maskMoney({ thousands:'.', decimal:',', affixesStay: false, precision: 0});
 });

$(document).on('click', '.btn-pilih', function(e){
    e.preventDefault();

    var id          = $(this).data('id');
    var nama_barang = $(this).data('barang');
    var harga       = $(this).data('harga');
    var stok        = $(this).data('stok');
 
    $('#barang_id').val(id);
    $('#nama_barang').val(nama_barang);
    $('#stok').val(stok);
    $('#modalBarang').modal('hide');
});

$(document).on('click', '#btnAddList', function(e){
    e.preventDefault();

    var id      = $('#barang_id').val();
    var qty     = $('#qty').val();
    var harga   = $('#harga').val();
    var stok    = $('#stok').val();

    var sisa    = stok - qty;

    if (id == '') {
        alert ('Silahkan Pilih Barang !');
    }
    else if (qty == '') {
        alert ('Silahkan Isi Jumlah !');
    }
    else if (harga == '') {
        alert ('Silahkan Isi Harga !');
    }
    else if (sisa < 1) {
        alert ('Maaf Stok tidak mencukupi. Silahkan input jumlah tidak melebihi stok !');
    }
    else {
        var id = $('#barang_id').val();
        var qty = $('#qty').val();
        var harga = $('#harga').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "add-list",
            data: {'id' : id, 'qty' : qty, 'harga' : harga}, // here $(this) refers to the ajax object not form
            success: function (data) {
                $('#tabel-menu').load(document.URL +  ' #tabel-menu');
                // alert("Sukses");
            },
        });
        // stay.preventDefault(); 

        $('#nama_barang').val('');
        $('#qty').val('');
        $('#harga').val('');
        $('#harga2').val('');
    } 
});

$(document).on('click', '.btnRemoveList', function(e){
    e.preventDefault();

    // var id = $(this).attr('id');
    var id = $(this).data('id');

    $.ajax({ 
        type: 'GET',
        url:"delete-list",
        data:{'id' : id},
        success: function(data){
            $('#tabel-menu').load(document.URL + ' #tabel-menu');
        },
    });
});

$(document).on('click', '#btnCancelList' , function(e){
    e.preventDefault();

    $('#id').val('');
    $('#nama_barang').val('');
    $('#harga').val('');
    $('#harga2').val('');
    $('#qty').val('');
});

$('#uang-bayar').blur(function() {
    var total = $('#total').val();
    var bayar = $('#uang-bayar').val();
    // var bayar2 = parseFloat(bayar.replace(/[\,]/g,''));
    var bayar2 = bayar.split(".").join("");

    var kembali = bayar2 - total;
    var kembali2 = kembali.toFixed(0);
    var kembali3 = kembali2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');

    $('#uang-kembali').val(kembali3);
    $('#uang_bayar').val(bayar2);
    $('#uang_kembali').val(kembali);
    
});


$('#harga2').blur(function() {
    var harga = $('#harga2').val();
    var harga2 = harga.split(".").join("");

    $('#harga').val(harga2);
    
});

$(document).on('click', '#btn-save', function(e) {
    e.preventDefault();

    var pelanggan_id    = $('#pelanggan_id').val();
    var no_penjualan    = $('#no_penjualan').val();
    var tgl_penjualan   = $('#tgl_penjualan').val();
    var tgl_jatuh_tempo = $('#tgl_jatuh_tempo').val();
    var total           = $('#total').val();

    // alert(tgl_penjualan);

    if (pelanggan_id == '') {
        alert ('Silahkan Pilih Pelanggan !');
    }
    else if (tgl_penjualan == '') {
        alert ('Silahkan Pilih Tanggal Penjualan !');
    }
    else if (tgl_jatuh_tempo == '') {
        alert ('Silahkan Pilih Tanggal Jatuh Tempo !');
    }
    else if (total <= 0) {
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
                // window.location.href = "new-transaction";
                // window.open('print-order/' + no_penjualan, '_blank');
            },
        });
    }
});

$(document).on('click', '#btn-print', function(e) {
    e.preventDefault();

    var no_penjualan = $(this).data('id');
    
    window.open('print-transaction/' + no_penjualan, '_blank');
    window.location.href = "new-transaction";

});

// $(document).on('click', '#btn-print', function(e) {
//     e.preventDefault();

//     var no_penjualan = $(this).data('id');

//     $.ajax({
//         type: "GET",
//         url: "print-transaction",
//         data: {
//             'no_penjualan' : no_penjualan,
//         },
//         success: function(data){
//             window.location.href = "new-transaction";
//         },
//     });

// });



