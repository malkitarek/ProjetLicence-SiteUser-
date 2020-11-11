<style>
    #image{
        height: 75px;
        width: 100px ;

    }
    .image-area {
        text-align: center;
        display: none;
    }
    .image-areae {
        text-align: center;

    }
    .image-remove-button {
        background: rgba(255,255,255,0.5);
        position: absolute;
        display: block;
        font-size: 23px;
        padding: 0 10px;
        color: #333;
    }
</style>
<script>

    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function previewPostImage(input){
        var form_name = '#form-new-post';
        $(form_name + ' .loading-post').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(form_name + ' .image-area img').attr('src', e.target.result);
                $(form_name + ' .image-area').show();
            };

            reader.readAsDataURL(input.files[0]);
        }
        $(form_name + ' .loading-post').hide();
    }
    function removePostImage(){
        var form_name = '#form-new-post';
        $(form_name + ' .image-area img').attr('src', " ");
        $(form_name + ' .image-area').hide();
        resetFile($(form_name + ' .image-input'));
    }
    function removePostImagee(){
        var form_name = '#form-new-post';
        $(form_name + ' .image-areae img').attr('src', " ");
        $(form_name + ' .image-areae').hide();
        resetFile($(form_name + ' .image-input'));
    }
</script>
<div  class="modal fade" id="gr2" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form id="form-new-post" action="{{action("GroupeController@store")}}" enctype="multipart/form-data" method="post">


                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="designation" class="col-sm-2 col-form-label">Designation:</label>
                        <div class="col-sm-10">
                            <input type="text" name="designation" class="form-control" id="designation" required>
                        </div>
                    </div>
                    <div class="image-area">
                        <a href="javascript:;" class="image-remove-button" onclick="removePostImage()"><i class="fa fa-times-circle"></i></a>
                        <img src="" />
                    </div>

                    <div class="form-group row">

                        <label for="designation" class="col-sm-2 col-form-label">Image:</label>
                        <div class="col-sm-10">
                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="image" name="image" onchange="previewPostImage(this)">

                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Membre:</label>
                        <div class="col-sm-10">
                            <select  name="membres[]" id="membres" class="form-control selectpicker"  data-live-search="true" multiple required>

                                @foreach($amis as $ami)
                                    <option value="{{$ami->id}}" >
                                       {{$ami->nom}}&nbsp;{{$ami->prenom}}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit"  class="btn btn-primary" value="Ajouter">
                </div>

            </form>

        </div>
    </div>
</div>
