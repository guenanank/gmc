<div class="modal fade" id="create" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <div class="form-group">
                            {{ Form::select('questionType', $questionType, null, ['class' => 'form-control selectpicker', 'title' => 'Choose Question Type']) }}
                            <small id="questionType" class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row master">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group">
                            {{ Form::select('masterId', $masters, null, ['class' => 'form-control selectpicker', 'title' => 'Choose Master']) }}
                            <small id="masterId" class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row questionText">
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

                <div class="row questionAnswer">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ Form::textarea('questionAnswer', null, ['class' => 'form-control fg-input auto-size', 'cols' => '', 'rows' => '']) }}
                                {{ Form::label('questionAnswer', 'Question Answer', ['class' => 'fg-label', 'aria-describedby' => 'help']) }}
                            </div>
                            <span id="help" class="help-block small">Seperate by comma (,)</span>
                            <small id="questionAnswer" class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row questionFormType">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        {{ Form::select('questionFormType', $formType, null, ['class' => 'form-control selectpicker', 'title' => 'Choose Form Type']) }}
                        <small id="questionFormType" class="help-block"></small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ Form::number('questionSort', null, ['class' => 'form-control fg-input']) }}
                                {{ Form::label('questionSort', 'Question Sort Order', ['class' => 'fg-label']) }}
                            </div>
                            <small id="questionSort" class="help-block"></small>
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
