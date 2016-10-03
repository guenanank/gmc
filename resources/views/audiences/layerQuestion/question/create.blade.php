<div class="modal fade" id="create" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{ Form::open(['route' => 'question.store', 'class' => 'layerQuestion']) }}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new question for {{ strtolower($layer->layerName) }} layer.</h4>
            </div>
            <div class="modal-body">
                {{ Form::hidden('layerId', $layer->layerId) }}
                <br />
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <div class="select">
                                    {{ Form::select('questionType', $questionType, null, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('questionType', 'Question Type', ['class' => 'fg-label']) }}
                            </div>
                            <small id="questionType" class="help-block"></small>
                        </div>
                    </div>
                </div>
                <div class="row master hide">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <div class="select">
                                    {{ Form::select('masterId', [''=>''] + App\Master::lists('masterName', 'masterId')->all(), null, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('masterId', 'Master', ['class' => 'fg-label']) }}
                            </div>
                            <small id="masterId" class="help-block"></small>
                        </div>
                    </div>
                </div>
                <div class="row questionText hide">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ Form::text('questionText', null, ['class' => 'form-control fg-input']) }}
                                {{ Form::label('questionText', 'Question Text', ['class' => 'fg-label']) }}
                            </div>
                            <small id="questionText" class="help-block"></small>
                        </div>
                    </div>
                </div>
                <div class="row questionAnswer hide">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ Form::text('questionAnswer', null, ['class' => 'form-control fg-input']) }}
                                {{ Form::label('questionAnswer', 'Question Answer', ['class' => 'fg-label', 'aria-describedby' => 'help']) }}
                            </div>
                            <span id="help" class="help-block small">Seperate by comma (,)</span>
                            <small id="questionAnswer" class="help-block"></small>
                        </div>
                    </div>
                </div>
                
                <div class="row questionFormType hide">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <div class="select">
                                    {{ Form::select('questionFormType', $formType, null, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('questionFormType', 'Question Form Type', ['class' => 'fg-label']) }}
                            </div>
                            <small id="questionFormType" class="help-block"></small>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ Form::text('questionDesc', null, ['class' => 'form-control fg-input']) }}
                                {{ Form::label('questionDesc', 'Question Description', ['class' => 'fg-label']) }}
                            </div>
                            <small id="questionDesc" class="help-block"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('questionIsMandatory', true) }}
                                    <i class="input-helper"></i> Is Mandatory?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-icon-text waves-effect" type="submit">
                    <i class="zmdi zmdi-check"></i> Save
                </button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
