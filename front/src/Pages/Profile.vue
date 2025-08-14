<template>
  <navbar v-if="userData" />
  <div class="text-[black] bg-[var(--bg-nav)] dash pt-10" v-if="userData">
    <div class="containerr flex justify-between">
      <div class="w-[20%] flex flex-col gap-4">
        <p
          class="p-4 active text-[var(--brown)] flex items-center gap-2 text-[20px] font-semibold rounded-[20px] cursor-pointer"
        >
          <svg
            width="30px"
            fill="var(--brown)"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"
          >
            <!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
            <path
              d="M480 576L192 576C139 576 96 533 96 480L96 160C96 107 139 64 192 64L496 64C522.5 64 544 85.5 544 112L544 400C544 420.9 530.6 438.7 512 445.3L512 512C529.7 512 544 526.3 544 544C544 561.7 529.7 576 512 576L480 576zM192 448C174.3 448 160 462.3 160 480C160 497.7 174.3 512 192 512L448 512L448 448L192 448zM224 216C224 229.3 234.7 240 248 240L424 240C437.3 240 448 229.3 448 216C448 202.7 437.3 192 424 192L248 192C234.7 192 224 202.7 224 216zM248 288C234.7 288 224 298.7 224 312C224 325.3 234.7 336 248 336L424 336C437.3 336 448 325.3 448 312C448 298.7 437.3 288 424 288L248 288z"
            /></svg
          >Profile
        </p>
      </div>
      <div class="w-[80%] ml-5 p-8 bg-[var(--sc)] rounded-[20px] min-h-[83vh]">
        <div
          class="w-[100%] p-6 border border-[#0000003e] rounded-[8px] flex items-center"
        >
          <img
            v-if="userData.profile_image === null"
            class="rounded-[50%] w-[200px]"
            src="../assets/profile.png"
            alt=""
          />
          <img
            v-if="userData.profile_image !== null"
            class="rounded-[50%] w-[200px]"
            :src="`http://localhost:8000/storage/${userData.profile_image}`"
            alt=""
          />
          <div class="flex flex-col !ml-10">
            <input
              @change="handleFile"
              type="file"
              accept="image/*"
              class="p-4 bg-[var(--yellow)] font-semibold cursor-pointer w-[300px] rounded-[30px]"
              placeholder="Change Avatar "
            />
            <p class="pt-3 text-[var(--bg-nav)] text-[15px] font-semibold">
              * The image should preferably have the same dimensions.
            </p>
          </div>
        </div>
        <div
          class="w-[100%] p-6 two border border-[#0000003e] rounded-[8px] flex flex-col gap-6 items-center mt-10"
        >
          <div class="flex items-center w-[100%]">
            <label
              class="mr-5 font-semibold text-[18px] text-[var(--bg-nav)] inline-block"
              for=""
              >Name:</label
            >
            <input
              v-model="changename"
              type="text"
              :placeholder="userData.name"
            />
          </div>
          <div class="flex items-center w-[100%]">
            <label
              class="mr-5 font-semibold text-[18px] text-[var(--bg-nav)] inline-block"
              for=""
              >email:</label
            >
            <input
              v-model="changeemail"
              type="email"
              :placeholder="userData.email"
            />
          </div>
          <div class="flex gap-6">
            <button
              @click="update"
              class="w-[200px] font-bold bg-[var(--bg-nav)] text-[var(--white)] text-center rounded-[8px] cursor-pointer pt-5 pb-5 hover:bg-[var(--bg-nav-hover)] duration-[.4s] hover:scale-[1.03]"
            >
              Update</button
            ><button
              @click="reset"
              class="w-[200px] font-bold border border-[var(--bg-nav)] text-[var(--bg-nav)] text-center rounded-[8px] cursor-pointer pt-5 pb-5 hover:bg-[var(--bg-nav-hover)] duration-[.4s] hover:scale-[1.03] hover:text-[var(--white)]"
            >
              Resret
            </button>
          </div>
          <div class="flex">
            <router-link to="/Dashboard"
              ><button
                class="w-[200px] font-bold bg-[var(--bg-nav)] text-[var(--white)] text-center rounded-[8px] cursor-pointer pt-5 pb-5 hover:bg-[var(--bg-nav-hover)] duration-[.4s] hover:scale-[1.03]"
              >
                Return To Dashboard
              </button></router-link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
  <div grap class="grap w-[100%] flex justify-center items-center" v-else>
    <div class="loader"></div>
  </div>
</template>

<script>
import axios from "axios";
import Navbar from "../components/Navbar.vue";

export default {
  name: "Profile",

  data() {
    return {
      token: localStorage.getItem("token"),
      id: localStorage.getItem("user"),
      userData: null,
      changeimg: "",
      changename: "",
      changeemail: "",
    };
  },
  components: {
    Navbar,
  },

  mounted() {
    this.getUserData();
  },

  methods: {
    handleFile(event) {
      const file = event.target.files[0];
      if (file) {
        this.changeimg = file;
      }
    },
    update() {
      const formData = new FormData();
      if (this.changeimg) formData.append("profile_image", this.changeimg);
      if (this.changename) formData.append("name", this.changename);
      if (this.changeemail) formData.append("email", this.changeemail);

      axios
        .post(
          `http://localhost:8000/api/user/${this.userData.id}?_method=PUT`,
          formData,
          {
            headers: {
              Authorization: `Bearer ${this.token}`,
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((res) => {
          this.changeimg = "";
          this.changename = "";
          this.changeemail = "";
          this.getUserData();
        })
        .catch((err) => {
          console.error(err.response?.data || err);
        });
    },

    // user data
    getUserData() {
      axios
        .get("http://localhost:8000/api/user", {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        })
        .then((res) => {
          const users = res.data.data;
          this.userData = users.find((user) => user.id === Number(this.id));
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.dash {
  min-height: calc(100vh - 80px);
}

.active {
  background: var(--sc);
}

.grap {
  height: calc(100vh - 80px);
  .loader {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
  }
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.two input {
  width: 100%;
  padding: 10px 0;
  outline: none;
  border-bottom: 1px solid;
  font-size: 18px;
  margin-bottom: 10px;
}
</style>
