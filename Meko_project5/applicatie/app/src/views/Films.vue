<template>
  <div class="rot">
    <!-- <h1>{{$route.params.id}}</h1> -->
    <div class="card mb-3" style="max-width: 1400%">
      <div class="row no-gutters"  v-if="filmsData.length > 0">
        <div class="col-md-4">
          <img :src="require(`@/films_imgs/${filmsData[0].img}`)" class="card-img" style="max-width: 1000px" alt="..."/>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h1 class="card-title">{{ filmsData[0].film }}</h1>
            <h4 class="card-text">{{ filmsData[0].jaar }} | {{ filmsData[0].land }}</h4>
            <p class="card-text">{{ filmsData[0].beschrijving }}</p>
            <p>Regisseur:<router-link :to="{name: 'Person', params: { id: filmsData[0].regisseur } }" >{{ filmsData[0].regisseur }}</router-link></p>
            Acteurs: <router-link v-for="acteur in filmsData" :key="acteur.naam" :to="{ name: 'Person', params: { id:acteur.id } }" > {{  acteur.naam }},  </router-link>
          </div>
        </div>
      </div>
        <!-- <pre>{{filmsData}}</pre> -->
        
        
        <form>
          <h1>Rate this film</h1>
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="email" class="form-control" id="userName" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">*If you are not logged in yet, your name will appear as unknown.</small>
          </div>
          <div class="form-group">
            Rate this film:<textarea class="form-control" id="review" rows="3"></textarea>
          </div>
 
          <i class="fas fa-star starChecked " id="rating1"></i>
          <i class="fas fa-star starChecked" id="rating2"></i>
          <i class="fas fa-star starChecked" id="rating3"></i>
          <i class="fas fa-star" id="rating4"></i>
          <i class="fas fa-star" id="rating5"></i>



          <button type="submit" class="btn btn-primary" id="button" @click.prevent="addReview">Reply</button>
        </form>
        <br><br>
        




          <div class="card" id="pp"  v-for="review in reviewsforshowing" :key="review.id">
            <div class="card-header">   
            
            </div>

            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>Unknown</p>
                <footer class="footer">{{review.review}}</footer>
              </blockquote>
            </div> 
          </div>

        </div>



    <router-view />
  </div>
</template>


<script>
export default {
  data() {
    return {
      filmsData: [],
      reviewsforshowing:[],
      starValue:'',
      starDD:[
        {value:'5',id:'rating5'},{value:'4',id:'rating5'},{value:'3',id:'rating3'},
        {value:'2',id:'rating2'},
        {value:'1',id:'rating1'}
      ]

    };
  },
  methods: {
    getFilmsData() {
      fetch("http://localhost/project_jaar2/Meko_project5/applicatie/api/webroot/show_json.php?id=" +this.$route.params.id)
        .then((response) => response.json())
        .then((data) => (this.filmsData= data))
    },
    

    addReview(){
      var filmId=this.$route.params.id;
      var starid='';
      var review=document.querySelector('#review');
      var reviewValue=review.value;
      // var alleItems=document.querySelector('.rating').querySelectorAll('input');
      // for(let i=0; i<alleItems.length; i++){
      //   if(alleItems[i].checked===true){
      //     // console.log(alleItems[i].id);
      //     starid=alleItems[i].id;  
      //   }
      // }
      
      

      var obj={
        name:"Unknown",
        reviews:[],
      };

      var reviewWithSter={review:reviewValue, ster:starid};
      obj.reviews.push(reviewWithSter);
      
      var ObjsString=JSON.stringify(obj);
      
      if(localStorage.getItem('filmId-'+filmId) ===null ){
        localStorage.setItem('filmId-'+filmId, ObjsString);
        location.reload();
      }else{
        
        var StorageAsObj=JSON.parse(localStorage.getItem('filmId-1'));
        StorageAsObj.reviews.push(reviewWithSter);
        var objAsString=JSON.stringify(StorageAsObj);
        localStorage.setItem('filmId-'+filmId,objAsString);
        location.reload();

      }
    },

    getstoredReviews(){
      var filmId=this.$route.params.id;
      if(localStorage.getItem('filmId-'+filmId)!==null ){
      var LocatStorageObj=localStorage.getItem('filmId-'+filmId);
      var LocalStorageItemAsObj=JSON.parse(LocatStorageObj);
      var reviewsArray=LocalStorageItemAsObj.reviews;

      for(let i=0; i<reviewsArray.length; i++){
        this.reviewsforshowing.push(reviewsArray[i]);
      }
      }
    },

  },



  mounted() {
    this.getFilmsData();
    this.getstoredReviews();

  }

};
</script>

<style>


.starChecked{
  color: yellow;
}


</style>