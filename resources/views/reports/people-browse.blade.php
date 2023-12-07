@extends('voyager::master')

@section('page_title', 'Reporte de Militantes')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-8" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="voyager-people"></i> Reporte de Militantes
                            </h1>
                        </div>
                        <div class="col-md-4" style="margin-top: 30px">
                            <form name="form_search" id="form-search" action="{{ route('reports.people.generate') }}" method="post">
                                @csrf
                                <input type="hidden" name="type">
                                <div class="form-group">
                                    <select name="provincia" id="select-provincia" class="form-control select2">
                                        <option value="">Todas las provincias</option>
                                        @foreach (App\Models\Person::where('deleted_at', NULL)->groupBy('provincia')->get() as $item)
                                        <option
                                            value="{{ $item->provincia }}"
                                            data-municipios='@json(App\Models\Person::where('provincia', $item->provincia)->groupBy('municipio')->get())'
                                            data-localidades='@json(App\Models\Person::where('provincia', $item->provincia)->groupBy('localidad')->get())'
                                        >
                                            {{ Str::upper($item->provincia) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="municipio" id="select-municipio" class="form-control select2">
                                        <option value="">Todas las municipios</option>
                                        @foreach (App\Models\Person::where('deleted_at', NULL)->groupBy('municipio')->get() as $item)
                                        <option value="{{ $item->municipio }}">{{ Str::upper($item->municipio) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="localidad" id="select-localidad" class="form-control select2">
                                        <option value="">Todas las localidades</option>
                                        @foreach (App\Models\Person::where('deleted_at', NULL)->groupBy('localidad')->get() as $item)
                                        <option value="{{ $item->localidad }}">{{ Str::upper($item->localidad) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="status" class="form-control select2">
                                        <option value="">Todos los estados</option>
                                        <option value="1">Activos</option>
                                        <option value="0">Anulados</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="group_by" id="select-group_by" class="form-control select2">
                                        <option value="">Sin agrupar</option>
                                        <option value="provincia">Agrupar por provincia</option>
                                        <option value="municipio">Agrupar por municipio</option>
                                        <option value="operador">Agrupar por operado político</option>
                                    </select>
                                </div>
                                <div class="form-group text-right" id="div-check-summary" style="display:none">
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="checkbox-summary" name="summary" value="1">Resumido</label>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" style="padding: 5px 10px"> <i class="voyager-settings"></i> Generar</button>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div id="div-results" style="min-height: 100px"></div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script>
        $(document).ready(function() {

            $('#select-provincia').change(function(){
                let municipios = $('#select-provincia option:selected').data('municipios');
                let localidades = $('#select-provincia option:selected').data('localidades');
                
                $('#select-municipio').html('<option value="">Todas las municipios</option>');
                if (municipios) {
                    municipios.map(item => {
                        $('#select-municipio').append(`<option value="${item.municipio}">${item.municipio}</option>`);
                    });   
                }

                $('#select-localidad').html('<option value="">Todas las localidades</option>');
                if (localidades) {
                    localidades.map(item => {
                        $('#select-localidad').append(`<option value="${item.localidad}">${item.localidad}</option>`);
                    });   
                }
            });

            $('#select-group_by').change(function(){
                if($(this).val()){
                    $('#div-check-summary').fadeIn();
                }else{
                    $('#div-check-summary').fadeOut();
                    $('#checkbox-summary').prop('checked', false);
                }
            });

            $('#form-search').on('submit', function(e){
                e.preventDefault();
                $('#div-results').empty();
                $('#div-results').loading({message: 'Cargando...'});
                $.post($('#form-search').attr('action'), $('#form-search').serialize(), function(res){
                    $('#div-results').html(res);
                })
                .fail(function() {
                    toastr.error('Ocurrió un error!', 'Oops!');
                })
                .always(function() {
                        $('#div-results').loading('toggle');
                    $('html, body').animate({
                        scrollTop: $("#div-results").offset().top - 70
                    }, 500);
                });
            });
        });

        function report_export(type){
            $('#form-search').attr('target', '_blank');
            $('#form-search input[name="type"]').val(type);
            window.form_search.submit();
            $('#form-search').removeAttr('target');
            $('#form-search input[name="type"]').val('');
        }
    </script>
@stop