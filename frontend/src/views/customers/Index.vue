<script>
import { onMounted, ref } from "vue";

import api from "../../api";

export default {
  setup() {
    const customers = ref([]);

    onMounted(() => {
      api.get("/api/customers").then((res) => {
        customers.value = res.data;
      });
    });

    function destroy(id, index) {
      api.delete(`/api/customers/${id}`).then(() => {
        customers.value.data.splice(index, 1);
      });
    }

    return { customers, destroy };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Customers</h4>
      <router-link
        tag="a"
        class="btn btn-primary"
        :to="{ name: 'customers.add' }"
        >Add</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <table class="table table-hover" id="dtable">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Nama</th>
            <th>Contact</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(dt, index) in customers.data" :key="index">
            <td>#{{ dt.id_customer }}</td>
            <td>{{ dt.nama }}</td>
            <td>{{ dt.contact }}</td>
            <td>{{ dt.email }}</td>
            <td align="right">
              <router-link
                tag="a"
                class="btn btn-success btn-sm"
                :to="{
                  name: 'customers.detail',
                  params: { id: dt.id_customer },
                }"
                >Detail</router-link
              >
              <router-link
                tag="a"
                class="btn btn-primary btn-sm"
                :to="{ name: 'customers.edit', params: { id: dt.id_customer } }"
                >Edit</router-link
              >
              <button
                type="button"
                class="btn btn-danger btn-sm"
                @click="destroy(dt.id_customer, index)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style>
.content-header {
  display: flex;
  flex-wrap: inherit;
  align-items: center;
  justify-content: space-between;
}
.content-header h4 {
  margin: 0;
}
.table > tbody > tr {
  vertical-align: middle;
}
.table > tbody > tr > td > .btn:not(:last-child) {
  margin-right: 6px;
}
</style>
