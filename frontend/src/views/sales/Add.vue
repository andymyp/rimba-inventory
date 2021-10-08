<script>
import { reactive, ref, onMounted } from "vue";
import { useRouter } from "vue-router";

import api from "../../api";

export default {
  setup() {
    const sales = reactive({
      tanggal_transaksi: "",
      id_customer: "",
      total_diskon: "",
      total_harga: "",
      total_bayar: "",
      code_transaksi: "",
      id_item: [],
    });

    const customer = reactive({
      diskon: "",
      tipe_diskon: "",
    });

    const item = reactive({
      id_item: "",
      nama_item: "",
      unit: "",
      stok: "",
      qty: "",
      harga_satuan: "",
    });

    const customers = ref([]);
    const items = ref([]);
    const selectedItem = ref([]);

    const router = useRouter();

    onMounted(() => {
      api.get("/api/customers").then((res) => {
        customers.value = res.data;
      });

      api.get("/api/items").then((res) => {
        items.value = res.data;
        console.log(res.data);
      });
    });

    function customerChange(event) {
      api.get(`/api/customers/${event.target.value}`).then((res) => {
        customer.diskon = res.data.data.diskon;
        customer.tipe_diskon = res.data.data.tipe_diskon;
      });
    }

    function itemChange(event) {
      api.get(`/api/items/${event.target.value}`).then((res) => {
        item.id_item = res.data.data.id_item;
        item.nama_item = res.data.data.nama_item;
        item.unit = res.data.data.unit;
        item.stok = res.data.data.stok;
        item.harga_satuan = res.data.data.harga_satuan;
      });
    }

    function addItem() {
      let total_harga = parseInt(item.harga_satuan) * parseInt(item.qty);
      let harga_diskon =
        customer.tipe_diskon == "fix"
          ? parseInt(customer.diskon)
          : (parseInt(customer.diskon) / 100) * total_harga;
      let total = total_harga - harga_diskon;

      let data = {
        id_item: item.id_item,
        nama_item: item.nama_item,
        harga_satuan: item.harga_satuan,
        qty: item.qty,
        total_harga: total_harga,
        harga_diskon: harga_diskon,
        total: total,
      };

      selectedItem.value.push(data);
      console.log(selectedItem);
    }

    function delItem(index) {
      selectedItem.value.splice(index, 1);
    }

    function store() {
      api.post("/api/sales", sales).then(() => {
        router.push({
          name: "sales.index",
        });
      });
    }

    return {
      sales,
      item,
      items,
      customer,
      customers,
      selectedItem,
      router,
      customerChange,
      itemChange,
      addItem,
      delItem,
      store,
    };
  },
};
</script>

<template>
  <div class="row">
    <div class="col-md-12 content-header">
      <h4>Add Sales</h4>
      <router-link
        tag="a"
        class="btn btn-secondary"
        :to="{ name: 'sales.index' }"
        >Cancel</router-link
      >
    </div>
    <div class="col-md-12 mt-3 content-body">
      <div class="card rounded shadow-sm">
        <form autocomplete="off" @submit.prevent="store()">
          <div class="card-body">
            <div class="row">
              <div class="form-group mb-3 col-sm-3">
                <label class="col-form-label">Tanggal</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="sales.tanggal_transaksi"
                  required
                />
              </div>
              <div class="form-group mb-3 col-sm-6">
                <label class="col-form-label">Customer</label>
                <select
                  class="form-select"
                  v-model="sales.id_customer"
                  @change="customerChange"
                  required
                >
                  <option value="">- Pilih Customer -</option>
                  <option
                    v-for="(dt, index) in customers.data"
                    :key="index"
                    :value="dt.id_customer"
                  >
                    {{ dt.nama }}
                  </option>
                </select>
              </div>
              <div class="form-group mb-3 col-sm-3">
                <label class="col-form-label">Diskon</label>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    v-model="customer.diskon"
                    readonly
                  />
                  <span class="input-group-text" id="basic-addon1">{{
                    customer.tipe_diskon == "fix" ? "Rp" : "%"
                  }}</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-sm-3">
                <label class="col-form-label">Item</label>
                <select
                  class="form-select"
                  v-model="item.id_item"
                  @change="itemChange"
                >
                  <option value="">- Pilih Item -</option>
                  <option
                    v-for="(dt, index) in items.data"
                    :key="index"
                    :value="dt.id_item"
                  >
                    {{ dt.nama_item }}
                  </option>
                </select>
              </div>
              <div class="form-group mb-3 col-sm-3">
                <label class="col-form-label">Harga Satuan</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="item.harga_satuan"
                  readonly
                />
              </div>
              <div class="form-group mb-3 col-sm-3">
                <label class="col-form-label">Qty</label>
                <div class="input-group">
                  <input
                    type="number"
                    class="form-control"
                    v-model="item.qty"
                    min="1"
                    :max="item.stok"
                  />
                  <span class="input-group-text" id="basic-addon1">{{
                    item.unit
                  }}</span>
                </div>
              </div>
              <div class="form-group mb-3 col-sm-3">
                <label class="col-form-label">.</label>
                <div class="d-grid gap-2">
                  <button
                    type="button"
                    class="btn btn-primary mr-20"
                    @click="addItem"
                  >
                    Add
                  </button>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="con-md-12">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID Item</th>
                      <th>Nama Item</th>
                      <th>Harga Satuan</th>
                      <th>Qty</th>
                      <th>Total Harga</th>
                      <th>Harga Diskon</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(dt, index) in selectedItem" :key="index">
                      <td>{{ dt.id_item }}</td>
                      <td>{{ dt.nama_item }}</td>
                      <td>{{ dt.harga_satuan }}</td>
                      <td>{{ dt.qty }}</td>
                      <td>{{ dt.total_harga }}</td>
                      <td>{{ dt.harga_diskon }}</td>
                      <td>{{ dt.total }}</td>
                      <td align="right">
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          @click="delItem(index)"
                        >
                          X
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td></td>
                      <td></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
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
.table > tbody > tr {
  vertical-align: middle;
}
</style>
