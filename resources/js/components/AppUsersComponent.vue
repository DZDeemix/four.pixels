<template>
  <div>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div>
          <p class="font-weight-bold">
            Users
          </p>
        </div>
        <div>
          <a class="btn btn-info" href="/user/form">Add</a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <tbody>
          <app-user-component
              v-for="(item, index) in items.data"
              :key="item.id"
              :user="item"
              v-on:deleteUser="deleteItem(index)"
          >
          </app-user-component>
          </tbody>
        </table>
      </div>
    </div>
    <nav aria-label="navigation">
      <ul class="pagination">
        <template v-for="(item, index) in items.links">
        <li :class="item.active ? 'page-item active' : 'page-item'">
          <a v-if="item.label === 'Previous'" class="page-link" aria-label="Previous" @click="paginate(item.url)">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
          <a v-else-if="item.label === 'Next'" class="page-link" aria-label="Next" @click="paginate(item.url)">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
          <a v-else class="page-link" @click="paginate(item.url)">{{ item.label }}</a>
        </li>
        </template>
      </ul>
    </nav>
  </div>
</template>

<script>
import AppUserComponent from './AppUserComponent'
export default {
  name: "AppDepartmentsComponent",
  components: {
    AppUserComponent
  },
  data () {
    return {
      items: [],
    }
  },
  methods: {
    deleteItem (index) {
      axios.delete(`/user/${this.items.data[index].id}`)
          .then((data) => {
            console.log( this.items.data)
            this.items.data.splice(index,1)
            this.getUsers()
          })
    },
    paginate (url) {
      axios.get(url)
        .then((response) => {
          this.items = response.data.data
        })
    },
    getUsers () {
      axios.get('/user')
        .then((response) => {
          this.items = response.data.data
        })
    }
  },
  mounted () {
    this.getUsers()
  }
}
</script>

<style scoped>

</style>