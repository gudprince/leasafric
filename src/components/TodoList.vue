<template>
  <div
    class="black overflow-y-auto viewport-height"  
  >
    <h2 class=" mt-4 mt-md-6 mb-6 white--text text-center">Todo Application</h2>
    <v-container class="">
      <div v-if="skeLoader">
        <skeleton-loader />
      </div>
      <v-data-table
        v-if="skeLoader == false"
        :headers="headers"
        :items="todos"
        class="elevation-1"
        :search="search"
      >
        <template v-slot:top>
          <v-toolbar
            flat
          >
            <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        >
        </v-text-field>
        <v-spacer></v-spacer>
            <v-dialog
              v-model="dialog"
              max-width="500px"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  class="mb-2"
                  v-bind="attrs"
                  v-on="on"
                >
                  Add New Todo
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="text-h5">New Todo</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col
                        cols="12"
                      
                      >
                        <v-form ref="form" >
                          <v-text-field
                            v-model="newTodo"
                            label="Title"
                            :rules="[rules.required]"
                            hint="This field is required"
                          ></v-text-field>
                        </v-form>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    class="white--text"
                    color="grey darken-3"
                    @click="close"
                    >Cancel</v-btn
                  >
                  <v-btn
                    v-show="loading == false"
                    class="white--text"
                    color="green lighten-2"
                    @click="save"
                    >Save</v-btn
                  >
                  <v-progress-circular
                    v-show="loading"
                    :width="3"
                    class="ml-4"
                    color="green"
                    indeterminate
                  >
                  </v-progress-circular>
                </v-card-actions>
              </v-card>
            </v-dialog>

              <v-dialog
              v-model="dialogUpdate"
              max-width="500px"
            >
              <v-card>
                <v-card-title>
                  <span class="text-h5">Update</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col
                        cols="12"
                      
                      >
                        <v-form ref="updateTodo" >
                          <v-text-field
                            v-model="editedItem.title"
                            label="Title"
                            :rules="[rules.required]"
                            hint="This field is required"
                          ></v-text-field>
                        </v-form>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                    <v-btn
                    class="white--text"
                    color="grey darken-3"
                    @click="closeUpdate"
                    >Cancel</v-btn
                  >
                  <v-btn
                    v-show="loading == false"
                    class="white--text"
                    color="green lighten-2"
                    @click="update"
                    >Update</v-btn
                  >
                  <v-progress-circular
                    v-show="loading"
                    :width="3"
                    class="ml-4"
                    color="green"
                    indeterminate
                  >
                  </v-progress-circular>
                </v-card-actions>
              </v-card>
            </v-dialog>

            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5"
                  >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    class="white--text"
                    color="grey darken-3"
                    @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn
                    v-show="loading == false"
                    class="white--text"
                    color="red lighten-2"
                    @click="deleteItemConfirm"
                    >OK</v-btn
                  >
                  <v-progress-circular
                    v-show="loading"
                    :width="3"
                    class="ml-4"
                    color="green"
                    indeterminate
                  >
                  </v-progress-circular>
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>

        <template v-slot:item.completed="{ item }">
        <v-simple-checkbox
          :disabled="isDisabled"
          v-model="item.completed"
          @click="updateComplete(item)"
        ></v-simple-checkbox>
        </template>

        <template v-slot:item.actions="{ item }">
          <v-btn
            class="white--text mr-2"
            color="black"
            @click="editItem(item)"
            small
          >
            <v-icon
              small
            >
              mdi-pencil
            </v-icon>
            Edit
          </v-btn>
          <v-btn
            class="white--text"
            color="red"
            @click="deleteItem(item)"
            small
          >
            <v-icon small class="mr-2">
             mdi-delete
            </v-icon>
            Delete
          </v-btn>
        </template>
      </v-data-table>
    </v-container>
  </div>
</template>

<script>
import SkeletonLoader from "./SkeletonLoader";
import Axios from "axios";

export default {
  components: { SkeletonLoader },
  data: () => ({
    skeLoader: false,
    loading: false,
    search: "",
    dialog: false,
    dialogUpdate: false,
    dialogDelete: false,
    todos: [],
    completed: true,
    isDisabled: false,
    rules: {
      required: value => !!value || 'This Field is Required.',
    },
    headers: [
      {
        text: "Task",
        align: "start",
        sortable: false,
        value: "title",
      },
      { text: "Done", value: "completed" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    editedIndex: "",
    edited: {},
    editedItem: {},
    newTodo: '',
  }),

  computed: {
    formTitle() {
      return this.editedIndex === '' ? "New Item" : "Edit Todo";
    },
  },
  methods: {
    editItem(item) {
      this.editedIndex = item.id;
      this.editedItem = item;
      this.dialogUpdate = true;
    },

    deleteItem(item) {
      this.editedIndex = item.id;

      this.editedItem = item;
      this.dialogDelete = true;
    },
    async deleteItemConfirm() {
      this.loading = true;
      const baseUrl = process.env.VUE_APP_BASEURL;
      let response = (
        await Axios.delete(`${baseUrl}/api/todos/${this.editedIndex}`)
      ).data;
      this.loading = false;
      let index = this.todos.findIndex((b) => b.id == this.editedIndex);
      this.todos.splice(index, 1);
      this.$toastr.s(response.message);
      this.closeDelete();
    },
     async save() {
      if( this.$refs.form.validate()) {
        this.loading = true;
        const baseUrl = process.env.VUE_APP_BASEURL;
        let data = {title: this.newTodo};
        let response = (
          await Axios.post(`${baseUrl}/api/todos`, data)
        ).data;
        await this.updateData();
        this.loading = false;
        this.$toastr.s(response.message);
        this.$refs.form.reset()
        this.close();
      }
    },
     async update() {
      if(this.$refs.updateTodo.validate()) {
        this.loading = true;
        const baseUrl = process.env.VUE_APP_BASEURL;
        let response = (
          await Axios.put(`${baseUrl}/api/todos/${this.editedIndex}`, this.editedItem)
        ).data;
        this.loading = false;
        await this.updateData();
        this.$toastr.s(response.message);
        this.closeUpdate();
      }
    },
    close() {
      this.dialog = false;
    },

    closeUpdate() {
      this.dialogUpdate = false;
      this.$nextTick(() => {
        this.editedItem = {}
        this.editedIndex = '';
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = {}
        this.editedIndex = '';
      });
    },
     async updateData() {
      const baseUrl = process.env.VUE_APP_BASEURL;
      let response = (await Axios.get(`${baseUrl}/api/todos`)).data;
      this.todos = response.data;
    },
    async loadData() {
      const baseUrl = process.env.VUE_APP_BASEURL;
      this.skeLoader = true;
      let response = (await Axios.get(`${baseUrl}/api/todos`)).data;
      console.log(response);
      this.todos = response.data;
      this.skeLoader = false;
    },
    switchUrl(item) {
      this.$router.push(`/todos/edit/${item.id}`);
    },
    async updateComplete(item){
     const baseUrl = process.env.VUE_APP_BASEURL;
      let completed = item.completed;
      let newCompleted = completed ? 1: 0;
      item.completed = newCompleted;
      this.isDisabled = true;
      await Axios.put(`${baseUrl}/api/todos/${item.id}`, item);
      this.isDisabled = false;
    }
  },
  created() {
    this.loadData();
  },
};
</script>
<style>
  .viewport-height{
    height: 100vh;
  }
</style>
