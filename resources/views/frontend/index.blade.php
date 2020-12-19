@extends('frontend.layouts.app')

@section('content')
<h1>Elenco</h1>
<a href="/download" class="btn btn-primary">Scarica i dati</a>

@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif

<div class="mt-5">
    @if($collection->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <td>Immagine</td>
                    <td>Titolo</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $el)
                    <tr>
                        <td><img src="{{ $el->media }}"></td>
                        <td>
                            {{ $el->title }}<br>
                            <small>Data di scatto: {{ $el->taken_at->isoFormat('dddd DD MMMM YYYY [alle] HH:mm') }}</small>
                        </td>
                        <td><a href="/{{ $el->id }}">Vedi</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert">
            Non sono presenti dati.
        </div>
    @endif
</div>

@endsection
