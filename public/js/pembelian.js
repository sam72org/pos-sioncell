$('#harga_beli2').blur(function() {
    var harga_beli2     = $('#harga_beli2').val();
    var harga_beli      = harga_beli2.split(".").join("");

    $('#harga_beli').val(harga_beli);
    
});

$(document).on('click', '.btn-pilih-pembelian', function(e){
    e.preventDefault();

    var id          = $(this).data('id');
    var nama_barang = $(this).data('barang');
 
    $('#barang_id').val(id);
    $('#nama_barang').val(nama_barang);
    $('#modalBarang').modal('hide');
});

$(document).on('click', '#btnAddListPembelian', function(e){
    e.preventDefault();

    var id              = $('#barang_id').val();
    var qty             = $('#qty').val();
    var harga           = $('#harga_beli').val();

    if (id == '') {
        alert ('Silahkan Pilih Barang !');
    }
    else if (qty == '') {
        alert ('Silahkan Isi Jumlah !');
    }
    else if (harga == '' || harga == 0) {
        alert ('Harga tidak boleh kosong !');
    }
    else {
        var id      = $('#barang_id').val();
        var qty     = $('#qty').val();
        var harga   = $('#harga_beli').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "add-list",
            data: {'id' : id, 'qty' : qty, 'harga' : harga}, // here $(this) refers to the ajax object not form
            success: function (data) {
                $('#table-list-pembelian').load(document.URL +  ' #table-list-pembelian');
                // alert("Sukses");
            },
        });
        // stay.preventDefault(); 

        $('#nama_barang').val('');
        $('#qty').val('');
        $('#harga_beli').val('');
        $('#harga_beli2').val('');
    } 
});

$(document).on('click', '.btnDeleteListPembelian', function(e){
    e.preventDefault();

    // var id = $(this).attr('id');
    var id = $(this).data('id');

    $.ajax({ 
        type: 'GET',
        url:"delete-list",
        data:{'id' : id},
        success: function(data){
            $('#table-list-pembelian').load(document.URL + ' #table-list-pembelian');
        },
    });
});

$(document).on('click', '#btnSavePembelian', function(e) {
    e.preventDefault();

    // var no_pembelian    = $('#no_pembelian').val();
    var distributor_id  = $('#distributor_id').val();
    var tanggal         = $('#tanggal').val();
    var total           = $('#total').val();

    if (distributor_id == 0) {
        alert ('Silahkan Pilih Distributor !');
    }
    else if (total == 0) {
        alert ('Data tidak tersedia !');
    }
    else if (tanggal == '') {
        alert ('Silahkan Pilih Tanggal !');
    }
    else {
        $.ajax({
            type: "GET",
            url: "save-transaction",
            data: {
                // 'no_pembelian' : no_pembelian,
                'distributor_id' : distributor_id,
                'tanggal' : tanggal,
                'total' : total,
            },
            success: function(data){
                alert('Data berhasil disimpan.');
                // window.location = "{{ url('/ta-pembelian/new-transaction') }}";
                window.location = "new-transaction";
            },
        });
    }
});