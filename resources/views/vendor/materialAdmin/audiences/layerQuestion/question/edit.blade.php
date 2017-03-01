<div class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{ Form::model($question, ['route' => ['question.update', $question], 'method' =>'patch', 'class' => 'layerQuestion']) }}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit question for {{ strtolower($question->layer->layerName) }} layer.</h4>
            </div>
            <div class="modal-body">
                {{ Form::hidden('layerId', $question->layerId) }}
                <br />
                
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="form-group">
                            <div class="fg-line">
                                {{ Form::text('questionTypeName', $question->questionType, ['class' => 'form-control', 'disabled' => true]) }}
                                {{ Form::hidden('questionType', camel_case($question->questionType)) }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row master">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <div class="select">
                                    {{ Form::select('masterId', $masters, $question->masterId, ['class' => 'form-control', ($question->masterId > 0) ? 'autofocus' : false, 'title' => 'Chose Master']) }}
                                </div>
                                {{ Form::label('masterId', 'Master', ['class' => 'fg-label']) }}
                            </div>
                            <small id="masterId" class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row questionText">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ Form::text('questionText', $question->questionText, ['class' => 'form-control fg-input', isset($question->questionText) ? 'autofocus' : false]) }}
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
                                {{ Form::textarea('questionAnswer', is_array($question->questionAnswer) ? implode(', ', $question->questionAnswer) : $question->questionAnswer, ['class' => 'form-control fg-input auto-size', 'cols' => '', 'rows' => '', isset($question->questionAnswer) ? 'autofocus' : false]) }}
                                {{ Form::label('questionAnswer', 'Question Answer', ['class' => 'fg-label']) }}
                            </div>
                            <small id="questionAnswer" class="help-block"></small>
                        </div>
                    </div>
                </div>
                
                <div class="row questionFormType">
                    <div class="col-sm-offset-1 col-sm-10">
                        <br />
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <div class="select">
                                    {{ Form::select('questionFormType', $formType, $question->questionFormType, ['class' => 'form-control', isset($question->questionFormType) ? 'autofocus' : false, 'title' => 'Choose Form Type']) }}
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
                                {{ Form::number('questionSort', $question->questionSort, ['class' => 'form-control fg-input', isset($question->questionSort) ? 'autofocus' : false]) }}
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
                                {{ Form::text('questionDesc', $question->questionDesc, ['class' => 'form-control fg-input', isset($question->questionDesc) ? 'autofocus' : false]) }}
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
                                    {{ Form::checkbox('questionIsMandatory', true, $question->questionIsMandatory) }}
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
        {{ Form::close() }}
    </div>
</div>