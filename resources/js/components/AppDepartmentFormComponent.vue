<template>
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <div>
        <p class="font-weight-bold">
          Add/Edit Department
        </p>
      </div>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="name">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" placeholder="Enter description" rows="3" v-model="description"></textarea>
        </div>
        <p>Logo</p>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="logo" ref="logo" v-on:change="handleFileUpload()">
          <label class="custom-file-label" for="logo">Logo</label>
        </div>
          <h3 class="pt-3 h">User</h3>
          <template v-for="(item, index) in users">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" :id="item.id" :value="item.id" v-model.number="checkedUsers">
              <label class="custom-control-label" :for="item.id">{{ item.name }}</label>
            </div>
          </template>
        <a class="btn btn-primary" @click="saveOrUptate()">Send</a>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: ['id'],
  name: "AddUserComponent",
  data () {
    return {
      name: '',
      description: '',
      logo: '',
      users: [],
      checkedUsers: []
    }
  },
  methods: {
    saveOrUptate () {
      var data = new FormData();
      data.append('name', this.name)
      data.append('description', this.description)
      for (var i = 0; i < this.checkedUsers.length; i++) {
        data.append(`users[${i}]`, this.checkedUsers [i]);
      }
      data.append('logo', this.logo)

      if (!!this.id) {
        data.append('_method', 'put')
        axios.post(`/department/${this.id}`, data)
          .then((response) => {
            window.location.href = "/department/list";
          })
      } else {
        axios.post(`/department`, data)
          .then((response) => {
            window.location.href = "/department/list";
          })
      }
    },
    handleFileUpload () {
      this.logo = this.$refs.logo.files[0];
    }
  },
  mounted () {
    if (!!this.id) {
      axios.get(`/department/${this.id}`)
        .then((response) => {
          this.name = response.data.data.name
          this.description = response.data.data.description
          this.logo = response.data.data.logo
          this.checkedUsers = response.data.data.users
        })
    }
    axios.get(`/user`,{
        params: {
          paginateOff: true
        }
      })
      .then((response) => {
        this.users = response.data.data
      })
  }
}
</script>

<style scoped>

</style>