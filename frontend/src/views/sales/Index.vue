<script>
import { onMounted, ref } from "vue";

import api from "../../api";

export default {
  setup() {
    const sales = ref([]);

    onMounted(() => {
      api.get("/api/sales").then((res) => {
        sales.value = res.data;
      });
    });

    function destroy(id, index) {
      api.delete(`/api/sales/${id}`).then(() => {
        sales.value.data.splice(index, 1);
      });
    }

    return { sales, destroy };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Sales</h4>
      <router-link tag="a" class="btn btn-primary" :to="{ name: 'sales.add' }"
        >Add</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <table class="table table-hover" id="dtable">
        <thead>
          <tr>
            <th>#Code</th>
            <th>Tanggal</th>
            <th>Customer</th>
            <th>Total Bayar</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(dt, index) in sales.data" :key="index">
            <td>#{{ dt.code_transaksi }}</td>
            <td>{{ dt.tanggal_transaksi }}</td>
            <td>{{ dt.customer }}</td>
            <td>{{ dt.total_bayar }}</td>
            <td align="right">
              <router-link
                tag="a"
                class="btn btn-success btn-sm"
                :to="{
                  name: 'sales.detail',
                  params: { id: dt.code_transaksi },
                }"
                >Detail</router-link
              >
              <router-link
                tag="a"
                class="btn btn-primary btn-sm"
                :to="{ name: 'sales.edit', params: { id: dt.code_transaksi } }"
                >Edit</router-link
              >
              <button
                type="button"
                class="btn btn-danger btn-sm"
                @click="destroy(dt.code_transaksi, index)"
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
