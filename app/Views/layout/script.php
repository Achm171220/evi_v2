<!-- select 2 script  -->
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>
<!-- script ubah id berkas/ update item berkas pada berkas  -->
<script>
    $(document).ready(function() {
        $('#itemTable').DataTable();
    });
</script>
<!-- datatables  -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#aktif').DataTable({
            "scrollY": "500px", // Sesuaikan tinggi scroll vertikal
            "scrollCollapse": true,
            "paging": false
        });
        $('#inaktif').DataTable({
            "scrollY": "500px", // Sesuaikan tinggi scroll vertikal
            "scrollCollapse": true,
            "paging": false
        });
        $('#default').DataTable();
    });
</script>
<!-- data arsip aktif  -->
<script>
    $(document).ready(function() {
        var csrfName = '<?= csrf_token() ?>'; // Nama CSRF token dari CodeIgniter
        var csrfHash = '<?= csrf_hash() ?>'; // Nilai CSRF token dari CodeIgniter
        $('#tb_arsip').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('arsip/json') ?>",
                // "type": "POST"
            },
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    "data": "sub_bidang"
                },
                {
                    "data": "kode_klas"
                },
                {
                    "data": "judul_dokumen"
                },
                {
                    "data": "no_dokumen"
                },
                {
                    "data": "tgl_dokumen"
                },
                {
                    "data": "media_simpan",
                    "render": function(data, type, row) {
                        if (data === 'elektronik') {
                            return '<button class="btn pmr-btn">e</button>';
                        } else if (data === 'kertas') {
                            return '<button class="btn scc-btn">k</button>';
                        } else {
                            return '<button class="btn scc-wrn">N/A</button>';
                        }
                    }
                },
                {
                    "data": "jenis_arsip"

                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `
                        <div class="d-flex">
                            <a class="btn btn-sm btn-warning-1 mr-1" href="<?= base_url('arsip/edit'); ?>/${row.id}">Edit</a> 

                            <a href="<?= base_url('arsip/delete'); ?>/${row.id}" class="btn btn-danger btn-sm" data-id="${row.id}" hidden>Delete</a>

                            <a href="<?= base_url('arsip/delete'); ?>/${row.id}" class="btn btn-danger btn-sm ml-1">Hapus</a>
                        </div>`;
                    }
                }
            ],
            "createdRow": function(row, data, dataIndex) {
                $(row).addClass('word-wrap');
            }
        });
        // Cek untuk pesan sukses atau gagal dari server
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                title: 'Sukses!',
                text: '<?php echo session()->getFlashdata('success'); ?>',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php elseif (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: 'Gagal!',
                text: '<?php echo session()->getFlashdata('error'); ?>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>
<!-- data arsip vital  -->
<script>
    $(document).ready(function() {
        var table = $('#arsip_vital').DataTable({
            responsive: true,
            autoWidth: false,
            lengthChange: false,
            buttons: ['print', 'excel', 'pdf']
        });
        table.buttons().container()
            .appendTo('#arsip_vital_wrapper .col-md-6:eq(0)');
        $('#sub_bidang').on('change', function() {
            var selectedSubBidang = $(this).val();
            table.rows().every(function() {
                var row = $(this.node());
                var subBidangId = row.data('sub-bidang');
                if (selectedSubBidang === "" || selectedSubBidang == subBidangId) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        });
    });
</script>
<!-- item inaktif -->
<script>
    $('#tb_arsip_inaktif').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url() ?>/arsipinaktif/json'
        },
        "columns": [{
                "data": null,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },

            {
                "data": "sub_bidang"
            },
            {
                "data": "kode_klas"
            },
            {
                "data": "judul_dokumen"
            },
            {
                "data": "no_dokumen"
            },
            {
                "data": "tgl_dokumen"
            },
            {
                "data": "media_simpan",
                "render": function(data, type, row) {
                    if (data === 'elektronik') {
                        return '<button class="btn pmr-btn">e</button>';
                    } else if (data === 'kertas') {
                        return '<button class="btn scc-btn">k</button>';
                    } else {
                        return '<button class="btn scc-wrn">N/A</button>';
                    }
                }
            },
            {
                "data": "jenis_arsip"

            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <div class="d-flex">
                            <a class="btn btn-sm btn-warning-1 mr-1" href="<?= base_url('arsipinaktif/edit'); ?>/${row.id}">Edit</a> 

                            <a href="<?= base_url('arsipinaktif/delete'); ?>/${row.id}" class="btn btn-danger btn-sm" data-id="${row.id}" hidden>Delete</a>

                            <a href="<?= base_url('arsipinaktif/delete'); ?>/${row.id}" class="btn btn-danger btn-sm ml-1">Hapus</a>
                        </div>`;
                }
            }
        ],
        "createdRow": function(row, data, dataIndex) {
            $(row).addClass('word-wrap');
        }
    });
</script>
<!-- table berkas arsip aktif  -->
<script>
    $(document).ready(function() {
        $('#berkasTable').DataTable({
            processing: true,
            serverSide: true,
            info: false, // Menonaktifkan informasi total entri
            ajax: {
                url: '<?= base_url(); ?>berkas/getBerkasData',
                type: 'GET',
                dataSrc: 'data'
            },
            columns: [{
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'no_berkas'
                },
                {
                    data: 'nama_berkas'
                },
                {
                    data: 'tahun_berkas'
                },
                {
                    data: null,
                    className: "text-center",
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-sm btn-block scd-btn">
                                ${row.jumlah_item}
                            </button>
                        `;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        <div class="d-flex">
                        <a href="<?= base_url('berkas/list_item'); ?>/${row.id}" class="btn btn-sm btn-secondary" title="daftar item berkas"><i class="fe fe-eye text-white"></i></a> 
                        
                        <a href="<?= base_url('trial_bug/index'); ?>/${row.id}" class="btn btn-sm btn-info ml-1" title="tambah item berkas"><i class="fe fe-plus-square"></i></a>
                        </div>`
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="d-flex">
                    <a class="btn btn-sm wrn-btn mr-2" href="<?= base_url('berkas/edit'); ?>/${row.id}"><i class="fe fe-edit"></i></a> <a href="<?= base_url('berkas/delete'); ?>/${row.id}" class="btn btn-sm btn-danger"><i class="fe fe-trash"></i></a>
                    </div>`
                    }
                }
            ],
            columnDefs: [{
                targets: 0,
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            }],
            lengthMenu: [
                [5, 10, 25, 50],
                [5, 10, 25, 50]
            ],
            pageLength: 10
        });
    });
</script>
<!-- tabel berkas inaktif -->
<script type="text/javascript">
    $('#berkasInaktif').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url() ?>/berkasinaktif/json'
        },
        columns: [{
                data: 'no',
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'id',
                visible: false
            },
            {
                data: 'kode_klas',
            },
            {
                data: 'sub_bidang',
                width: '20%'
            },
            {
                data: 'nama_berkas',
            },
            {
                data: 'tahun_berkas',
            },
            {
                "data": "tahun_berkas",
                "render": function(data, type, row) {
                    return '<span class="badge badge-primary">' + data + '</span>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                    <a href="<?= base_url('berkasinaktif/list_item'); ?>/${row.id}" class="btn btn-sm btn-warning-1" title="daftar item berkas"><i class="fe fe-eye"></i></a> | 
                    
                    <a href="<?= base_url('trial_bug/inaktif'); ?>/${row.id}" class="btn btn-sm btn-info" title="tambah item berkas"><i class="fe fe-plus-square"></i></a>
                    `
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `<div class="d-flex">
                    <a class="btn btn-sm btn-warning mr-2" href="<?= base_url('berkasinaktif/edit'); ?>/${row.id}"><i class="fe fe-edit"></i></a> <a href="<?= base_url('berkas/delete'); ?>/${row.id}" class="btn btn-sm btn-danger"><i class="fe fe-trash"></i></a>
                    </div>`
                }
            }
        ],

        "createdRow": function(row, data, dataIndex) {
            $(row).addClass('word-wrap');
        }

    });
</script>
<!-- metode arsip konvensional / elektronik  -->
<script>
    $(document).ready(function() {
        // Mengatur status input1 dan input2 berdasarkan nilai select
        $("#media").change(function() {
            var selectedOption = $(this).val();
            if (selectedOption === "elektronik") {
                $("#simpan").prop("disabled", false);
                $("#simpan2").prop("disabled", false);
                $("#simpan3").prop("disabled", false);
                $("#boks").prop("disabled", true).val(""); // Menonaktifkan input2 dan mengosongkan nilainya
            } else {
                $("#simpan").prop("disabled", true).val(
                    ""); // Menonaktifkan input1 dan mengosongkan nilainya
                $("#simpan2").prop("disabled", true).val(
                    ""); // Menonaktifkan input1 dan mengosongkan nilainya
                $("#simpan3").prop("disabled", true).val(
                    ""); // Menonaktifkan input1 dan mengosongkan nilainya
                $("#boks").prop("disabled", false);
            }
        });

        // Memanggil fungsi toggleInputs() saat halaman dimuat
        $("#media").trigger("change");
    });
</script>
<!-- metode ambil tahun dari tanggal  -->
<script>
    $(document).ready(function() {
        $('#dateInput').on('change', function() {
            // Ambil nilai dari input date
            let dateValue = $(this).val();

            if (dateValue) {
                // Ambil tahun dari nilai date
                let year = new Date(dateValue).getFullYear();

                // Masukkan tahun ke input lainnya
                $('#yearInput').val(year);
            } else {
                // Kosongkan input year jika date tidak dipilih
                $('#yearInput').val('');
            }
        });
    });
</script>
<!-- blur alert  -->
<script>
    $(document).ready(function() {
        $(".alert-dismissible").fadeIn().delay(3000).fadeOut();
    });
</script>
<!-- kembali ke halaman sebelumnya  -->
<script>
    function goBack() {
        window.history.back();
    }
</script>
<!-- file input nama  -->
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<!-- data arsip null  -->
<script>
    $(document).ready(function() {
        $('#itemBerkasTable').DataTable();
    });
</script>
<!-- daftar masuk retensi  -->
<script>
    $(document).ready(function() {
        // Fungsi untuk mengambil data arsip inaktif
        function loadArsipInaktif() {
            $.ajax({
                url: 'pemindahan/getInaktif', // URL endpoint API
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Mengisi tabel dengan data dari API
                    var tbody = $('#arsipTable tbody');
                    tbody.empty(); // Kosongkan isi tabel sebelum diisi

                    // Menambahkan nomor urut
                    var nomorUrut = 1;
                    $.each(data, function(index, arsip) {
                        var row = '<tr>' +
                            '<td>' + nomorUrut++ + '</td>' + // Menampilkan nomor urut
                            '<td>' + arsip.no_dokumen + '</td>' +
                            '<td>' + arsip.judul_dokumen + '</td>' +
                            '<td>' + arsip.tgl_dokumen + '</td>' +
                            '<td><button class="btn btn-outline-danger btn-sm">' + arsip
                            .tahun_cipta + '</button></td>' + // Tombol outline
                            '<td>' + arsip.media_simpan + '</td>' +
                            '</tr>';
                        tbody.append(row);
                    });

                    // Initialize DataTables
                    $('#arsipTable').DataTable();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching data:', textStatus, errorThrown);
                }
            });
        }

        // Panggil fungsi untuk memuat data saat halaman dimuat
        loadArsipInaktif();
    });
</script>
<!-- tabel untuk tambah pemindahan arsip  -->
<script>
    $(document).ready(function() {
        $('#arsipTable').DataTable({
            "ajax": {
                "url": "<?= site_url('pemindahan/getArsipRetensi') ?>",
                "type": "GET",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": null, // Data tidak diperlukan di sini
                    "render": function(data, type, row, meta) {
                        return meta.row + 1; // Nomor urut baris
                    }
                },
                {
                    "data": "judul_dokumen"
                },
                {
                    "data": "no_dokumen"
                },
                {
                    "data": "tgl_dokumen"
                },
                {
                    "data": "tahun_cipta"
                },
                {
                    "data": "umur_aktif",
                    "render": function(data, type, row, meta) {
                        const tahunBatasAktif = parseInt(row.tahun_cipta) + parseInt(data);
                        return `${data} (${tahunBatasAktif})`; // Menampilkan umur aktif dan hasil rumus dalam kurung
                    }
                },
                {
                    "data": "umur_inaktif",
                    "render": function(data, type, row, meta) {
                        const tahunBatasInAktif = parseInt(row.tahun_cipta) + parseInt(data);
                        return `${data} (${tahunBatasInAktif})`; // Menampilkan umur aktif dan hasil rumus dalam kurung
                    }
                },

            ]
        });
    });
</script>
<!-- datepicekr  -->
<script>
    $(document).ready(function() {
        // Inisialisasi datepicker untuk semua elemen dengan kelas .datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Format tanggal
            todayBtn: true, // Tombol untuk memilih tanggal hari ini
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            todayHighlight: true, // Menyoroti tanggal hari ini
            orientation: 'bottom' // Menampilkan datepicker di bawah
        });

        // Membuka datepicker saat ikon kalender diklik
        $('.input-group-text').on('click', function() {
            $(this).siblings('.datepicker').datepicker('show');
        });
    });
</script>
<!-- pilih unit combo box -->
<script>
    $(document).ready(function() {
        function loadBidang(unitID) {
            if (unitID) {
                $.ajax({
                    url: '<?= base_url('pemindahan/getBidang') ?>/' + unitID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#bidang').empty();
                        $.each(data, function(key, value) {
                            $('#bidang').append('<option value="' + value.id + '">' + value
                                .nama_bidang + '</option>');
                        });
                        // Load sub bidang for the first bidang
                        if (data.length > 0) {
                            loadSubBidang(data[0].id);
                        } else {
                            $('#sub_bidang').empty();
                        }
                    }
                });
            } else {
                $('#bidang').empty();
                $('#sub_bidang').empty();
            }
        }

        function loadSubBidang(bidangID) {
            if (bidangID) {
                $.ajax({
                    url: '<?= base_url('pemindahan/getSubBidang') ?>/' + bidangID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#sub_bidang').empty();
                        $.each(data, function(key, value) {
                            $('#sub_bidang').append('<option value="' + value.id + '">' + value
                                .nama_sub_bidang + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_bidang').empty();
            }
        }

        $('#unit').change(function() {
            var unitID = $(this).val();
            loadBidang(unitID);
        });

        $('#bidang').change(function() {
            var bidangID = $(this).val();
            loadSubBidang(bidangID);
        });

        // Load bidang for the first unit on page load
        if ($('#unit').val()) {
            loadBidang($('#unit').val());
        }
    });
</script>
<!-- peminjaman arsip  -->
<script>
    $(document).ready(function() {
        var table = $('#pinjamArsipTable').DataTable({
            ajax: {
                url: '<?= base_url(); ?>/peminjaman/getData',
                dataSrc: ''
            },
            columns: [{
                    "data": null, // Data tidak diperlukan di sini
                    "render": function(data, type, row, meta) {
                        return meta.row + 1; // Nomor urut baris
                    }
                },
                {
                    data: 'id_user'
                },
                {
                    data: 'no_pinjam'
                },
                {
                    data: 'nama_peminjam'
                },
                {
                    data: 'tgl_pinjam'
                },
                {
                    data: 'tgl_kembali'
                },
                {
                    data: 'range_pinjam'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                                <a href="<?= base_url('peminjaman/edit'); ?>/${row.id}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                
                                <a href="<?= base_url('peminjaman/delete'); ?>/${row.id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>

                                <a href="<?= base_url('peminjaman/detail'); ?>/${row.no_pinjam}" class="btn scc-btn btn-sm"><i class="bi bi-printer"></i></a>
                            `;
                    }
                }
            ]
        });
    });
</script>
<!-- mode light / dark  -->
<script>
    $(document).ready(function() {
        // Check if the theme is already set in local storage
        if (localStorage.getItem('theme') === 'dark') {
            $('body').addClass('dark-mode');
            $('#themeIcon').removeClass('fa-sun').addClass('fa-moon');
        }

        // Toggle theme on icon click
        $('#themeToggleBtn').click(function() {
            $('body').toggleClass('dark-mode');

            if ($('body').hasClass('dark-mode')) {
                $('#themeIcon').removeClass('fa-sun').addClass('fa-moon');
                localStorage.setItem('theme', 'dark');
            } else {
                $('#themeIcon').removeClass('fa-moon').addClass('fa-sun');
                localStorage.setItem('theme', 'light');
            }
        });
    });
</script>
<!-- ceklist cekbox  -->
<script>
    $(document).ready(function() {
        $('#arsipTable').DataTable();

        // Select all checkboxes
        $('#selectAll').click(function() {
            $('input[name="id_arsip[]"]').prop('checked', this.checked);
        });
    });
</script>




</body>

</html>