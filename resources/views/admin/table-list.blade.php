@extends('layouts.admin')

@section('sub_content')
    <x-dashboard.page-header :global="$global" />
    <x-dashboard.page-body :global="$global">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{$global->data->targetName}}
                        </div>
                        <div class="card-body">
                            {{$global->VEService->drawTable($global->data->dataAPI, $global->data->columns, $global->data->searches ?? [])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard.page-body>
    <x-dashboard.footer :global="$global" />
@endsection
