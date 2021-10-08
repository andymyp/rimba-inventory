const routes = [
  // HOME
  {
    path: "/",
    name: "home.index",
    component: () => import("../views/home/Index.vue"),
  },

  // ITEMS
  {
    path: "/items",
    name: "items.index",
    component: () => import("../views/items/Index.vue"),
  },
  {
    path: "/items/add",
    name: "items.add",
    component: () => import("../views/items/Add.vue"),
  },
  {
    path: "/items/:id",
    name: "items.detail",
    component: () => import("../views/items/Detail.vue"),
  },
  {
    path: "/items/edit/:id",
    name: "items.edit",
    component: () => import("../views/items/Edit.vue"),
  },

  // CUSTOMERS
  {
    path: "/customers",
    name: "customers.index",
    component: () => import("../views/customers/Index.vue"),
  },
  {
    path: "/customers/add",
    name: "customers.add",
    component: () => import("../views/customers/Add.vue"),
  },
  {
    path: "/customers/:id",
    name: "customers.detail",
    component: () => import("../views/customers/Detail.vue"),
  },
  {
    path: "/customers/edit/:id",
    name: "customers.edit",
    component: () => import("../views/customers/Edit.vue"),
  },

  // SALES
  {
    path: "/sales",
    name: "sales.index",
    component: () => import("../views/sales/Index.vue"),
  },
  {
    path: "/sales/add",
    name: "sales.add",
    component: () => import("../views/sales/Add.vue"),
  },
  {
    path: "/sales/:id",
    name: "sales.detail",
    component: () => import("../views/sales/Detail.vue"),
  },
  {
    path: "/sales/edit/:id",
    name: "sales.edit",
    component: () => import("../views/sales/Edit.vue"),
  },
];

export default routes;
