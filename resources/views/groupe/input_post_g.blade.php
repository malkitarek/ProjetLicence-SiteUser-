



<div class="card  new-post-box">
    <div class="card-body">




        <img class="rounded-circle"  src="/storage/images/{{Auth::user()->utilisateur->photo}}" style=" border-width: 2px;border-style: solid;border-color: #00A6EB;height: 50px;width: 50px ">
        <textarea  v-model="contenuPG"  placeholder="Partagez ce que vous pensez ou des photos"></textarea>


        <button type="submit" v-if="contenuPG && !imagePG && !attachmentt" class="btn btn-primary btn-submit" @click="ajouterPostPG({{$groupeAca->id}})" style="margin-left: 85% ;margin-bottom: -6%">
            Post!
        </button>






        <div v-if="!imagePG && !attachmentt" style="margin-top: -2%;position: relative;display: inline-block;">


            <div style="border: 1px solid #ddd;border-radius: 10px; background-color: #efefef;padding: 3px ">
                <i class="fa fa-image"></i><b>Ajouter Image</b>
                <input type="file" @change="changerFilePG" accept="image/*" style="opacity: 0; position: absolute;left: 0;top: 0"/>
            </div>
        </div>
        <div v-if="imagePG">
            <div class="row">

                <img :src="imagePG" width="94%" >
                <a class="btn" @click="supprimerImgPG" style="margin-top: -2.5%;margin-left: -2%"><i class="fa fa-times-circle"  ></i></a>
            </div>
            <button class="btn btn-primary btn-submit" @click="uploadImgPG({{$groupeAca->id}})" style="margin-left: 85% ;margin-bottom: -2%">
                Post!
            </button>
        </div>
        <form id="new-file-form" action="#" method="#" @submit.prevent="submitFormm({{$groupeAca->id}})"style="margin-top: -2%;position: relative;display: inline-block;margin-left: 10%" >
            @csrf
            <div v-if="!attachmentt && !imagePG" style="margin-top: -2%;position: relative;display: inline-block;">



                <div style="border: 1px solid #ddd;border-radius: 10px; background-color: #efefef;padding: 3px ">
                    <i class="fa fa-file"></i><b>Ajouter fichier</b>
                    <input type="file"  ref="filee" name="filee" @change="addFilee()" style="opacity: 0; position: absolute;left: 0;top: 0"/>

                </div>
            </div>
            <div v-if="attachmentt">
                <div class="row" style="margin-bottom: 10%">

                    <i class="fa fa-file fa-3x"> </i>&nbsp;&nbsp;
                    <h5 style="margin-top: 2%">Est-ce-que voulez vraiment poster cet fichier</h5>
                    <a class="btn" @click="supprimerFilePG" style="margin-top: -2.5%;margin-left: -2%"><i class="fa fa-times-circle"  ></i></a>
                </div>


                <button class="btn btn-primary btn-submit" type="submit" style="margin-left: 85% ;margin-bottom: -2%">
                    Post!
                </button>
            </div>
        </form>


    </div>
</div>
