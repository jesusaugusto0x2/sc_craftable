@extends('user.layout.layout')

@section('title', 'Galeria')

<style type="text/css">
    .card-gallery {
        display: grid;
        grid-template-columns: repeat(3, minmax(100px, 293px));
        justify-content: center;
        grid-gap: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(207, 216, 220, 0.35);
    }

    img {
        width: 300px;
        height: 300px;
        cursor: pointer;
        border-radius: 5px;
    }

    img:hover {
        opacity: 0.8;
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
</style>

@section('body')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{$camp->location}} - Galería
                </div>

                <div class="card-body">

                    <div class="card-gallery">
                        @foreach($camp->photos as $photo)
                            <img src="{{$photo->url}}" alt="photo_gallery" onerror="this.style.display='none'">
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-auto">
                            <a style="color:white;" class="btn btn-success" href="{{route($returnRoute)}}">
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
