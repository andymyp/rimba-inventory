<script>
import { onMounted, ref } from "vue";

import api from "../../api";

export default {
  setup() {
    const items = ref([]);

    onMounted(() => {
      api.get("/api/items").then((res) => {
        items.value = res.data;
      });
    });

    function destroy(id, index) {
      api.delete(`/api/items/${id}`).then(() => {
        items.value.data.splice(index, 1);
      });
    }

    return { items, destroy };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Items</h4>
      <router-link tag="a" class="btn btn-primary" :to="{ name: 'items.add' }"
        >Add</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <table class="table table-hover" id="dtable">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Nama Item</th>
            <th>Unit</th>
            <th>Stok</th>
            <th>Harga Satuan</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(dt, index) in items.data" :key="index">
            <td>#{{ dt.id_item }}</td>
            <td>{{ dt.nama_item }}</td>
            <td>{{ dt.unit }}</td>
            <td>{{ dt.stok }}</td>
            <td>{{ dt.harga_satuan }}</td>
            <td align="right">
              <router-link
                tag="a"
                class="btn btn-success btn-sm"
                :to="{ name: 'items.detail', params: { id: dt.id_item } }"
                >Detail</router-link
              >
              <router-link
                tag="a"
                class="btn btn-primary btn-sm"
                :to="{ name: 'items.edit', params: { id: dt.id_item } }"
                >Edit</router-link
              >
              <button
                type="button"
                class="btn btn-danger btn-sm"
                @click="destroy(dt.id_item, index)"
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
