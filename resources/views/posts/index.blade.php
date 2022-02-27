@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table" id="table_id">
        <thead>
            <tr>
                <th>actions</th>
                <th>title</th>
                <th>location</th>
                <th>description</th>
                <th>updated_at</th>
                <th>url</th>
                <th>is_published</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $gg)
            <tr>
                <td>
                    <a href="{{ route('publish', $gg ) }}" class="btn btn-info">Publicar</a>
                    <button type="button" class="btn btn-primary">Editar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </td>
                <td scope="row">{{ $gg->title }}</td>
                <td>{{ $gg->location }}</td>
                <td>{{ $gg->description }}</td>
                <td>{{ $gg->updated_at }}</td>
                <td>
                    <a href="{{ $gg->url }}" target="_blank">Ver oferta</a>
                </td>
                <td>
                    @if ( $gg->is_published == false)
                        <span class="badge badge-danger"> No publicado</span>
                    @else
                        <span class="badge badge-success"> Publicado</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('javascript')
<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            "order":[[ 3, "desc"]]
        });
    } );
</script>
@endpush
