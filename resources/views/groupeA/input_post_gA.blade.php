



    <div class="card  new-post-box">
        <div class="card-body">




            <img class="rounded-circle"  src="/storage/images/{{Auth::user()->utilisateur->photo}}" style=" border-width: 2px;border-style: solid;border-color: #00A6EB;height: 50px;width: 50px ">
            <textarea  v-model="contenuPGA"  placeholder="Partagez ce que vous pensez ou des photos"></textarea>


            <button type="submit" v-if="contenuPGA && !imagePGA && !attachment" class="btn btn-primary btn-submit" @click="ajouterPostPGA({{$groupeAca->id}})" style="margin-left: 85% ;margin-bottom: -6%">
                Post!
            </button>






            <div v-if="!imagePGA && !attachment" style="margin-top: -2%;position: relative;display: inline-block;">


                <div style="border: 1px solid #ddd;border-radius: 10px; background-color: #efefef;padding: 3px ">
                    <i class="fa fa-image"></i><b>Ajouter Image</b>
                    <input type="file" @change="changerFilePGA" accept="image/*" style="opacity: 0; position: absolute;left: 0;top: 0"/>
                </div>
            </div>
            <div v-if="imagePGA">
                <div class="row">

                    <img :src="imagePGA" width="94%" >
                    <a class="btn" @click="supprimerImgPGA" style="margin-top: -2.5%;margin-left: -2%"><i class="fa fa-times-circle"  ></i></a>
                </div>
                <button class="btn btn-primary btn-submit" @click="uploadImgPGA({{$groupeAca->id}})" style="margin-left: 85% ;margin-bottom: -2%">
                    Post!
                </button>
            </div>
            <form id="new-file-form" action="#" method="#" @submit.prevent="submitForm({{$groupeAca->id}})"style="margin-top: -2%;position: relative;display: inline-block;margin-left: 10%" >
                @csrf
                <div v-if="!attachment && !imagePGA" style="margin-top: -2%;position: relative;display: inline-block;">



                <div style="border: 1px solid #ddd;border-radius: 10px; background-color: #efefef;padding: 3px ">
                    <i class="fa fa-file"></i><b>Ajouter fichier</b>
                    <input type="file"  ref="file" name="file" @change="addFile()" style="opacity: 0; position: absolute;left: 0;top: 0"/>

                </div>
            </div>
                    <div v-if="attachment">
                        <div class="row" style="margin-bottom: 10%">

                            <i class="fa fa-file fa-3x"> </i>&nbsp;&nbsp;
                            <h5 style="margin-top: 2%">Est-ce-que voulez vraiment poster cet fichier</h5>
                            <a class="btn" @click="supprimerFilePGA" style="margin-top: -2.5%;margin-left: -2%"><i class="fa fa-times-circle"  ></i></a>
                        </div>


                        <button class="btn btn-primary btn-submit" type="submit" style="margin-left: 85% ;margin-bottom: -2%">
                            Post!
                        </button>
                    </div>
                </form>


        </div>
    </div>
