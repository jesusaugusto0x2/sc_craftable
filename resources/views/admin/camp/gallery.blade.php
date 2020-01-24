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

    img {
        width: 300px;
        height: 300px;
        cursor: pointer;
        border-radius: 5px;
    }

    img:hover {
        opacity: 0.8;
    }

    .card-block {

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
                            <img src="{{$photo->url}}" alt="photo_gallery">
                        @endforeach
                    </div>


                    <div class="form-horizontal">

                              <div class="form-group">
                                <label class="control-label col-md-3">Upload Image</label>
                                <div class="col-md-8">
                                  <div class="row">
                                    <div id="demo"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-8">
                                  <input type="submit" class="btn btn-primary" value="Send">
                                </div>
                              </div>
                            </div>

                    <br><br>
                    <div class="row">
                        <div class="col-auto">
                            <a style="color:white;" class="btn btn-success" href="{{route('admin/camps/index')}}">
                                <i class="fa fa-chevron-left"></i> Regresar
                            </a>
                        </div>

                        <form class="col-auto">
                            <input type="file" name="myFile">
                            <button type="submit" class="btn btn-danger" title="Subir una foto">
                                <i class="fa fa-upload"></i> Subir una foto
                            </button>
                        </form>
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

<script src="/js/spartan-multi-image-picker.js"></script>

<script type="text/javascript">
    $("#demo").spartanMultiImagePicker({

        fieldName:  'fileUpload[]',
        rowHeight : '200px',
	    groupClassName : 'col-md-4 col-sm-4 col-xs-6',
    });
</script>
