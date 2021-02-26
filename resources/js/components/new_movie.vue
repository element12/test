<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Agregar una nueva pelicula</div>

          <div class="card-body">
            <form enctype="multipart/form-data">
              <div class="mb-3">
                <img
                  with="200"
                  height="200"
                  :src="imagen"
                  alt="foto pelicula"
                />
              </div>
              <div class="mb-3">
                <label for="Imagen" class="form-label">Agregar portada</label>
                <input type="file" name="image" @change="getImage" />
              </div>
              <div class="mb-3">
                <label for="TitleInput" class="form-label"
                  >Titulo de la pelicula</label
                >
                <input
                  v-model="movie.title"
                  type="text"
                  class="form-control"
                  id="TitleInput"
                />
              </div>
              <div class="mb-3">
                <label for="DescriptionInput" class="form-label"
                  >Descripcion de la pelicula</label
                >
                <input
                  v-model="movie.description"
                  type="text"
                  class="form-control"
                  id="DescriptionInput"
                />
              </div>
              <div class="mb-3">
                <label for="DescriptionInput" class="form-label"
                  >Duracion de la pelicula</label
                >
                <input
                  v-model="movie.time_duration"
                  type="text"
                  class="form-control"
                  id="DescriptionInput"
                />
              </div>

              <select
                v-model="movie.category"
                class="form-select form-select-sm"
                aria-label=".form-select-sm example"
              >
                <option selected>Categoria</option>
                <option value="1">Accion</option>
                <option value="2">Terror</option>
                <option value="3">Aventura</option>
                <option value="4">Infantil</option>
              </select>

              <div class="mb-3">
                <label for="LinkInput" class="form-label"
                  >Link de Youtube</label
                >
                <input
                  v-model="movie.link_yt"
                  type="text"
                  class="form-control"
                  id="LinkInput"
                />
              </div>
              <div class="mb-3">
                <label for="start">Fecha de estreno:</label>

                <input
                  v-model="movie.premiere_date"
                  type="date"
                  id="start"
                  name="trip-start"
                  value="2021-02-25"
                />
              </div>
              <button @click="guardar()" type="button" class="btn btn-success">
                Guardar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      imgMin: "",
      movie: {
        title: "",
        description: "",
        time_duration: "",
        category: "Accion",
        link_yt: "",
        premiere_date: "",
        view_movie: "1",
        stars: "2",
        image: "",
      },
      movies: [],
      image: "",
    };
  },
  methods: {
    async guardar() {
      const formData = new FormData();
      formData.set("image", this.image);
      const res1 = await axios.post("/img_upload", formData);
      this.movie.image = res1.data;

      const res = await axios.post("/movies/", this.movie);
      console.log(res);
    },
    getImage(e) {
      let file = e.target.files[0];
      console.log(file);
      this.image = file;
      this.changeImage(file);
    },

    changeImage(file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.imgMin = e.target.result;
      };
      reader.readAsDataURL(file);
    },
  },
  computed: {
    imagen() {
      return this.imgMin;
    },
  },

  created() {},
};
</script>