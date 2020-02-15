import Vue from "vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faStar, faHeart } from "@fortawesome/free-solid-svg-icons";
import { faGithub } from "@fortawesome/free-brands-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faStar);
library.add(faGithub);
library.add(faHeart);

Vue.component(FontAwesomeIcon.name, FontAwesomeIcon);
