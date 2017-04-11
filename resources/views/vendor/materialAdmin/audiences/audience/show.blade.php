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
                                        {{ Form::label(camel_case($q->questionText), $q->questionText, ['class' => 'col-sm-5 control-label f-500']) }}
                                        <div class="col-sm-7">
                                            <p class="form-control-static">
                                                @if(isset($q->master) && $q->master->masterUseAPI)
                                                    {{--*/ $url = $api . strtolower($q->master->masterNamespaces) /*--}}
                                                    @if($q->master->masterName == 'Products')
                                                        @foreach($response->get($q->questionId) as $key => $value)
                                                            <strong>{{ ucwords($key) }}</strong><br />
                                                            @foreach($value as $v)
                                                                {{ json_decode($client->get($url . '/media/' . $v, ['query' => ['token' => $token]])->getBody())->mediaName }} <br />
                                                            @endforeach
                                                            <br />
                                                        @endforeach
                                                    @else
                                                        @foreach($response->get($q->questionId) as $key => $item)
                                                            @if(is_array($item))
                                                                @foreach($item as $i)
                                                                    {{ json_decode($client->get($url . '/' . $key . '/' . $i, ['query' => ['token' => $token]])->getBody())->{$key . 'Name'} }} <br />
                                                                @endforeach
                                                            @else
                                                                {{ json_decode($client->get($url . '/' . $key . '/' . $item, ['query' => ['token' => $token]])->getBody())->{$key . 'Name'} }} <br />
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @else
                                                    @if($q->questionType == 'Multiple Choice' || $q->questionType == 'True Or False')
                                                        @if(is_array($response->get($q->questionId)))
                                                            {{ $q->questionAnswer->only($response->get($q->questionId))->implode(', ') }}
                                                        @else
                                                            {{ $q->questionAnswer->get($response->get($q->questionId)) }}
                                                        @endif
                                                    @else
                                                        {{ $response->get($q->questionId) }}
                                                    @endif
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