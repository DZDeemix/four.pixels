<template>
  <tr>
    <td>
      <div>{{ item.name }}</div>
    </td>
    <td>
      <div>{{ item.email }}</div>
    </td>
    <td>
      <div>{{ item.created_at }}</div>
    </td>
    <td>
      <div class="d-flex">
        <a type="button" class="btn btn-dark btn-sm" :href="`/user/form/${item.id}/`">Edit</a>
        <button type="button" class="btn btn-danger btn-sm" @click="$emit('deleteUser')">Delete</button>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: ['user'],
  name: "UserComponent",
  data() {
    return {
      item: this.user
    }
  },
}
</script>

<style scoped>

</style>