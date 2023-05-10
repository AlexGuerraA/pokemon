<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- Datables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
      
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <h1 class="text-center">Pokemon 1&#176; Generaci&oacute;n</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <table id="tabla" class="table table-dark table-striped">
                        <thead>                
                            <th>Nombre</th>
                            <th>url</th>
                            <th>Opci&oacute;n</th>
                        </thead>
                        <tbody>
                            @foreach($pokemons as $pokemon)
                                <tr>
                                    <td>{{$pokemon->name}}</td>
                                    <td>{{$pokemon->url}}</td>
                                    <td><button type="button" class="btn btn-primary" id="click{{$pokemon->name}}">Info</button></td>
                                </tr>
                                <script>
                                    $(document).ready(function() {                                
                                        $('#click{{$pokemon->name}}').on('click', function(){
                                            $.ajax({
                                                type: 'get',
                                                url: "https://pokeapi.co/api/v2/pokemon/{{$pokemon->name}}",
                                                data: {
                                                    
                                                },
                                                success: function(data) { 
                                                    $('#title').empty().html(data['name']);
                                                    $("#img1").attr("src",data['sprites']['back_default']);
                                                    $("#img2").attr("src",data['sprites']['back_shiny']);
                                                    $("#img3").attr("src",data['sprites']['front_default']);
                                                    $("#img4").attr("src",data['sprites']['front_shiny']);
                                                    $('#weight').empty().html(data['weight']);
                                                    $('#height').empty().html(data['height']);

                                        
                                                    var abilities = "";
                                                    data['abilities'].forEach(element => {
                                                        console.log()
                                                        abilities += '<li>'+ element['ability']['name'] + '</li>';
                                                    });
                                                    $("#abilities").empty().html(abilities);

                                                    var types= "";
                                                    data['types'].forEach(element => {
                                                        console.log()
                                                        types += '<li>'+ element['type']['name'] + '</li>';
                                                    });
                                                    $("#type").empty().html(types);
                                                },
                                                error: function(data) {
                                                    console.log(data);
                                                }
                                            });
                                            $('#pokemon').modal("show");
                                        });                                
                                    });
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

         <!-- Modal -->
         <div class="modal fade" id="pokemon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">                                   
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3"><img id="img1"  src="" alt=""></div>
                        <div class="col-3"><img id="img2"  src="" alt=""></div>
                        <div class="col-3"><img id="img3" src="" alt=""></div>
                        <div class="col-3"><img id="img4"  src="" alt=""></div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12" >
                            <h5>Tipo</h5>
                            <ul id="type"></ul>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12" >
                            <h5>Habilidades</h5>
                            <ul id="abilities"></ul>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12" >
                            <h5>Altura</h5>
                            <p id="height"></p>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12" >
                            <h5>peso</h5>
                            <p id="weight"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <!-- Script de datatables -->
        <script>
            $(document).ready(function() {
                $('#tabla').DataTable({
                    "autoWidth": false,
                    "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "lengthMenu": 'Mostrar <select style="background:white">' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="50">50</option>' +
                            '<option value="100">100</option>' +
                            '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias",
                        "infoEmty": "",
                        "infoFiltered": ""
                    }
                });

                $('#click').on('click', function(){
                    $('#pokemon').modal("show");
                });
               
            });
        </script>
    </body>
</html>
