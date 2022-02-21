<template>
    <div>
        <v-row>
            <v-col class="col-md-10 col-lg-10 grey lighten-3 px-md-4">
                <div v-if="skeLoader">
					<skeleton-loader/>
				</div>
                <div class="white mt-n2" v-if="skeLoader == false">
                    <v-card
                        :width="$vuetify.breakpoint.smAndDown ? '' : '70%'"
                        flat
                    >
                        <v-form 
                            ref="form" 
                            class="white px-2 mt-10 mb-10"
                            
                        >
                            <v-container>
                                <h4 class="mb-2">Book Information</h4>
                                <v-row class="mt-n2">
                                    <v-col
                                        cols="12"
                                         sm="6"
                                    >
                                        <v-text-field
                                            color="grey "
                                            v-model="form.name"
                                            label="Name"
                                            :rules="[rules.required]"
                                            outlined
                                            filled
                                            
                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                        sm="6"
                                    >
                                        <v-text-field
                                            color="grey"
                                            v-model="form.isbn"
                                            label="Isbn"
                                            outlined
                                            :rules="[rules.required]"
                                            filled
                
                                            
                                            
                                        >
                                        </v-text-field>
                                    </v-col>
                                     <v-col
                                        cols="12"
                                        sm="6"
                                    >
                                        <v-text-field
                                            color="grey"
                                            v-model="form.number_of_pages"
                                            label="number of Pages"
                                            outlined
                                            :rules="[rules.required]"
                                            filled
                                            type="number"
                                            
                                            
                                        >
                                        </v-text-field>
                                    </v-col>
                                     <v-col
                                        cols="12"
                                        sm="6"
                                    >
                                        <v-text-field
                                            color="grey"
                                            v-model="form.country"
                                            label="Country"
                                            outlined
                                            :rules="[rules.required]"
                                            filled 

                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                        sm="6"
                                    >
                                        <v-text-field
                                            color="grey"
                                            v-model="form.release_date"
                                            label="Release Date"
                                            outlined
                                            :rules="[rules.required]"
                                            filled 

                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                        sm="6"
                                    >
                                        <v-text-field
                                            color="grey"
                                            v-model="form.publisher"
                                            label="Publisher"
                                            :rules="[rules.required]"
                                            outlined
                                            filled
                                            
                                        >
                                        </v-text-field> 
                                    </v-col>
                                </v-row>
                                <v-row v-for="(item, i) in form.authors" v-bind:key="i">
                                    <v-col
                                        cols="12"
                                        sm="8"
                                    >
                                        <v-text-field
                                            color="grey"
                                            v-model="form.authors[i]"
                                            label="Author"
                                            outlined
                                            :rules="[rules.required]"
                                            filled 

                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                        sm="4"
                                        class="mt-sm-3"
                                    >
                                        <v-btn @click="remove(i)" class="red">Remove Author</v-btn>
                                    </v-col>
                                </v-row>
                                <v-btn @click="addMore" class="green">Add More Author</v-btn>
                            
                                    <div class="float-right">
                                        <v-btn
                                            v-show="loading == false"
                                            @click="update" 
                                            class="mb-4 lime darken-4 ma-2 white--text"
                                        >
                                            Update
                                        </v-btn>
                                        <v-progress-circular
                                            v-show="loading"
                                            :width="3"
                                            class="mb-4"
                                            color="green"
                                            indeterminate
                                        >
                                        </v-progress-circular>
                                    </div>
                            </v-container>
                        </v-form>
                    </v-card>
                </div> 
            </v-col>
        </v-row>
    </div>
</template>

<script>
import SkeletonLoader from './SkeletonLoader';
 import Axios from 'axios';
    export default { 
        components: {SkeletonLoader}, 
        data(){
            return {
                form: {},
                skeLoader: false,
                loading: false,
                UserId: '',
                rules: {
                    required: value => !!value || 'Required.',
                    min: v => v.length >= 8 || 'Min 8 characters',
                },
            }
        },
        methods: {
        async getData(){
            this.skeLoader = true
            let id = this.$route.params.id;
            let response = (await Axios.get(`http://localhost/max/public/api/v1/books/${id}`)).data;
            console.log(response)
            this.form = response.data;
            this.skeLoader = false
        },
        addMore(){
            this.form.authors.push('');
        },
        remove(index){
            this.form.authors.splice(index,1);
        },
        async update(){
            this.loading = true;
            let response = (await Axios.put(`http://localhost/max/public/api/v1/books/${this.form.id}`, this.form)).data;
             console.log(response);
             this.$toastr.s(response.message);
             this.loading = false;
        }
           
        },
        created(){
            this.getData()
        }
    }
</script>