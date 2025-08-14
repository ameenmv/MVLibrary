<template>
  <Navbar />
  <div
    class="flex register !text-[var(--black)] w-[100vw] justify-center items-center bg-[var(--bg)]"
  >
    <form @submit="onSubmit" class="flex w-[100%] justify-between p-5">
      <div class="w-[48%] flex flex-col justify-center pl-10 pr-10">
        <p class="text-[30px] font-bold mb-15">
          Welcome <span class="text-[var(--bg-nav)]">Back :)</span>
        </p>
        <div class="flex flex-col gap-15 w-[100%]">
          <div>
            <input
              v-model="email"
              @input="setTouched('email')"
              type="email"
              name="email"
              placeholder="Email"
              id=""
            />
            <div
              v-for="error of v$.email.$errors"
              class="font-semibold text-[14px] text-[#91000092]"
              :key="error.$uid"
            >
              {{ error.$message }}
            </div>
          </div>
          <div>
            <input
              v-model="password"
              @input="setTouched('password')"
              type="password"
              name="password"
              placeholder="Password"
              id=""
            />
            <div
              v-for="error of v$.password.$errors"
              class="font-semibold text-[14px] text-[#91000092]"
              :key="error.$uid"
            >
              {{ error.$message }}
            </div>
            <p
              v-if="emailExistsError"
              class="font-semibold text-[14px] text-[#91000092] mt-6"
            >
              {{ emailExistsError }}
            </p>
          </div>

          <button
            type="submit"
            class="w-[100%] bg-[var(--bg-nav)] text-[var(--white)] text-center rounded-[8px] cursor-pointer pt-5 pb-5 hover:bg-[var(--bg-nav-hover)] duration-[.4s] hover:scale-[1.03]"
          >
            Login
          </button>
        </div>
        <router-link to="/Register"
          ><p
            class="mt-9 w-[100%] flex justify-center font-semibold cursor-pointer"
          >
            didn't have account ? Click Here to Register
          </p></router-link
        >
      </div>
      <div class="w-[48%] flex justify-center items-center">
        <video src="../assets/login.mp4" muted loop autoplay></video>
      </div>
    </form>
  </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import axios from "axios";

import { useAuthStore } from "../stores/store";

// vuelidate
import { useVuelidate } from "@vuelidate/core";
import { required, minLength, maxLength, email } from "@vuelidate/validators";

export default {
  name: "Register",
  data() {
    return {
      v$: useVuelidate(),
      email: "",
      password: "",
      emailExistsError: "",
    };
  },
  methods: {
    setTouched(theModel) {
      if (theModel == "email" || theModel == "all") {
        this.v$.email.$touch();
      }
      if (theModel == "password" || theModel == "all") {
        this.v$.password.$touch();
      }
    },

    // check match user or password
    async checkCredentials(email, password) {
      try {
        const res = await axios.post("http://127.0.0.1:8000/api/login", {
          email,
          password,
        });

        if (res.data.status) {
          return res.data; // بيرجع التوكن واليوزر
        } else {
          this.emailExistsError = "Invalid email or password.";
          return null;
        }
      } catch (error) {
        console.error("Error checking credentials:", error);
        return null;
      }
    },

    // submit
    async onSubmit(event) {
      event.preventDefault();
      this.setTouched("all");

      if (this.v$.$invalid) return;

      const loginData = await this.checkCredentials(this.email, this.password);

      if (!loginData) {
        this.loginError = "Invalid email or password!";
        return;
      }

      const authStore = useAuthStore();
      authStore.setUser(
        loginData.user.id,
        loginData.user.role,
        loginData.token
      );

      // تحويل بناءً على الإيميل/الباسورد أو الـ role
      if (
        loginData.user.role === "admin" ||
        (this.email === "admin@admin.com" && this.password === "admin")
      ) {
        this.$router.push("/admin");
      } else {
        this.$router.push("/Dashboard");
      }
    },
  },
  validations() {
    return {
      email: { required, email },
      password: { required, minLength: minLength(5), maxLength: maxLength(25) },
    };
  },
  components: {
    Navbar,
  },
};
</script>

<style lang="scss" scoped>
.register {
  height: calc(100vh - 80px);
}
input {
  width: 100%;
  padding: 10px 0;
  outline: none;
  border-bottom: 1px solid;
  font-size: 18px;
  margin-bottom: 10px;
}
</style>
