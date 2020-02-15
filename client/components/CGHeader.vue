<template>
  <b-navbar :class="nav_bar">
    <div class="container d-flex justify-content-between">
      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

      <b-navbar-brand to="/">
        <font-awesome-icon
          style="font-size: "
          class="text-success"
          :icon="nav_icon.imdb"
        />
        <span class="ml-1">Cloud Gallery</span>
      </b-navbar-brand>

      <b-collapse
        is-nav
        id="nav_collapse"
        class="navbar-collapse justify-content-end"
      >
        <b-navbar-nav>
          <b-nav-item href="https://github.com/jameshcooper/cloudgallery">
            <font-awesome-icon :icon="nav_icon.github" class="mr-1" />Github
          </b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </div>
  </b-navbar>
</template>

<script>
export default {
  data() {
    return {
      nav_bar: {
        navbar: true,
        "navbar-dark": true,
        "navbar-expand-lg": true,
        "bg-primary": true,
        toggleable: "md"
      },
      nav_icon: {
        imdb: "star",
        github: ["fab", "github"]
      }
    };
  }
};
</script>
