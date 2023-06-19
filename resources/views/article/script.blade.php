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
                    url: "{{ route('article.index') }}",
                    type: 'GET',
                },
                columns: [{
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
        });

        // hapus
        $(document).on('click', '.hapus', function () {
            let id = $(this).attr('id')
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
                        url : "{{ route('article.delete') }}",
                        type: 'post',
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res, status){
                            if (status = '200'){
                                setTimeout(() => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil Dihapus',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((res) => {
                                        $('#dataTable').DataTable().ajax.reload()
                                    })
                                });
                            }
                        },
                        error: function(xhr){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Data Gagal dihapus',
                            })
                        }
                    })
                }
            })
        })
</script>