@extends('layouts.materialAdmin')

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

    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-4">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn btn-primary btn-file m-r-10">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="...">
                    </span>
                    <span class="fileinput-filename"></span>
                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    (function ($) {
        
    })(jQuery);
</script>
@stop