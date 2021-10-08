<script>
import { reactive } from "vue";
import { useRouter } from "vue-router";

import api from "../../api";

export default {
  setup() {
    const customer = reactive({
      nama: "",
      contact: "",
      email: "",
      alamat: "",
      diskon: "",
      tipe_diskon: "",
      ktp: null,
    });

    const router = useRouter();

    function onFileSelected(event) {
      customer.ktp = event.target.files[0];
    }

    function store() {
      let formData = new FormData();
      formData.append("nama", customer.nama);
      formData.append("contact", customer.contact);
      formData.append("email", customer.email);
      formData.append("alamat", customer.alamat);
      formData.append("diskon", customer.diskon);
      formData.append("tipe_diskon", customer.tipe_diskon);
      formData.append("ktp", customer.ktp);

      api.post("/api/customers", formData).then(() => {
        router.push({
          name: "customers.index",
        });
      });
    }

    return { customer, router, store, onFileSelected };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Add Customer</h4>
      <router-link
        tag="a"
        class="btn btn-secondary"
        :to="{ name: 'customers.index' }"
        >Cancel</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <div class="card rounded shadow-sm">
        <form autocomplete="off" @submit.prevent="store()">
          <div class="card-body">
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control"
                  v-model="customer.nama"
                  required
                />
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Contact</label>
              <div class="col-sm-9">
                <input
                  type="number"
                  class="form-control"
                  v-model="customer.contact"
                  required
                />
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input
                  type="email"
                  class="form-control"
                  v-model="customer.email"
                  min="1"
                  required
                />
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Alamat</label>
              <div class="col-sm-9">
                <textarea
                  type="text"
                  class="form-control"
                  v-model="customer.alamat"
                  required
                ></textarea>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Diskon</label>
              <div class="col-sm-9">
                <input
                  type="number"
                  class="form-control"
                  v-model="customer.diskon"
                  min="0"
                  required
                />
              </div>
            </div>
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label">Tipe Diskon</label>
              <div class="col-sm-9">
                <select
                  class="form-select"
                  v-model="customer.tipe_diskon"
                  required
                >
                  <option value="">- Pilih Unit -</option>
                  <option value="persentase">Persentase</option>
                  <option value="fix">Fix</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">KTP</label>
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
