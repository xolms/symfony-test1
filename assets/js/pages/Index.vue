<template>
  <div class="page">
    <div class="page__exit">
      <span @click="$store.commit('logout')">Выход</span>
    </div>
    <div class="page__video">
      <video ref="video" controls autoplay></video>
    </div>
    <div class="page__search">
      <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M6.67004 0.73292C9.91486 0.73292 12.5547 3.19583 12.5547 6.22537C12.5547 9.25491 9.91486 11.7178 6.67004 11.7178C3.42448 11.7178 0.784624 9.25491 0.784624 6.22537C0.784624 3.19583 3.42448 0.73292 6.67004 0.73292ZM11.6476 10.3546C12.6977 9.25354 13.3393 7.8096 13.3393 6.22537C13.3393 2.79276 10.3468 0 6.67004 0C2.9933 0 0 2.79276 0 6.22537C0 9.65798 2.9933 12.4507 6.67004 12.4507C8.36761 12.4507 9.91486 11.8492 11.0925 10.872L14.33 13.8932C14.4077 13.9644 14.5081 14 14.6086 14C14.7083 14 14.8088 13.9644 14.8851 13.8932C15.0383 13.7502 15.0383 13.5189 14.8851 13.3759L11.6476 10.3546Z"
              fill="#4A4A4A"/>
      </svg>
      <input type="search" name="search" v-model="search" placeholder="Найти камеру">
    </div>
    <div class="page__cameras">
      <div
          class="page__camera"
          v-for="video in getCameras"
          :key="video.id"
          @click="activeVideo = video.id"
          :class="video.id === activeVideo ? 'active' : ''"
      >
        {{ video.name }}
      </div>
    </div>
  </div>
</template>

<script>
import Hls from 'hls.js'

export default {
  name: "Index",
  data() {
    return {
      videos: [],
      activeVideo: null,
      hls: null,
      search: ''
    }
  },
  methods: {
    async getVideos() {
      try {
        let data = await this.$axios('/api/video')
        if (data.status === 200) {
          this.videos = data.data
        }
      } catch (e) {
        console.log(e)
      }
    }
  },
  computed: {
    getCameras() {
      if (this.videos) {
        if (!this.search.length) {
          return this.videos
        } else {
          const vm = this
          return this.videos.filter(item => {
            return item.name.search(vm.search) + 1
          })
        }
      }
      return null
    }
  },
  watch: {
    activeVideo(id) {
      const findVideo = this.videos.find(item => {
        return item.id === id
      })
      if (findVideo) {
        const video = this.$refs.video
        if (Hls.isSupported()) {
          this.hls.loadSource(findVideo.link)
          this.hls.attachMedia(video)
          this.hls.on(Hls.Events.MANIFEST_PARSED, function() {
            video.play();
          });
        }
        else if (video.canPlayType('application/vnd.apple.mpegurl')) {
          video.src = findVideo.link
          video.addEventListener('loadedmetadata', function() {
            video.play();
          })
        }
      }

    }
  },
  async mounted() {
    await this.getVideos()
    this.hls = new Hls()
    this.activeVideo = this.videos[0].id
  }
}
</script>

<style scoped lang="scss">
.page {
  &__video {
    position: relative;
    max-width: 1170px;
    width: 100%;
    margin: 0 auto;

    &::after {
      content: '';
      padding-top: 56.25%;
      display: block;
    }

    video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  }

  &__search {
    position: relative;
    max-width: 340px;
    margin: 20px auto 65px;

    svg {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 15px;
    }

    input {
      background: rgba(#AEAEAE, .2);
      border: none;
      border-radius: 8px;
      width: 100%;
      height: 36px;
      line-height: 36px;
      outline: none;
      padding-left: 48px;
      padding-right: 10px;
      font-size: 13px;
      font-weight: 300;
      color: #4A4A4A;

      &::placeholder {
        color: #4A4A4A;
      }
    }
  }

  &__cameras {
    max-width: 335px;
    width: 100%;
    margin: 0 auto;
  }

  &__camera {
    padding: 16px 20px;
    font-size: 17px;
    color: #000;
    cursor: pointer;
    border-bottom: 1px solid rgba(139, 138, 141, 0.2);
    &:first-child {
      border-top: 1px solid rgba(139, 138, 141, 0.2);
    }
    &.active {
      background-color: rgba(#000, .05);
    }
  }
  &__exit {
    margin: 0 auto;
    font-size: 14px;
    font-weight: 400;
    color: #000;
    text-align: right;
    padding-top: 25px;
    padding-bottom: 25px;
    padding-right: 17px;
    max-width: 1170px;
    span {
      cursor: pointer;
    }
  }
}
</style>