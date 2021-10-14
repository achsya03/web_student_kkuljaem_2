var Shadowing = function(mainId, urlAudioBunyi = null) {
    this.innstyle = {
        "record": "<img src='/assets/img/icon-record.png'  width='50px' height='50px'>",
        "stop": "<img src='/assets/img/icon-stop.png' width='50px' height='50px'>",
        "play": "<img src='/assets/img/icon-play.png' width='50px' height='50px'>",
        "on": "<img src='/assets/img/play-record.png' width='50px' height='50px'>",
        "finish": "<img src='/assets/img/icon-pause.png' width='50px' height='50px'>",
        "off": "<img src='/assets/img/icon-pause.png' width='50px' height='50px'>"
    };
    this.main = document.getElementById(mainId);
    this.btn = this.main.getElementsByTagName("button");
    this.sound = this.main.getElementsByTagName("audio")[0];
    this.audio = this.main.getElementsByTagName("audio")[1];
    this.bsound = this.btn[0];
    this.record = this.btn[2];
    this.play = this.btn[1];
    this.recorder = null;
    this.toggleSou = false;
    this.toggleRec = false;
    this.togglePlay = false;
    this.sound.volume = 1;
    this.bsound.volume = 1;
    this.sound.style.display = "none";
    this.audio.style.display = "none";
    this.play.style.display = "none";
    this.record.innerHTML = this.innstyle.record;
    this.bsound.innerHTML = this.innstyle.play;
    this.play.innerHTML = this.innstyle.on;
    if (urlAudioBunyi != null) this.sound.src = urlAudioBunyi;
    navigator.mediaDevices.getUserMedia({
            audio: true
        })
        .then(stream => {
            this.bsound.addEventListener('click', this.talking);
            this.record.addEventListener('click', this.recording);
            this.play.addEventListener('click', this.playing);
            this.recorder = new MediaRecorder(stream);
            this.recorder.addEventListener('dataavailable', this.onRecordingReady);
            this.sound.addEventListener('pause', this.talking);
            this.audio.addEventListener('pause', this.playing);
        })
    this.talking = () => {
        if (this.toggleSou) {
            this.sound.pause();
            this.toggleSou = false;
            this.bsound.innerHTML = this.innstyle.play;
        } else {
            this.sound.play();
            this.toggleSou = true;
            this.bsound.innerHTML = this.innstyle.stop;
        }
    }
    this.recording = () => {
        if (this.toggleRec) {
            this.toggleRec = false;
            this.record.innerHTML = this.innstyle.record;
            this.recorder.stop();
        } else {
            this.toggleRec = true;
            this.record.innerHTML = this.innstyle.finish;
            this.recorder.start();
        }
    }
    this.playing = () => {
        if (this.togglePlay) {
            this.audio.pause();
            this.togglePlay = false;
            this.play.innerHTML = this.innstyle.on;
        } else {
            this.audio.play();
            this.togglePlay = true;
            this.play.innerHTML = this.innstyle.off;
        }
    }
    this.onRecordingReady = (e) => {
        this.audio.src = URL.createObjectURL(e.data);
        this.play.style.display = "block";
    }
}