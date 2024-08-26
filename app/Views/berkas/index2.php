<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkas DataTable</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <table id="berkasTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>No Berkas</th>
                <th>Nama Berkas</th>
                <th>Tahun Berkas</th>
                <th>Jumlah Item Berkas</th>
                <th>Aksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>

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
                        data: 'jumlah_item'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `<a href="<?= base_url('berkas/list_item'); ?>/${row.id}" class="btn btn-sm btn-secondary" title="daftar item berkas"><i class="fe fe-eye text-white"></i></a> | <a href="<?= base_url('trial_bug/index'); ?>/${row.id}" class="btn btn-sm btn-info" title="tambah item berkas"><i class="fe fe-plus-square"></i></a>`
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
</body>

</html>