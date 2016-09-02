<div class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        {!! Form::model($question, ['route' => ['audience.question.update', $question], 'method' =>'patch', 'class' => 'layerQuestion'])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit question for {{ strtolower($question->layer->layerName) }} layer.</h4>
            </div>
            <div class="modal-body">
                {!! Form::hidden('layerId', $question->layerId) !!}
                <br />
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="form-group">
                            <div class="fg-line">
                                {!! Form::text('questionTypeName', $question->questionType, ['class' => 'form-control', 'disabled' => true]) !!}
                                {!! Form::hidden('questionType', $question->questionType) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row master {{ isset($question->masterId) ? null : 'hide' }}">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <div class="select">
                                    {!! Form::select('masterId', ['' => ''] + App\Master::lists('masterName', 'masterId')->all(), $question->masterId, ['class' => 'form-control', ($question->masterId > 0) ? 'autofocus' : false]) !!}
                                </div>
                                {!! Form::label('masterId', 'Master', ['class' => 'fg-label']) !!}
                            </div>
                            <small id="masterId" class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row questionText {{ isset($question->questionText) ? null : 'hide' }}">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {!! Form::text('questionText', $question->questionText, ['class' => 'form-control fg-input', isset($question->questionText) ? 'autofocus' : false]) !!}
                                {!! Form::label('questionText', 'Question Text', ['class' => 'fg-label']) !!}
                            </div>
                            <small id="questionText" class="help-block"></small>
                        </div>
                    </div>
                </div>
                <div class="row questionAnswer {{ isset($question->questionAnswer) ? null : 'hide' }}">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {!! Form::text('questionAnswer', $question->questionAnswer, ['class' => 'form-control fg-input', isset($question->questionAnswer) ? 'autofocus' : false]) !!}
                                {!! Form::label('questionAnswer', 'Question Answer', ['class' => 'fg-label']) !!}
                            </div>
                            <small id="questionAnswer" class="help-block"></small>
                        </div>
                    </div>
                </div>
                <div class="row questionFormType {{ isset($question->questionFormType) ? null : 'hide' }}">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <div class="select">
                                    {!! Form::select('questionFormType', $formType, $question->questionFormType, ['class' => 'form-control', isset($question->questionFormType) ? 'autofocus' : false]) !!}
                                </div>
                                {!! Form::label('questionFormType', 'Question Form Type', ['class' => 'fg-label']) !!}
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
                                {!! Form::text('questionDesc', $question->questionDesc, ['class' => 'form-control fg-input', isset($question->questionDesc) ? 'autofocus' : false]) !!}
                                {!! Form::label('questionDesc', 'Question Description', ['class' => 'fg-label']) !!}
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
                                    {!! Form::checkbox('questionIsMandatory', true, $question->questionIsMandatory) !!}
                                    <i class="input-helper"></i> Is Mandatory?
                                </label>
                            </div>
                            <small id="questionIsMandatory" class="help-block"></small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-icon-text edit" type="submit">
                    <i class="zmdi zmdi-check"></i> Save
                </button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>