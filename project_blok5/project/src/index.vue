<template>
<div id="app">
  
  
    <div class="Items">
<div style="margin-left: 80px; justify-content: space-around; display:flex" class="-7">
  <b-card
    title="Card Title"
    img-src="https://i.pinimg.com/originals/79/ef/f5/79eff514546439f66812567e281d541b.jpg"
    img-alt="Image"
    img-top
    tag="article"
    style="max-width: 300px;"
    class="mb-2"
  >
    <b-card-text>
      Some quick example text to build on the card title and make up the bulk of the card's content.
    </b-card-text>
    <b-button href="#" variant="primary">Go somewhere</b-button>
  </b-card>

    <b-card
    title="Card Title"
    img-src="https://cdn.flickeringmyth.com/wp-content/uploads/2019/04/THE_QUAKE_AMAZON-600x800.jpg"
    img-alt="Image"
    img-top
    tag="article"
    style="max-width: 300px;"
    class="mb-2"
  >
    <b-card-text>
      Some quick example text to build on the card title and make up the bulk of the card's content.
    </b-card-text>

    <b-button href="#" variant="primary">Go somewhere</b-button>
  </b-card>
</div>
</div>
<div class="div4">
</div>

</div> 
</template>


<script>
export default{
  methods:{
    InputSubmit(){
      this.$emit('showInput',this.inputField)
      this.$emit('ShowCategorie',this.selected)
    }
  },
  props:{

  },
}

</script>







