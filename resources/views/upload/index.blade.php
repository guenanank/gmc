@extends('layouts.materialAdmin')

@section('styles')

{{ Html::style('css/dropzone.css') }}

@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li>{{ link_to('audience/audience', 'Audience') }}</li>
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
        {{ Form::open(['route' => 'audience.upload.store', 'method' => 'PUT', 'class' => 'dropzone']) }}
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
{{ Html::script('js/dropzone.min.js') }}
<script type="text/javascript">
(function ($) {

    //$('#uploadAudience').dropzone();

})(jQuery);
</script>
@stop