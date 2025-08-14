<template>
  <navbar v-if="userData" />
  <div
    class="text-[black] overflow-hidden relative bg-[var(--bg-nav)] dash pt-10"
    v-if="userData"
  >
    <div class="containerr flex justify-between">
      <div class="w-[20%] flex flex-col gap-4">
        <p
          class="p-4 text-[var(--brown)] flex items-center gap-2 text-[20px] font-semibold rounded-[20px] cursor-pointer"
          @click="active = 'one'"
          :class="active === 'one' ? 'active' : ''"
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
          >Books
        </p>
        <p
          class="p-4 text-[var(--brown)] flex items-center gap-2 text-[20px] font-semibold rounded-[20px] cursor-pointer"
          @click="active = 'two'"
          :class="active === 'two' ? 'active' : ''"
        >
          <svg
            width="30px"
            fill="var(--brown)"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"
          >
            <!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
            <path
              d="M192 64C156.7 64 128 92.7 128 128L128 544C128 555.5 134.2 566.2 144.2 571.8C154.2 577.4 166.5 577.3 176.4 571.4L320 485.3L463.5 571.4C473.4 577.3 485.7 577.5 495.7 571.8C505.7 566.1 512 555.5 512 544L512 128C512 92.7 483.3 64 448 64L192 64z"
            />
          </svg>
          Borrow Book
        </p>
        <p
          class="p-4 text-[var(--brown)] flex items-center gap-2 text-[20px] font-semibold rounded-[20px] cursor-pointer"
          @click="active = 'three'"
          :class="active === 'three' ? 'active' : ''"
        >
          <svg
            width="30px"
            fill="var(--brown)"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"
          >
            <!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
            <path
              d="M192 64C156.7 64 128 92.7 128 128L128 544C128 555.5 134.2 566.2 144.2 571.8C154.2 577.4 166.5 577.3 176.4 571.4L320 485.3L463.5 571.4C473.4 577.3 485.7 577.5 495.7 571.8C505.7 566.1 512 555.5 512 544L512 128C512 92.7 483.3 64 448 64L192 64z"
            />
          </svg>
          Dashbord
        </p>
      </div>
      <div class="w-[80%] ml-5 p-8 bg-[var(--sc)] rounded-[20px] min-h-[83vh]">
        <div v-if="active === 'one'" class="flex flex-wrap gap-5">
          <div
            @click="showBookDetails(book)"
            class="cursor-pointer border border-[var(--yellow)] p-2 rounded-[8px] duration-[.4s] hover:scale-[1.03]"
            v-for="book in books"
            :key="book.id"
          >
            <img
              class="w-[200px]"
              :src="`http://localhost:8000/storage/${book.cover_image}`"
              alt="book cover"
            />
            <p class="font-semibold mb-2 mt-2">{{ book.title }}</p>
            <p class="opacity-[.7]">{{ book.author }}</p>
          </div>
        </div>
        <div
          v-if="selectedBook"
          class="fixed inset-0 rounded-[10px] backdrop-blur-sm bg-black/30 bg-opacity-50 flex justify-center items-center"
        >
          <div
            class="bg-white p-5 rounded w-[400px] relative flex flex-col gap-2"
          >
            <button
              @click="selectedBook = null"
              class="cursor-pointer absolute top-2 right-2 text-red-500 font-bold p-1 bg-[var(--yellow)] rounded-[50%] w-[30px] h-[30px]"
            >
              X
            </button>
            <img
              :src="`http://localhost:8000/storage/${selectedBook.cover_image}`"
              alt=""
              class="w-[200px] h-[300px] object-cover m-auto"
            />
            <h2 class="text-xl font-bold mt-3">{{ selectedBook.title }}</h2>
            <p class="text-gray-700">{{ selectedBook.description }}</p>
            <p class="text-sm text-gray-500">
              Author: {{ selectedBook.author }}
            </p>
            <p class="text-sm text-gray-500">
              Category: {{ selectedBook.category }}
            </p>
            <p class="text-sm text-gray-500">
              quantity: {{ selectedBook.quantity }}
            </p>
            <p class="text-sm text-gray-500">id: {{ selectedBook.id }}</p>
          </div>
        </div>
        <div v-if="active === 'two'" class="mt-3 flex flex-col gap-8">
          <input
            required
            v-model="selectedBookId"
            placeholder="Book ID"
            type="number"
            min="0"
          />
          <input
            required
            v-model="days"
            placeholder="Days of Borrowing"
            type="number"
            min="0"
          />
          <button
            @click="BorrowedBook"
            class="w-[100%] font-bold bg-[var(--bg-nav)] text-[var(--white)] text-center rounded-[8px] cursor-pointer pt-5 pb-5 hover:bg-[var(--bg-nav-hover)] duration-[.4s] hover:scale-[1.03]"
          >
            BORROW
          </button>
        </div>
        <div v-if="active === 'three'" class="">
          <p class="font-semibold text-[20px] text-[var(--brown)] mb-8">
            My Borrowed Books :
          </p>
          <div class="flex flex-wrap gap-5">
            <div
              class="cursor-pointer border border-[var(--yellow)] p-2 rounded-[8px] duration-[.4s] hover:scale-[1.03]"
              v-for="book in borrowedBooks"
              :key="book.id"
            >
              <img
                class="w-[200px]"
                :src="`http://localhost:8000/storage/${book.book.cover_image}`"
                alt="book cover"
              />
              <p class="font-semibold mb-2 mt-2">{{ book.book.title }}</p>
              <p class="opacity-[.7] mb-2 mt-2">
                auther : {{ book.book.author }}
              </p>
              <p class="opacity-[.7] mb-2 mt-2">book id : {{ book.book_id }}</p>
              <p class="opacity-[.7] mb-4 mt-2">
                return date : {{ book.return_date }}
              </p>
              <button
                @click="DeleteBook(book.id)"
                class="w-[100%] font-bold bg-[var(--bg-nav)] text-[var(--white)] text-center rounded-[8px] cursor-pointer pt-3 pb-3 hover:bg-[var(--bg-nav-hover)] duration-[.4s]"
              >
                Return Book Now
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="activee activeborrow">Book Borrowed successfully ✔</div>
    <div class="activee activedelete">Book Returned successfully ✔</div>
    <div class="activee activereturn">Book Returned successfully ✔</div>
  </div>
  <div grap class="grap w-[100%] flex justify-center items-center" v-else>
    <div class="loader"></div>
  </div>
</template>

<script>
import axios from "axios";
import Navbar from "../components/Navbar.vue";

export default {
  name: "UserPage",

  data() {
    return {
      token: localStorage.getItem("token"),
      id: localStorage.getItem("user"),
      userData: null,
      books: null,
      borrowedBooks: null,
      active: "one",
      popup: false,
      selectedBook: null,
      showPopup: false,
      selectedBookId: null,
      days: null,
    };
  },
  components: {
    Navbar,
  },

  mounted() {
    this.getUserData();
    this.getBooks();
    this.getBorrowedBooks();
  },

  methods: {
    showBookDetails(book) {
      this.selectedBook = book;
      this.showPopup = true;
    },

    // user data
    getUserData() {
      axios
        .get("http://127.0.0.1:8000/api/user", {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        })
        .then((res) => {
          const users = res.data.data;
          this.userData = users.find((user) => user.id === Number(this.id));

          console.log(this.userData);
        })
        .catch((err) => {
          console.error(err);
        });
    },
    // books data
    getBooks() {
      axios
        .get("http://127.0.0.1:8000/api/book", {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        })
        .then((res) => {
          this.books = res.data.data;
          console.log(this.books);
        })
        .catch((err) => {
          console.error(err);
        });
    },
    // Borrowed books data
    getBorrowedBooks() {
      axios
        .get("http://127.0.0.1:8000/api/my-borrowings", {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        })
        .then((res) => {
          this.borrowedBooks = res.data.data;
          console.log(this.borrowedBooks);
        })
        .catch((err) => {
          console.error(err);
        });
    },
    // Borrow Book
    BorrowedBook() {
      axios
        .post(
          "http://127.0.0.1:8000/api/borrowings",
          {
            book_id: this.selectedBookId,
            days: this.days,
          },
          {
            headers: {
              Authorization: `Bearer ${this.token}`,
            },
          }
        )
        .then((res) => {
          this.selectedBookId = "";
          this.days = "";
          this.getBorrowedBooks();

          const aa = document.getElementsByClassName("activeborrow")[0];
          aa.classList.add("block");
          setTimeout(() => {
            aa.classList.remove("block");
          }, 2000);
        })
        .catch((err) => {
          console.error(err);
        });
    },
    // Delete Book
    DeleteBook(id) {
      axios
        .delete(`http://127.0.0.1:8000/api/borrowings/${id}`, {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        })
        .then((res) => {
          this.getBorrowedBooks();

          const aa = document.getElementsByClassName("activedelete")[0];
          aa.classList.add("block");
          setTimeout(() => {
            aa.classList.remove("block");
          }, 2000);
        })
        .catch((err) => {
          console.error(err.response?.data || err.message);
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
input {
  width: 100%;
  padding: 10px 0;
  outline: none;
  border-bottom: 1px solid;
  font-size: 18px;
  margin-bottom: 10px;
}
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.block {
  display: block !important;
}
.activee {
  position: absolute;
  top: 0px;
  right: 50px;
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
    transform: translateX(200px);
  }
  50% {
    opacity: 1;
    transform: translateX(0px);
  }
}
</style>
