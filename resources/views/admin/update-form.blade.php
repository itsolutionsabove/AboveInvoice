@extends('layouts.admin')

@section('sub_content')
    <x-dashboard.page-header :global="$global" />
    <x-dashboard.page-body :global="$global">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$global->data->formTitle}}</h4>
                        </div>
                        {{$global->VEService->drawForm($global->data->targetModel, $global->data->submitLink, $global->data->form_defaults ?? [], "PUT")}}
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard.page-body>
    <x-dashboard.footer :global="$global" />
@endsection
