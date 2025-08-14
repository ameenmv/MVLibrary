<template>
  <div
    class="navbar p-4 pl-10 pr-10 h-[80px] w-[100%] flex justify-between bg-[var(--bg-nav)] items-center"
  >
    <div class="logo text-[30px]">
      <svg
        class="w-[40px] h-[40px] fill-[var(--yellow)] cursor-pointer"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"
      >
        <path
          d="M96 512l320 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-66.7c18.6-6.6 32-24.4 32-45.3l0-288c0-26.5-21.5-48-48-48l-48 0 0 169.4c0 12.5-10.1 22.6-22.6 22.6-6 0-11.8-2.4-16-6.6L272 144 230.6 185.4c-4.2 4.2-10 6.6-16 6.6-12.5 0-22.6-10.1-22.6-22.6L192 0 96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96zM64 416c0-17.7 14.3-32 32-32l256 0 0 64-256 0c-17.7 0-32-14.3-32-32z"
        />
      </svg>
    </div>
    <div
      v-if="!isAdmin && !isStudent"
      class="flex gap-4 justify-center items-center"
    >
      <router-link to="/Login"
        ><p class="text-[18px] font-semibold cursor-pointer">
          Log In
        </p></router-link
      >
      <router-link to="/Register"
        ><p
          class="text-[18px] cursor-pointer text-[var(--bg-nav)] font-semibold p-3 pl-5 pr-5 rounded-[30px] bg-[var(--yellow)]"
        >
          Get Started
        </p></router-link
      >
    </div>
    <div
      v-if="isAdmin || isStudent"
      class="flex gap-4 justify-center items-center"
    >
      <p
        @click="logout"
        class="text-[18px] cursor-pointer text-[var(--bg-nav)] font-semibold p-3 pl-5 pr-5 rounded-[30px] bg-[var(--yellow)]"
      >
        Log out
      </p>

      <router-link to="/Profile"
        ><p v-if="isStudent" class="text-[18px] font-semibold cursor-pointer">
          <svg
            width="50px"
            fill="var(--yellow)"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"
          >
            <!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
            <path
              d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z"
            />
          </svg></p
      ></router-link>
      <p v-if="isAdmin" class="text-[18px] font-semibold cursor-pointer">
        <svg
          width="50px"
          fill="var(--yellow)"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 640 640"
        >
          <!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
          <path
            d="M320 312C253.7 312 200 258.3 200 192C200 125.7 253.7 72 320 72C386.3 72 440 125.7 440 192C440 258.3 386.3 312 320 312zM289.5 368L350.5 368C360.2 368 368 375.8 368 385.5C368 389.7 366.5 393.7 363.8 396.9L336.4 428.9L367.4 544L368 544L402.6 405.5C404.8 396.8 413.7 391.5 422.1 394.7C484 418.3 528 478.3 528 548.5C528 563.6 515.7 575.9 500.6 575.9L139.4 576C124.3 576 112 563.7 112 548.6C112 478.4 156 418.4 217.9 394.8C226.3 391.6 235.2 396.9 237.4 405.6L272 544.1L272.6 544.1L303.6 429L276.2 397C273.5 393.8 272 389.8 272 385.6C272 375.9 279.8 368.1 289.5 368.1z"
          />
        </svg>
      </p>
    </div>
  </div>
</template>

<script setup>
const role = localStorage.getItem("role");

const isAdmin = role == "admin";
const isStudent = role === "student";

import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/store";

const router = useRouter();
const auth = useAuthStore();

function logout() {
  auth.logout();
  router.push("/Login");
}
</script>

<style lang="scss" scoped></style>
