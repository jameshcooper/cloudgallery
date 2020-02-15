<template>
  <section id="gallery">
    <section id="introduction" class="jumbotron text-center">
      <b-container>
        <h1 class="jumbotron-heading">Cloud Gallery</h1>
        <p class="lead text-muted">Self-hosted albums on AWS S3</p>
      </b-container>
    </section>
    <section id="gallery">
      <b-container>
        <b-row>
          <b-col>
            <b-nav align="center">
              <b-nav-item
                v-for="(album, index) in gallery"
                :to="album"
                :key="index"
                >{{ album }}</b-nav-item
              >
            </b-nav>
          </b-col>
        </b-row>
      </b-container>
    </section>
    <section id="album" class="bg-primary">
      <b-container>
        <b-row>
          <router-view />
        </b-row>
      </b-container>
    </section>
  </section>
</template>

<script>
import { mapGetters } from "vuex";
import { FETCH_GALLERY } from "../store/actions.type";

export default {
  mounted() {
    Promise.all([this.$store.dispatch(FETCH_GALLERY)]).then(() => {
      if (this.$route.path == "/") {
        this.$router.push(this.gallery[0]);
      }
    });
  },
  computed: {
    ...mapGetters(["gallery"])
  },
  watch: {
    $route(to) {
      if (to.path == "/") {
        this.loadDefaultAlbum();
      }
    }
  },
  methods: {
    loadDefaultAlbum() {
      this.$router.push(this.gallery[0]);
    }
  }
};
</script>

<style>
.jumbotron {
  padding-top: 3rem;
  padding-bottom: 3rem;
  margin-bottom: 0;
}

@media (min-width: 768px) {
  .jumbotron {
    padding-top: 6rem;
    padding-bottom: 6rem;
  }
}

.jumbotron p:last-child {
  margin-bottom: 0;
}

.jumbotron-heading {
  font-weight: 500;
}

.jumbotron .container {
  max-width: 40rem;
}
</style>