<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Arsip</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables CSS & JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <h1>Rekapitulasi Arsip</h1>
    <table id="arsipTable" class="display">
        <thead>
            <tr>
                <th>ID Unit</th>
                <th>Nama Unit</th>
                <th>Total Arsip Aktif</th>
                <th>Total Arsip Inaktif</th>
            </tr>
        </thead>
        <tbody>
            <!-- DataTables will populate this section -->
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#arsipTable').DataTable({
                "ajax": {
                    "url": "<?= base_url('dashboard/getArsipData'); ?>",
                    "type": "GET",
                    "dataSrc": "data"
                },
                "columns": [{
                        "data": "id_unit"
                    },
                    {
                        "data": "nama_unit"
                    },
                    {
                        "data": "total_arsip_aktif"
                    },
                    {
                        "data": "total_arsip_inaktif"
                    }
                ]
            });
        });
    </script>
</body>

</html>