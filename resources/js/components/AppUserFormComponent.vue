<template>
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <div>
        <p class="font-weight-bold">
          Add/Edit User
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
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" placeholder="Enter email" v-model="email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" id="password" placeholder="Enter password" v-model="password">
        </div>
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
      email: '',
      password: '',
    }
  },
  methods: {
    saveOrUptate () {
      var data = new FormData();
      data.append('name', this.name)
      data.append('email', this.email)
      data.append('password', this.password)

      if (!!this.id) {
        data.append('_method', 'put')
        axios.post(`/user/${this.id}`, data)
            .then((response) => {
              window.location.href = "/user/list";
            })
      } else {
        axios.post(`/user`, data)
            .then((response) => {
              window.location.href = "/user/list";
            })
      }
    }
  },
  mounted () {
    if (!!this.id) {
      axios.get(`/user/${this.id}`)
        .then((response) => {
          this.name = response.data.data.name
          this.email = response.data.data.email
          this.password = response.data.data.password
        })
    }
  }
}
</script>

<style scoped>

</style>