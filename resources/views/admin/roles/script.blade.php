<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#dataTable').DataTable({
            searching: true,
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('role.index') }}",
                type: 'GET',
            },
            columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
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
    });

    $(document).on('click', '.hapus', function () {
        let id = $(this).attr('id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data akan dihapus dari daftar!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('role.destroy', '') }}" + "/" + id,
                    type: 'post',
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res, status){
                        if (status === 'success') {
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Berhasil Dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((res) => {
                                    // location.reload(); // Memuat ulang halaman
                                    $('#dataTable').DataTable().ajax.reload()
                                });
                            }, 500);
                        }
                    },
                    error: function(xhr){
                        Swal.fire({
                            icon: 'error',
                            title: 'Izin Tidak Diberikan!',
                        });
                    }
                });
            }
        });
    });
</script>