<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">Registrar un nuevo computador</div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input
                  v-model="nombrePc"
                  class="form-control"
                  name="nombrePc"
                  aria-describedby="emailHelp"
                  placeholder="Nombre:"
                />

              </div>
              <button type="button" @click="newComputer" class="btn btn-primary">Agregar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div
      class="row card"
      v-for="computador in computadores"
      :key="computador.id"
    >
      <div class="card-header">Numero: {{ computador.id }}</div>
      <div class="card-body">
        <div class="row">
          Nombre del PC:
          <p>{{ computador.nombre }}</p>
        </div>
        <div class="row">
          Alumno asignado a este computador:
          <p>{{ computador.alumno_asignado }}</p>
        </div>
      </div>

      <div class="card-footer">
        <div class="row">
          <button
            v-if="computador.alumno_asignado == 'Ninguno'"
            class="btn btn-small bg-green"
            @click="detalles(computador)"
          >
            Asignar alumno
          </button>
          <button
            v-else
            class="btn btn-small bg-green"
            disabled
            @click="detalles(computador)"
          >
            Asignar alumno
          </button>
        </div>
      </div>
    </div>
    <div class="modal" id="modal-Pc" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Numero Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Elegir</th>
                </tr>
              </thead>
              <tbody v-for="a in alumnos" :key="a.id">
                <tr>
                  <td>{{ a.id }}</td>
                  <td>{{ a.nombre }}</td>
                  <td>
                    <button
                      class="btn btn-small bg-green"
                      @click="asignarAlumno(a)"
                    >
                      <i class="fa fa-check"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
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
      nombrePc: "",
      computadores: [],
      alumnos: [],
    };
  },
  created() {
    axios.get("/computadores/getComputadores").then((response) => {
      this.computadores = response.data;
    });
    axios.get("/alumnos/getAlumnos").then((response) => {
      this.alumnos = response.data;
    });
  },
  methods: {
    async listar(){
    const res = await  axios.get("/computadores/getComputadores");
    this.computadores = res.data;
    },
    async newComputer() {
      const res = await axios.post("/computadores/crearPC", {
        nombre: this.nombrePc,})
        this.listar();
      alert(res.data["message"]);
      
      //let items = this.$emit("getData", this.search, this.pageSize);
    },
    detalles(item) {
      $("#modal-Pc").attr("data-id", item.id);
      $("#modal-Pc").modal("show");
    },
    async asignarAlumno(selected) {
      const res = await axios.post("/computadores/asignar", {
        id: $("#modal-Pc").attr("data-id"),
        alumno_id: selected.id,
      });
      await this.listar();
      $("#modal-Pc").modal("hide");
      alert(res.data.message);
      //let items = this.$emit("getData", this.search, this.pageSize);
    },
  },
};
</script>
