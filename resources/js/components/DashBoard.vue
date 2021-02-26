<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <!-- The Modal -->
        <div
          style="overflow-y: scroll"
          class="modal"
          :class="{ mostrar: modal }"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">{{ tituloModal }}</h4>
                <button
                  @click="cerrarModal()"
                  type="button"
                  class="close"
                  data-dismiss="modal"
                >
                  &times;
                </button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="mb-3">
                  <img
                    with="200"
                    height="200"
                    :src="'../../../storage/' + movie.image"
                    alt="foto pelicula"
                  />
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
                <div class="my-4">
                  <label for="stock">Estrellas</label>
                  <input
                    v-model="movie.stars"
                    type="number"
                    class="form-control"
                    id="stock"
                    max="5"
                    min="0"
                    placeholder="Stock del Articulo"
                  />
                </div>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value="accepted"
                  id="flexCheckDefault"
                  v-model="checked"
                />
                <label class="form-check-label" for="flexCheckDefault">
                  ¿Ya la viste?
                </label>
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
              <!-- Modal footer -->
              <div class="modal-footer">
                <button
                  @click="cerrarModal()"
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cancelar
                </button>
                <button
                  @click="guardar()"
                  type="button"
                  class="btn btn-success"
                  data-dismiss="modal"
                >
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="">
          <h1 class="text-center">Lista de peliculas</h1>
        </div>

        <div class="card">
          <div class="card-header">Categoria</div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Caratula</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Ver Intro</th>
                <th scope="col">Calificación</th>
                <th scope="col">Editar</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="mov in movies"
                :key="mov.id"
                v-bind:style="mov.view_movie == true ? 'color:red' : ''"
              >
                <th scope="row">{{ mov.id }}</th>
                <td>
                  <img
                    :src="'../../../storage/' + mov.image"
                    width="150"
                    height="200"
                    class="img-thumbnail"
                    alt=""
                  />
                </td>
                <td>{{ mov.title }}</td>
                <td>{{ mov.description }}</td>
                <td><a :href="mov.link_yt">Ver</a></td>
                <td>
                  <span
                    v-for="i in mov.stars"
                    :key="i"
                    class="fa fa-star checked"
                  ></span>
                </td>
                <td>
                  <button
                    @click="
                      modificar = true;
                      abrirModal(mov);
                    "
                    class="btn btn-warning"
                  >
                    Editar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: [],
      id: 0,
      modificar: true,
      modal: 0,
      tituloModal: "",
      checked: true,
      movie: {
        title: "",
        description: "",
        time_duration: "",
        category: "Accion",
        link_yt: "",
        premiere_date: "",
        view_movie: "1",
        stars: "",
        image: "",
      },
    };
  },
  methods: {
    async list() {
      const mov = await axios.get("movies");
      this.movies = mov.data;
    },

    async guardar() {
      if (this.modificar) {
        const res = await axios.put("/movies/" + this.id, this.movie);
      }
      this.cerrarModal();
      this.list();
    },
    abrirModal(data = {}) {
      this.modal = 1;
      if (this.modificar) {
        this.id = data.id;
        this.tituloModal = "Modificar Articulo";
        this.movie.title = data.title;
        this.movie.description = data.description;
        this.movie.time_duration = data.time_duration;
        this.movie.stars = data.stars;
        this.movie.link_yt = data.link_yt;
        this.movie.premiere_date = data.premiere_date;
        this.movie.image = data.image;
        this.movie.category = data.category;
      }
    },
    cerrarModal() {
      this.modal = 0;
    },
    check(){
        
    },
  },

  created() {
    this.list();
  },
};
</script>
<style>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(75, 56, 143, 0.705);
}
</style>