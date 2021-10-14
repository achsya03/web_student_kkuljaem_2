<template>
  <div>
    <transition name="slide-fade" mode="out-in">
      <div :key="quiz[currentQuestion].pertanyaan_teks">
        <div class="container">
          <h4 class="clr-main font-weight-bold mt-5">{{ quiz[currentQuestion].judul_quiz }} - Soal {{ currentQuestion + 1 }}/{{ quiz.length }}</h4>
        </div>
        <!-- End Title -->
        <!-- ProgressBar -->
        <div class="container">
          <div class="progress mt-2">
            <div
              class="progress-bar bar-main"
              role="progressbar"
              v-bind:style="{
                width: ((currentQuestion + 1) / quiz.length) * 100 + '%',
              }"
              aria-valuenow="75"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
        </div>
        <!-- End ProgressBar -->
        <!-- Question Image -->
        <div v-if="quiz[currentQuestion].url_gambar" class="container">
          <img :src="quiz[currentQuestion].url_gambar" class="img-fluid mt-5 mb-5" height="640px" alt="Responsive image" />
        </div>
        <!-- End Question Image -->
        <!-- Question -->
        <div class="container">
          <p class="question-p clr-secondary mt-4">
            {{ quiz[currentQuestion].pertanyaan_teks }}
          </p>
        </div>
        <!-- End Question -->
        <!-- Play And Volume -->
        <div v-if="quiz[currentQuestion].url_file" class="container">
          <audio controls class="mb-4">
            <source :src="quiz[currentQuestion].url_file" type="audio/mpeg" />
          </audio>
        </div>
        <!-- End Play And Volume -->
        <div class="container">
          <div class="d-flex flex-wrap justify-content-center align-items-center">
            <div v-for="(answer, index) in quiz[currentQuestion].option" :key="index" v-bind:data-index="index" class="mx-auto">
              <div v-if="answer.jawaban_teks" class="card card-answer my-4">
                <div class="card-body d-flex align-content-center">
                  <p class="">
                    <b class="mr-1">{{ answer.jawaban_id }}. </b>{{ answer.jawaban_teks }}
                  </p>
                  <a v-on:click="(e) => !isAnswered && checkAnswer(index)" class="stretched-link"></a>
                </div>
              </div>
              <div v-if="answer.url_file" class="d-flex flex-column justify-content-center mb-4">
                <div class="ml-3">
                  <audio controls>
                    <source :src="answer.url_file" type="audio/mp3" />
                  </audio>
                </div>
                <div class="card card-answer">
                  <div class="card-body d-flex flex-row">
                    <div>
                      <p class="d-flex align-items-center">
                        <b>{{ answer.jawaban_id }}. </b>
                      </p>
                    </div>
                    <a v-on:click="(e) => !isAnswered && checkAnswer(index)" class="stretched-link"></a>
                  </div>
                </div>
              </div>
              <div v-if="answer.url_gambar" class="card card-answer-img mb-4">
                <div class="card-body d-flex">
                  <p class="d-flex">
                    <b>{{ answer.jawaban_id }}. </b><img :src="answer.url_gambar" alt="JawabanGambar" class="img-answer ml-2" />
                  </p>
                  <a v-on:click="(e) => !isAnswered && checkAnswer(index)" class="stretched-link"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
    <!-- Notif True -->
    <div v-if="notifTrue" class="container mb-5">
      <div class="bg-true">
        <div class="notif d-flex justify-content-between">
          <h2 class="text-true d-flex align-items-center font-weight-bold">Benar, Kamu Hebat!</h2>
          <button v-on:click="nextQuestion" type="button" class="btn btn-next d-flex align-items-center">{{ buttonText }}</button>
        </div>
      </div>
    </div>
    <!-- End Notif True -->
    <!-- Notif False -->
    <div v-if="notifFalse" class="container mb-5">
      <div class="bg-false">
        <div class="notif d-flex justify-content-between">
          <h2 class="text-true d-flex align-items-center font-weight-bold">Ups... Kurang tepat</h2>
          <button v-on:click="nextQuestion" type="button" class="btn btn-next d-flex align-items-center">{{ buttonText }}</button>
        </div>
      </div>
    </div>
    <!-- End Notif False -->
    <!-- Modal -->
    <div class="modal fade" id="modalhasil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <img src=" /assets/img/badge.png " class="mt-3 mb-4" alt="LogoBadge " />
          <h2 class="mx-auto font-weight-bold mb-4">{{ finalScore }}/100</h2>
          <a :href="'/class/latihan-intro/'+uuid"><button type="button" class="btn btn-try-again mb-2">Coba Lagi</button></a>
          <a :href="'/class/video/'+uuid"><button type="button" class="btn btn-try-again mb-2 btn-back">Kembali</button></a>
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
</template>
<script>
var score = 0;
export default {
  props: ["quiz", "uuid"],
  data() {
    return {
      buttonText: "Berikutnya",
      currentQuestion: 0,
      correctAnswer: score,
      finalScore: 0,
      isAnswered: false,
      notifTrue: false,
      notifFalse: false,
      answer: [],
      submitScore: {},
      getResponse: null,
    };
  },
  methods: {
    checkAnswer: function (index) {
      var cardOptions = document.querySelectorAll(".card-answer"),
        options = document.querySelectorAll(".stretched-link");
      cardOptions.forEach((element) => {
        element.setAttribute("disabled", "");
      });
      options.forEach((e) => {
        e.classList.add("disabled");
      });
      this.isAnswered = true;
      if (this.quiz[this.currentQuestion].jawaban == this.quiz[this.currentQuestion].option[index].jawaban_id) {
        this.notifTrue = true;
        this.answer.push(this.quiz[this.currentQuestion].option[index].jawaban_id.toString());
        this.correctAnswer++;
      } else {
        this.answer.push(this.quiz[this.currentQuestion].option[index].jawaban_id.toString());
        this.notifFalse = true;
      }
      this.finalScore = Number((this.correctAnswer / this.quiz.length) * 100).toFixed(0);
    },
    nextQuestion: function () {
      var cardOptions = document.querySelectorAll(".card-answer"),
        options = document.querySelectorAll(".stretched-link");
      if (this.currentQuestion + 1 < this.quiz.length) {
        this.notifTrue = false;
        this.notifFalse = false;
        this.isAnswered = false;
        cardOptions.forEach((element) => {
          element.removeAttribute("disabled");
        });
        options.forEach((e) => {
          e.classList.remove("disabled");
        });
        this.currentQuestion++;
        if (this.currentQuestion + 1 == this.quiz.length) {
          this.buttonText = "Tampilkan Hasil";
        }
      } else {
        $("#modalhasil").modal({
          backdrop: "static",
          keyboard: false,
        });
        $("#modalhasil").modal("show");
      }
    },
  },
  mounted() {
  },
};
</script>
<style scoped>
.slide-fade-enter-active {
  transition: all .3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.slide-fade-leave-active {
  transition: all .3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.slide-fade-enter {
  transform: translateX(40%);
  opacity: 0;
}
.card-answer:disabled .card-body {
  opacity: 0.4;
}
a.stretched-link {
  cursor: pointer;
}
a.disabled {
  cursor: not-allowed;
}
.btn-back {
  background-color: #ffffff;
  color: black;
}
.btn-back:hover {
  color: #EF9C23;
}
</style>
