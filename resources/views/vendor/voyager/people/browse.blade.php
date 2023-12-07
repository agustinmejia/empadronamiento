@extends('voyager::master')

@section('page_title', 'Viendo Militantes')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h1 class="page-title">
                    <i class="voyager-people"></i> Militantes
                </h1>
            </div>
            <div class="col-md-8 text-right" style="padding-top: 10px">
                <a href="{{ route('voyager.people.create') }}" class="btn btn-success btn-add-new">
                    <i class="voyager-plus"></i> <span>Crear</span>
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="dataTables_length" id="dataTable_length">
                                    <label>
                                        Mostrar
                                        <select id="select-paginate" class="form-control input-sm select-filter">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        registros
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 text-right">
                                <input type="text" id="input-search" placeholder="Buscar..." class="form-control">
                                <br>
                                <div>
                                    <label class="radio-inline"><input type="radio" class="radio-status" name="optradio" value="" checked>Todos</label>
                                    <label class="radio-inline"><input type="radio" class="radio-status" name="optradio" value="1">Habilitados</label>
                                    <label class="radio-inline"><input type="radio" class="radio-status" name="optradio" value="0">Anulados</label>
                                </div>
                            </div>
                        </div>
                        <div id="results" class="row"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el siguiente registro?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script>
        var countPage = 10;
        var status = '';

        $(document).ready(function() {
            list();
                
            $('#input-search').on('keyup', function(e){
                if(e.keyCode == 13) {
                    list();
                }
            });

            $('.select-filter').change(function(){
                countPage = $('#select-paginate').val();
                list();
            });

            $('.radio-status').click(function(){
                status = $(this).val();
                list();
            });
        });

        function list(page = 1){
            let url = '{{ route("people.list") }}';
            let search = $('#input-search').val() ? $('#input-search').val() : '';
            $.ajax({
                url: `${url}?search=${search}&status=${status}&paginate=${countPage}&page=${page}`,
                type: 'get',
                success: function(response){
                    $('#results').html(response);
                }
            });
        }

        function deleteItem(url){
            $('#delete_form').attr('action', url);
        }

    </script>
@stop
