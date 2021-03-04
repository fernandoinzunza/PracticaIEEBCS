<template>
  <div class="row">
    <div class="col-sm-12">
      <computer-card
        v-for="computador in lista"
        :key="computador.id"
        :computador="computador"
      ></computer-card>
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
      lista: [],
      alumnos: [],
    };
  },
  created() {
    axios.get("/computadores/getComputadores").then((response) => {
      this.lista = response.data;
    });
    axios.get("/alumnos/getAlumnos").then((response) => {
      this.alumnos = response.data;
    });
  },
  methods: {
    asignarAlumno(selected) {
      axios
        .post("/computadores/asignar", {
          id: $("#modal-Pc").attr("data-id"),
          alumno_id: selected.id,
        })
        .then((response) => {
          axios.get("/computadores/getComputadores").then((response) => {
            this.lista = response.data;
          });
          
          $("#modal-Pc").modal('hide');
          alert(response.data.message);
          //let items = this.$emit("getData", this.search, this.pageSize);
        });
    },
  },
};
</script>