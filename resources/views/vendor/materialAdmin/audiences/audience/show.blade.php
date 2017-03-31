<div class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Audience Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        {{ Form::label('audienceId', 'Audience ID', ['class' => 'col-sm-2 control-label c-black']) }}
                        <div class="col-sm-10">
                            <p class="form-control-static f-500 c-blue">{{ str_pad($audience->audienceId, 8, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('activityId', 'Activities', ['class' => 'col-sm-2 control-label c-black']) }}
                        <div class="col-sm-10">
                            <p class="form-control-static">
                                @foreach($audience->activities as $activity)
                                    {{ $activity->activityName }}<br />
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="form-wizard-basic fw-container">
                    <ul class="tab-nav text-center">
                        @foreach($audience->layers as $i => $tabNav)
                        <li class="{{ $i < 1 ? 'active' : null }}">{{ link_to('#' . camel_case($tabNav->layerName), $tabNav->layerName, ['data-toggle' => 'tab']) }}</li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($audience->layers as $index => $tabContent)
                            <div class="tab-pane fade {{ $index < 1 ? 'active in' : null }}" id="{{ camel_case($tabContent->layerName) }}">
                                <div class="form-horizontal">
                                    {{--*/ $response = collect(json_decode($tabContent->pivot->audienceLayerResponse, true)) /*--}}
                                    @foreach($tabContent->questions as $q)
                                        {{ Form::label(camel_case($q->questionText), $q->questionText, ['class' => 'col-sm-4 control-label f-500']) }}
                                        <div class="col-sm-8">
                                            <p class="form-control-static">
                                                @if($q->masterId)
                                                    {{ dump('here') }}
                                                @else
                                                    {{ dump($response->get($q->questionId)) }}
                                                @endif
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>