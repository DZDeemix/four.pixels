<template>
  <tr>
    <td width="30%">
      <div style="">
        <img :src="`/${item.logo}`" class="rounded mx-auto d-block img-fluid"  alt="...">
      </div>
    </td>
    <td>
      <p class="font-weight-bold">{{ item.name }}</p>
      <div>{{ item.description }}</div>
    </td>
    <td>{{ item.user_id }}</td>
    <td>
      <div class="d-flex">
        <a type="button" class="btn btn-dark btn-sm" :href="`/department/form/${item.id}/`">Edit</a>
        <button type="button" class="btn btn-danger btn-sm" @click="$emit('deleteDepartment')">Delete</button>
      </div>
    </td>

  </tr>
</template>

<script>
export default {
  props: ['department'],
  name: "DepartmentComponent",
  data() {
    return {
      item: this.department
    }
  },
  }
</script>

<style scoped>

</style>