<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container text-center">
            <div class="d-inline">
                <h1 class="text-center mx-auto">Pariwisata</h1>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add New
                </button>
            </div>

            <hr/>

            <div id="content" class="row"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" id="pariwisata_form" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <div class="form-group" id="field-pariwisata_nama">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="pariwisata_nama" name="pariwisata_nama" placeholder="Nama Pariwisata">
                        </div>

                        <div class="form-group" id="field-pariwisata_alamat">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="pariwisata_alamat" name="pariwisata_alamat" placeholder="Alamat Pariwisata">
                        </div>

                        <div class="form-group" id="field-pariwisata_detail">
                            <label>Deskripsi</label>
                            <textarea class="form-control" id="pariwisata_detail" name="pariwisata_detail" placeholder="Deskripsi"></textarea>
                        </div>

                        <div class="form-group" id="field-pariwisata_gambar">
                            <label>Gambar</label>
                            <input type="file" id="pariwisata_gambar" name="pariwisata_gambar" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script>
            let api_url = "{{ url('api/v0/pariwisata') }}";

            $(document).ready(function(){
                loadData();
            });
            
            function loadData(){
                $.ajax({
                    url: api_url,
                    method: "GET",
                    contentType: "application/json",
                    dataType: "json",
                    success: function(result){
                        console.log(result);

                        let data = result.data;
                        let html_content = "";
                        $.each(data, function(index, value){
                            console.log("Result : "+value);
                            html_content += 
                            "<div class='col-12 col-md-4'>"
                                +"<div class='card mb-2'>"
                                    +"<img src='"+value.pariwisata_gambar+"' class='card-img-top'>"
                                    +"<div class='card-body'>"
                                        +"<h1 class='card-title'>"+value.pariwisata_nama+"</h1>"
                                    +"</div>"
                                +"</div>"
                            +"</div>";
                        });

                        $("#content").html(html_content);
                    }
                });
            }

            $("#pariwisata_form").submit(function(e){
                e.preventDefault();
                console.log(api_url);

                // Remove All Error
                $(".invalid-feedback").remove();
                $(".form-control").removeClass("is-invalid");

                var formData = new FormData(this);
                console.log(formData);

                $.ajax({
                    url: api_url,
                    method: "POST",
                    contentType: "application/json",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        console.log(result);
                        $("#exampleModal").modal('hide');
                        loadData();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(jqXHR);

                        $.each(jqXHR.responseJSON.errors, function(key, result) {
                            //Append Error Field
                            $("#"+key).addClass('is-invalid');
                            //Append Error Message
                            $("#field-"+key).append("<div class='invalid-feedback'>"+result+"</div>");
                        });
                    }
                });
            });
        </script>
    </body>
</html>
