@section('js')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- isotope -->
	<script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('success') }}");
        @endif
      
        @if(Session::has('errors'))
        toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            @foreach ($errors->all() as $errors)
                toastr.error("{{ $errors }}");
            @endforeach
        @endif
      
        @if(Session::has('warning'))
            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.warning("{{ session('warning') }}");
        @endif

        function get_menu(id) {
            var url = '{{ url("get_product") }}/'+id
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#addcartModal').modal('show')
                    $('#barangId').val(data.id)
                    $('#namaBarang').val(data.nama_barang)
                    $('#hargaBarang').val(data.harga_barang)
                }
            });
        }

        // Product Quantity
        $('.quantity button').on('click', function () {
            var button = $(this);
            var oldValue = button.parent().parent().find('input').val();
            if (button.hasClass('btn-plus')) {
                var newVal = parseFloat(oldValue) + 1;                
            } else {
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            var price = $('#hargaBarang').val();
            var quantity = newVal;
            var total = parseInt(price)*parseInt(quantity);
            $('#totalPrice').val(total);
            button.parent().parent().find('input').val(newVal);
        });
      </script>
@endsection