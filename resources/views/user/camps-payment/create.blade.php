@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Inscripción' )

<style type="text/css">
    #img-preview {
        display: none;
    }
</style>

@section('body')

    <div class="container-xl">

                <div class="card">

        <camps-payment-form
            :action="'{{ url('camps/' . $camp->id . '/payment') }}'"
            :data="{{$payment}}"
            v-cloak
            inline-template>

            <form
                class="form-horizontal form-create"
                method="post"
                @submit.prevent="onSubmit" :action="action"
                novalidate
                enctype="multipart/form-data"
                id="CreateForm"
            >
                {{ csrf_field() }}
                <div class="card-header">
                    <i class="fa fa-plus"></i> {{$camp->location}} - Inscripción
                </div>

                <div class="card-body">
                    @include('user.camps-payment.components.form-elements')
                </div>


            </form>
        </camps-payment-form>

        <form class="form-inline"
            action="{{route('camps/{id}/payment/save-photo', $camp->id)}}"
            method="POST"
            enctype="multipart/form-data"
            id="form_photo"
        >
            {{ csrf_field() }}

            <div class="form-group input-photo-wrapper">
                <label for="input-photo" id="label-photo" class="btn btn-success">
                    <i class="fa fa-camera"></i> Agregar comprobante
                </label>

                <input type="file" name="photo" id="input-photo" onchange="readImage(this)"
                    accept="image/png, image/jpeg"
                >
            </div>
        </form>
        <div class="row d-flex justify-content-center">
            <img id="img-preview" src="/images/no_image.png" alt="Tu imagen" />
        </div>


        <div class="card-footer">
            <a style="color:white;" class="btn btn-success" href="{{route('camps/index')}}">
                <i class="fa fa-chevron-left"></i> Regresar
            </a>
            <button type="submit" form="CreateForm" class="btn btn-primary" >
                <i class="fa fa-download"></i>
                inscribirse
            </button>
        </div>
        </div>

        </div>
@endsection

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous">
</script>

<script type="text/javascript">
   $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

   $(function () {

        $('#form_photo').on('submit', function (e) {
            e.preventDefault();
            var file_data = $('#input-photo').prop('files')[0];
            var form_data = new FormData();
            form_data.append('photo', file_data);
            $.ajax({
                url: "{{route('camps/{id}/payment/save-photo', $camp->id)}}",
                dataType    : 'text',
                cache       : false,
                contentType : false,
                processData : false,
                data        : form_data,
                type        : 'post',
            });

        });

    });

    function readImage (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result); 
                $('#img-preview').show(); // Renderizamos la imagen
                $("#form_photo").submit();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
