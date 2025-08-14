// stores/auth.js
import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: JSON.parse(localStorage.getItem("user")) || null,
    role: localStorage.getItem("role") || null,
    token: localStorage.getItem("token") || null,
  }),

  actions: {
    setUser(userData, role, token) {
      this.user = userData;
      this.role = role;
      this.token = token;

      localStorage.setItem("user", JSON.stringify(userData));
      localStorage.setItem("role", role);
      localStorage.setItem("token", token);
    },

    logout() {
      this.user = null;
      this.role = null;
      this.token = null;

      localStorage.removeItem("user");
      localStorage.removeItem("role");
      localStorage.removeItem("token");
    },
  },
});
