@extends('user.layout.layout')

@section('title', 'Camps')

@section('body')
<div class="row justify-content-center">
    <div class="camps-wrapper">
        @foreach ($data as $camp)
            <div class="camp-card">
                @if (sizeof($camp->photos) > 0)
                    <img class="camp-img" src="{{$camp->photos[0]->url}}" alt="camp image" onerror="this.src='../images/camp_default.jpg';"><img>
                @else
                    <img class="camp-img" src="../images/camp_default.jpg" alt="camp image"><img>
                @endif

                <div class="camp-content">
                    <p class="camp-title">{{ $camp->location }}</p>
                    <p class="camp-cost">{{ number_format($camp->cost, 2) }}</p>
                </div>
                <div class="camp-options">
                    <a href={{route("camps/{id}/payment", $camp->id)}} title="Inscripción" role="button" class="btn btn-sm btn-spinner btn-success" style="width: 30px;">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <a href={{route("camps/{id}/gallery", $camp->id)}} title="Galeria" role="button" class="btn btn-sm btn-spinner btn-info" style="width: 30px;">
                        <i class="fa fa-image"></i>
                    </a>
                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
