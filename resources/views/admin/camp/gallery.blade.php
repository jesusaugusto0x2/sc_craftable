@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Camp Gallery')

<style type="text/css">
    .card-gallery {
        display: grid;
        grid-template-columns: repeat(3, minmax(100px, 293px));
        justify-content: center;
        grid-gap: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(207, 216, 220, 0.35);
    }

    .photo-cover {
        position: relative;
        width: 300px;
        height: 300px;
        border-radius: 5px;
    }

    .photo-cover > a {
        display: none;
        position: absolute;
        font-size: 64px;
        left: 50%;
        top: 50%;
        margin-left: -27px;
        margin-top: -20px;
    }

    img {
        width: 100%;
        border-radius: inherit;
    }

    .photo-cover:hover {
        opacity: 0.7;
    }

    .photo-cover:hover > a {
        color: black;
        display: block;
    }

    a:hover {
        cursor: pointer;
    }

    .title {
        color: #4273FA;
        font-size: 18px;
    }

    .card-block {
        border-bottom: 1px solid rgba(207, 216, 220, 0.35);
    }

    #input_photo {
        display: none;
    }

    #label_photo {
        color: white;
        margin-right: 15px;
    }

    #label_photo > i {
        margin-right: 4px;
    }

    #img_preview {
        display: none;
    }
</style>

@section('body')
    <div class="col-lg-12">
        @if($notificacion = Session::get('notification_success'))
            <div class="notification notification-success">{{ $notificacion }}</div>
        @endif
        @if($notificacion_error = Session::get('notification_error'))
            <div class="notification notification-error">{{ $notificacion_error }}</div>
        @endif
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{$camp->location}} - Galería
                </div>

                <div class="card-body">

                    <div class="card-gallery">
                        @foreach($camp->photos as $photo)
                            <div class="photo-cover">

                                <a href="{{route('admin/camps/gallery/delete-photo', $photo->id)}}" title="Eliminar">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <img src="{{$photo->url}}" alt="photo_gallery">
                            </div>
                        @endforeach
                    </div>

                    <div class="card-block">
                        <div class="row title">
                            <strong>Agregar una nueva foto:</strong>
                        </div>
                        <br>

                        <div class="row">
                            <form class="form-inline"
                                action="{{route('admin/camps/gallery/save-photo', $camp->id)}}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="input_photo" id="label_photo" class="btn btn-success">
                                        <i class="fa fa-camera"></i> Elige una foto
                                    </label>

                                    <input type="file" name="photo" id="input_photo" onchange="readImage(this)"
                                        accept="image/png, image/jpeg"
                                    >

                                    <button type="submit" class="btn btn-danger" title="Subir una foto">
                                        <i class="fa fa-upload"></i> Guardar foto
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <img id="img_preview" src="/images/no_image.png" alt="Tu imagen" />
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-auto">
                            <a style="color:white;" class="btn btn-success" href="{{route('admin/camps/index')}}">
                                <i class="fa fa-chevron-left"></i> Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End of card body -->
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
    function readImage (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview').attr('src', e.target.result);
                $('#img_preview').show(); // Renderizamos la imagen
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
