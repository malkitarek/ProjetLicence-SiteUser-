@section('css')
    <style>
        .new-post-box {
            -webkit-box-shadow: 0px 0px 20px 2px rgba(0,0,0,0.15);
            -moz-box-shadow: 0px 0px 20px 2px rgba(0,0,0,0.15);
            box-shadow: 0px 0px 20px 2px rgba(0,0,0,0.15);
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            padding: 0;
            margin: 0 0 25px 0;
        }

        .new-post-box textarea {
            outline: none;
            -webkit-appearance: none;
            resize: none;
            border: none;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            width: 100%;
            font-size: 18px;
            color: #333;
            height: 30px;
            margin-top: 10px;
            padding: 0;
        }

        .new-post-box textarea::-webkit-input-placeholder {
            font-size: 13px;
            color: #9d9d9d;
            font-style: italic;
        }

        .new-post-box hr {
            margin: 10px 0;
        }



        .new-post-box .btn-add-image {
            background: #ececec;
            border-color: #d9d9d9
        }

        .new-post-box .btn-add-image:hover {
            background: #d9d9d9;
            border-color: #c8c8c8
        }

        .new-post-box .btn-submit {
            background: #488ec9;
            border-color: #3c76a7;
            padding-left: 20px;
            padding-right: 20px;
            color: #fff
        }

        .new-post-box .btn-submit:hover {
            background: #3c76a7;
            border-color: #2e5679;
        }

        .new-post-box .loading-post {
            display: none;
        }

        .new-post-box .loading-post img {
            width: 25px;
            height: 25px;
        }

        .new-post-box .image-area {
            text-align: center;
            display: none;
        }

        .new-post-box .image-area img{
            max-width: 100%;
        }

        .new-post-box .image-remove-button {
            background: rgba(255,255,255,0.5);
            position: absolute;
            display: block;
            font-size: 23px;
            padding: 0 10px;
            color: #333;
        }

        .new-post-box .image-remove-button:hover {
            color: #000;
        }


    </style>

@endsection

<div class="col-md-8" style="margin-left: 20%;margin-top: -4%" xmlns:v-on="http://www.w3.org/1999/xhtml">

    <div class="card  new-post-box">
        <div class="card-body">
         <p>@{{ test }}</p>



                <img class="rounded-circle"  src="/storage/images/{{Auth::user()->utilisateur->photo}}" style=" border-width: 2px;border-style: solid;border-color: #00A6EB;height: 50px;width: 50px ">
                <textarea  v-model="contenu"  placeholder="Partagez ce que vous pensez ou des photos" ></textarea>


                    <button type="submit" v-if="contenu  && !image" class="btn btn-primary btn-submit" @click="ajouterPost" style="margin-left: 85% ;margin-bottom: -6%">
                        Post!
                    </button>






            <div v-if="!image" style="margin-top: -2%;position: relative;display: inline-block;">


               <div style="border: 1px solid #ddd;border-radius: 10px; background-color: #efefef; ">
                <i class="fa fa-image"></i><b>Ajouter Image</b>
                <input type="file" @change="changerFile" accept="image/*" style="opacity: 0; position: absolute;left: 0;top: 0"/>
               </div>
            </div>
            <div v-else>
                <div class="row">

                    <img :src="image" width="94%" >
                    <a class="btn" @click="supprimerImg" style="margin-top: -2.5%;margin-left: -2%"><i class="fa fa-times-circle"  ></i></a>
                </div>
                <button class="btn btn-primary btn-submit" @click="uploadImg" style="margin-left: 85% ;margin-bottom: -2%">
                    Post!
                </button>
            </div>

        </div>
    </div>
</div>