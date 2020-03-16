<template>

<div class="row">





    <div >
      <form v-on:submit.prevent="suba()" enctype="multipart/form-data">
        <input type="file" name="video" v-on:change="onImageChange" class="form-control">
        <button class="btn btn-success">Submit</button>
 </form>
  <div class="progress" v-if="progressBar > 0" >
                    
                         <progress class="progress is-primary" :value="progressBar" :max="100" show-progress >{{progressBar}}</progress>

                         <h1 v-if="progressBar == 100">UPLOADED</h1>
                </div>

    </div>



      



</div>


</template>

<script>

    export default {

      data(){
    return {
              name: '',
              image: '',
              success: '',
progressBar:0,
bars:[]

    }
  },

     methods: {
            onImageChange(e) {
         console.log(e.target.files[0]);
        this.image = e.target.files[0]; 

             
            },
           
 suba(){
                   const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

 

                let formData = new FormData();

                formData.append('image', this.image);


     axios.post('/api/cov', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                 
                    onUploadProgress: function( progressEvent ) {
                      
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total))
                    }.bind(this)
                })


}

     }
    }
</script>