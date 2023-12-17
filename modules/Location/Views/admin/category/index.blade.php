@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Location Categories")}}</h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title">{{__("Ajout Categorie")}}</div>
                    <div class="panel-body">
                        <form action="{{route('location.admin.category.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
                            @csrf
                            @include('Location::admin.category.form',['parents'=>$rows])
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
                            <form method="post" action="{{route('location.admin.category.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Action groupée ")}}</option>
                                    <option value="publish">{{__(" Publier ")}}</option>
                                    <option value="draft">{{__(" Déplacer vers brouillons")}}</option>
                                    <option value="delete">{{__(" Supprimer ")}}</option>
                                </select>
                                <button data-confirm="{{__("Voulez-vous supprimer ?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Appliquer')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-left">
                        <form method="get" action="{{route('location.admin.category.index')}} " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            <input type="text" name="s" value="{{ Request()->s }}" class="form-control" placeholder="{{__("Rechercher par nom.")}}">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit">{{__('Recherche')}}</button>
                        </form>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{__("Name")}}</th>
                                    <th class="slug d-none">{{__("Slug")}}</th>
                                    <th class="status">{{__("Status")}}</th>
                                    <th class="date">{{__("Date")}}</th>
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
                                            <td class="title">
                                                <a href="{{route('location.admin.category.edit',$row)}}">{{$prefix.' '.$row->name}}</a>
                                            </td>
                                            <td class="d-none">{{$row->slug}}</td>
                                            <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                            <td class="">{{ display_date($row->updated_at)}}</td>
                                        </tr>
                                        <?php
                                        $traverse($row->children, $prefix . '-');
                                        }
                                    };
                                    $traverse($rows);
                                    ?>
                                @else
                                    <tr>
                                        <td colspan="5">{{__("Aucune donnée.")}}</td>
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
