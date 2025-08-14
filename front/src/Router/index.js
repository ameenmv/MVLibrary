import { createRouter, createWebHistory } from "vue-router";
import Home from "../Pages/Home.vue";
import Register from "../Pages/Register.vue";
import Login from "../Pages/Login.vue";
import Admin from "../Pages/Admin.vue";
import Dashboard from "../Pages/Dashboard.vue";
import Profile from "../Pages/Profile.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/Register",
    name: "Register",
    component: Register,
  },
  {
    path: "/Login",
    name: "Login",
    component: Login,
  },
  {
    path: "/admin",
    name: "Admin",
    component: Admin,
    meta: { requiresAdmin: true },
  },
  {
    path: "/Dashboard",
    name: "Dashboard",
    component: Dashboard,
  },
  {
    path: "/Profile",
    name: "Profile",
    component: Profile,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Navigation Guard => just new for me
// if the role != admin push to login again
import { useAuthStore } from "../stores/store";

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();

  if (to.meta.requiresAdmin && authStore.role !== "admin") {
    next("/Login");
  } else {
    next();
  }
});

export default router;
