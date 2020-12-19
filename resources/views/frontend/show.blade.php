@extends('frontend.layouts.app')

@section('content')
<h1>Dettagli</h1>
<a href="/" class="btn btn-primary">Torna indietro</a>

<div class="mt-5">
    <table class="table">
        <tbody>
            <tr>
                <td>Titolo</td>
                <td>{{ $media->title }}</td>
            </tr>
            <tr>
                <td>Link</td>
                <td><a href="{{ $media->link }}" target="_BLANK">{{ $media->link }}</a></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><img src="{{ $media->media }}"></td>
            </tr>
            <tr>
                <td>Data di scatto</td>
                <td>{{ $media->taken_at->isoFormat('dddd DD MMMM YYYY [alle] HH:mm') }}</td>
            </tr>
            <tr>
                <td>Descrizione</td>
                <td>{!! $media->description !!}</td>
            </tr>
            <tr>
                <td>Data di pubblicazione</td>
                <td>{{ $media->published_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Autore</td>
                <td>{{ $media->author}}<br><small>ID: {{ $media->author_id }}</small></td>
            </tr>
            <tr>
                <td>Tag</td>
                <td>
                    @foreach($media->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag }}</span>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
