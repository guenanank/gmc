<div class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Audience Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Audience ID</strong></label>
                        <div class="col-sm-10">
                            <p class="form-control-static f-500 c-blue">{{ str_pad($audience->audienceId, 8, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong>Activities</strong></label>
                        <div class="col-sm-10">
                            <p class="form-control-static">
                                @foreach($audience->activities as $index => $activity)
                                    {{ $activity->activityName }}<br />
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="form-wizard-basic fw-container">
                    <ul class="tab-nav text-center">
                        @foreach($audience->layers as $tabNav)
                        <li>{{ link_to('#' . camel_case($tabNav->layerName), $tabNav->layerName, ['data-toggle' => 'tab']) }}</li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($audience->layers as $tabContent)
                        <div class="tab-pane fade {{ $tabContent->layerId == 1 ? 'active in' : null }}" id="{{ camel_case($tabContent->layerName) }}">
                            <div class="form-horizontal">
                                {{--*/ $response = collect(json_decode($tabContent->pivot->audienceLayerResponse, true)) /*--}}
                                @foreach($tabContent->question as $q)
                                    <label class="col-sm-4 control-label f-500">{{ $q->questionText }}</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static">
                                            @if($q->masterId)
                                                @foreach(collect(json_decode($q->master->masterFormat)) as $format)
                                                    @unless($q->master->masterUseAPI == 1)
                                                        {{--*/ $model = 'App\\' . str_singular(ucfirst($format->name)) /*--}}
                                                        @continue(empty($response->get($q->questionId)))
                                                        {{--*/ $master = $model::find($response->get($q->questionId)) /*--}}
                                                        @foreach($format->form->value as $key => $val)
                                                            {{ is_numeric($master->{$val}) ? number_format($master->{$val}) : $master->{$val} }}
                                                            @if(!empty($master->{$val}) && ($key + 1) < count($format->form->value))
                                                                &nbsp;&HorizontalLine;&nbsp;
                                                            @endif
                                                        @endforeach
                                                    @endunless
                                                @endforeach
                                            @else
                                                {{ strtoupper($response->get($q->questionId)) }}
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