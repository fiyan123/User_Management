<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Set CSRF Token pada setiap permintaan AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Inisialisasi DataTables
        var table = $('#dataTable').DataTable({
            searching: true,
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('article.index') }}",
                type: 'GET',
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'pembuat',
                    name: 'pembuat'
                },
                {
                    data: 'tanggal_dibuat',
                    name: 'tanggal_dibuat',
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            order: [
                [0, 'asc']
            ]
        });

        // Hapus data
        $(document).on('click', '.hapus', function () {
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan dihapus dari daftar!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('article.delete') }}",
                        type: 'post',
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res, status){
                            if (status == 'success'){
                                setTimeout(() => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil Dihapus',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((res) => {
                                        table.ajax.reload();
                                    });
                                });
                            }
                        },
                        error: function(xhr){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Data Gagal dihapus',
                            });
                        }
                    });
                }
            });
        });

        // Form submit event
        $('#filterForm').on('submit', function (e) {
            e.preventDefault();
            table.ajax.reload();
        });
    });
</script>