<script>
import { reactive } from "vue";
import { useRouter } from "vue-router";

import api from "../../api";

export default {
  setup() {
    const item = reactive({
      nama_item: "",
      unit: "",
      stok: "",
      harga_satuan: "",
      barang: null,
    });

    const router = useRouter();

    function onFileSelected(event) {
      item.barang = event.target.files[0];
    }

    function store() {
      let formData = new FormData();
      formData.append("nama_item", item.nama_item);
      formData.append("unit", item.unit);
      formData.append("stok", item.stok);
      formData.append("harga_satuan", item.harga_satuan);
      formData.append("barang", item.barang);

      api.post("/api/items", formData).then(() => {
        router.push({
          name: "items.index",
        });
      });
    }

    return { item, router, store, onFileSelected };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Add Item</h4>
      <router-link
        tag="a"
        class="btn btn-secondary"
        :to="{ name: 'items.index' }"
        >Cancel</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <div class="card rounded shadow-sm">
        <form autocomplete="off" @submit.prevent="store()">
          <div class="card-body">
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Nama Item</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control"
                  v-model="item.nama_item"
                  required
                />
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Unit</label>
              <div class="col-sm-9">
                <select class="form-select" v-model="item.unit" required>
                  <option value="">- Pilih Unit -</option>
                  <option value="kg">Kg</option>
                  <option value="pcs">Pcs</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Stok</label>
              <div class="col-sm-9">
                <input
                  type="number"
                  class="form-control"
                  v-model="item.stok"
                  min="1"
                  required
                />
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Harga Satuan</label>
              <div class="col-sm-9">
                <input
                  type="number"
                  class="form-control"
                  v-model="item.harga_satuan"
                  min="1"
                  required
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Gambar Barang</label>
              <div class="col-sm-9">
                <input
                  type="file"
                  class="form-control"
                  @change="onFileSelected"
                  accept="image/*"
                  required
                />
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-20">Save</button>
          </div>
        </form>
      </div>
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
.card-footer {
  text-align: center;
}
</style>
