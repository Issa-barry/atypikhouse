@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Location")}}</h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title">{{__("Ajout Location")}}</div>
                    <div class="panel-body panel-index">
                        <form action="{{route('location.admin.store',['id'=>'-1','lang'=>request()->query('lang')])}}" method="post">
                            @csrf
                            @include('Location::admin/form',['parents'=>$rows])
                            
                            <div class="">
                                <button class="btn btn-primary" type="submit">{{__("Nouveau")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{route("location.admin.bulkEdit")}}"
                                  class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}

                                <select name="action" class="form-control">
                                    <option value="">{{__(" Action groupée ")}}</option>
                                    <option value="publish">{{__(" Publier ")}}</option>
                                    <option value="draft">{{__(" Déplacer vers brouillons")}}</option>
                                    <option value="delete">{{__(" Supprimer ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-left">
                        <form method="get" action="{{route('location.admin.index')}}" class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            <input type="text" name="s" value="{{ Request()->s }}" class="form-control" placeholder="{{__("Search by name")}}">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit">{{__('Search')}}</button>
                        </form>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{__("Name")}}</th>
                                    <th class="slug d-none d-md-block">{{__("Slug")}}</th>
                                    <th class="status">{{__("Status")}}</th>
                                    <th class="date d-none d-md-block" >{{__("Date")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( count($rows) > 0)
                                    <?php
                                    $traverse = function ($categories, $prefix = '') use (&$traverse) {
                                    foreach ($categories as $row) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{$row->id}}" class="check-item">
                                        </td>
                                        <td class="title">
                                            <a href="{{route('location.admin.edit',['id'=>$row->id])}}">{{$prefix.' '.$row->name}}</a>
                                        </td>
                                        <td class="d-none d-md-block">{{$row->slug}}</td>
                                        <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                        <td class="d-none d-md-block">{{display_date($row->updated_at)}}</td>
                                    </tr>
                                    <?php
                                    $traverse($row->children, $prefix . '-');
                                    }
                                    };
                                    $traverse($rows);
                                    ?>
                                @else
                                    <tr>
                                        <td colspan="5">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section ('script.body')
    {!! \App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                disableScripts:true,
                fitBounds: true,
                center: [{{$row->map_lat ?? setting_item('map_lat_default') }}, {{$row->map_lng ?? setting_item('map_lng_default') }}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    @if($row->map_lat && $row->map_lng)
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {}
                    });
                    @endif
                    engineMap.on('click', function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").attr("value", zoom);
                    })
                }
            });
        })
    </script>
@endsection
