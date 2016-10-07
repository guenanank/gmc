@extends('layouts.materialAdmin')

@section('styles')

@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li>{{ link_to('audience', 'Audience') }}</li>
    <li class="active">Upload</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Upload New Audiences <small>Master data of audience.</small></h2>
        <a href="{{ action('AudienceController@index') }}" class="btn bgm-orange pull-right m-r-10 btn-icon" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::open(['method' => 'PUT', 'url' => route('upload.store'), 'class' => 'dropzone', 'id' => 'uploadAudience']) }}
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
{{ Html::script('js/dropzone.min.js') }}
<script type="text/javascript">
    Dropzone.options.uploadAudience = {
        maxFilesize: 2,
        acceptedFiles: 'application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv',
        error: function (file, response) {
            var message = typeof response === 'object' ? response[Object.keys(response)[0]].toString() : response;
            swal({
                type: 'warning',
                title: 'Whops !!',
                text: message,
                timer: 3000,
                showConfirmButton: false
            });
            this.removeFile(file);
        }
    };
</script>
@stop