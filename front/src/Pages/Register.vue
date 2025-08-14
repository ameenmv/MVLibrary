<template>
  <Navbar />
  <div
    class="flex relative register !text-[var(--black)] w-[100vw] justify-center items-center bg-[var(--bg)]"
  >
    <form @submit="onSubmit" class="flex w-[100%] justify-between p-5">
      <div class="w-[48%] flex flex-col justify-center pl-10 pr-10">
        <p class="text-[30px] font-bold mb-15">
          Let's Create <span class="text-[var(--bg-nav)]">Account</span>
        </p>
        <div class="flex flex-col gap-15 w-[100%]">
          <div>
            <input
              v-model="Name"
              @input="setTouched('Name')"
              type="name"
              name="Name"
              placeholder="Name"
              id=""
            />
            <div
              v-for="error of v$.Name.$errors"
              class="font-semibold text-[14px] text-[#91000092]"
              :key="error.$uid"
            >
              {{ error.$message }}
            </div>
          </div>
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
            <p
              v-if="emailExistsError"
              class="font-semibold text-[14px] text-[#91000092]"
            >
              {{ emailExistsError }}
            </p>
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
          </div>
          <div class="">
            <input
              v-model="confirm"
              type="Password"
              name="Password"
              placeholder="Confirm Password"
              id=""
            />
            <div
              v-for="error of v$.confirm.$errors"
              class="font-semibold text-[14px] text-[#91000092]"
              :key="error.$uid"
            >
              {{ error.$message }}
            </div>
          </div>

          <button
            type="submit"
            class="w-[100%] bg-[var(--bg-nav)] text-[var(--white)] text-center rounded-[8px] cursor-pointer pt-5 pb-5 hover:bg-[var(--bg-nav-hover)] duration-[.4s] hover:scale-[1.03]"
          >
            Register
          </button>
        </div>
        <router-link to="/Login"
          ><p
            class="mt-9 w-[100%] flex justify-center font-semibold cursor-pointer"
          >
            already have account ? Click Here to Sign in
          </p></router-link
        >
      </div>
      <div class="w-[48%] flex justify-center items-center">
        <video src="../assets/landing.mp4" muted loop autoplay></video>
      </div>
    </form>
    <div class="active">Registered successfully ✔</div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import axios from "axios";

// vuelidate
import { useVuelidate } from "@vuelidate/core";
import {
  required,
  minLength,
  maxLength,
  email,
  sameAs,
  helpers,
} from "@vuelidate/validators";

export default {
  name: "Register",
  data() {
    return {
      v$: useVuelidate(),
      Name: "",
      email: "",
      password: "",
      confirm: "",
      emailExistsError: "",
      users: [],
    };
  },

  methods: {
    setTouched(theModel) {
      if (theModel == "Name" || theModel == "all") {
        this.v$.Name.$touch();
      }
      if (theModel == "email" || theModel == "all") {
        this.v$.email.$touch();
      }
      if (theModel == "password" || theModel == "all") {
        this.v$.password.$touch();
      }
      if (theModel == "confirm" || theModel == "all") {
        this.v$.confirm.$touch();
      }
    },

    // هيتشيك لو الايميل موجود قبل كدا
    // async checkEmailExists(email) {
    //   try {
    //     const res = await axios.get("http://127.0.0.1:8000/api/user");

    //     // نشوف لو فيه يوزر عنده نفس الإيميل
    //     const user = res.data.find(
    //       (u) => u.email.toLowerCase() === email.toLowerCase()
    //     );

    //     if (user) {
    //       console.log("Email already exists!");
    //       return true;
    //     } else {
    //       console.log("Email is available.");
    //       return false;
    //     }
    //   } catch (error) {
    //     console.error("Error checking email:", error);
    //     return false;
    //   }
    // },

    // submit => validation && Register
    async onSubmit(event) {
      event.preventDefault();
      this.setTouched("all");

      const isValid = await this.v$.$validate();
      if (!isValid) {
        console.log("Form is invalid");
        return;
      }
      // const exists = await this.checkEmailExists(this.email);
      // if (exists) {
      //   if (exists) {
      //     this.emailExistsError = "This email is already registered!";
      //     return;
      //   }

      //   // لو مش موجود كمل تسجيل
      //   this.emailExistsError = "";
      //   console.log("Registering user...");
      // }

      const formData = {
        name: this.Name,
        email: this.email,
        password: this.password,
        student_id: Math.random().toString(),
        role: "student",
      };

      try {
        const res = await axios.post(
          "http://127.0.0.1:8000/api/user",
          formData,
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        );

        // اصفر الفيلدس
        this.Name = "";
        this.email = "";
        this.password = "";
        this.confirm = "";
        this.emailExistsError = "";
        this.v$.$reset();

        const aa = document.getElementsByClassName("active")[0];
        aa.classList.add("block");

        setTimeout(() => {
          this.$router.push("/Login");
          aa.classList.remove("block");
        }, 2000);
        console.log("User registered successfully:", res.data);
      } catch (error) {
        if (error.response) {
          console.error("Error response:", error.response.data);
        } else {
          console.error("Error message:", error.message);
        }
      }
    },
  },
  validations() {
    return {
      Name: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(25),
      },
      email: { required, email },
      password: { required, minLength: minLength(5), maxLength: maxLength(25) },
      confirm: {
        required,
        sameAsPassword: helpers.withMessage(
          "Password and Confirm Password must match",
          sameAs(this.password)
        ),
      },
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
.block {
  display: block !important;
}
.active {
  position: absolute;
  top: 20px;
  left: 50px;
  padding: 15px 25px;
  background: var(--yellow);
  color: var(--bg-nav);
  font-weight: 600;
  border-radius: 12px;
  animation-name: ani;
  animation-duration: 3s;
  display: none;
}
@keyframes ani {
  0%,
  100% {
    opacity: 0.2;
    transform: translateX(-200px);
  }
  50% {
    opacity: 1;
    transform: translateX(0px);
  }
}
</style>
