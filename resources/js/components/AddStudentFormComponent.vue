<template>
  <div class="container">
    <div class="row">
      <p>Instrucciones: Agrega los objetos y despues los relacionas. El reporte solo muestra las computadoras que estan relacionadas a un alumno y a un aula.
        Gracias :)
      </p>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">Agregar un alumno</div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Nombre del alumno</label>
                <input
                  v-model="nombre"
                  class="form-control"
                  name="nombre"
                  aria-describedby="emailHelp"
                  placeholder="Nombre:"
                />
              </div>
              <button
                type="button"
                @click="addNewAlumno"
                class="btn btn-primary"
              >
                Agregar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row card" v-for="alumno in alumnos" :key="alumno.id">
      <div class="card-header">
        Alumno numero: {{ alumno.id }}
      </div>
      <div class="card-body">
        <p>Nombre: {{ alumno.nombre }}</p>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-12 col-md-6">
             <button
            class="btn btn-small bg-green"
            @click="mostrarPcDisponibles(alumno)"
          >
            Asignar computador
          </button>
          </div>
         <div class="col-sm-12 col-md-6">
           <button
            class="btn btn-primary"
            @click="mostrarPcAsignadas(alumno)"
          >
            Ver PCs asignadas
          </button>
         </div>
        </div>
      </div>
    </div>
    <div class="modal" id="modal-alumnosPc" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Computadoras disponibles</h5>
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
                  <th scope="col">Asignar a este alumno</th>
                </tr>
              </thead>
              <tbody v-for="c in computadorasDisp" :key="c.id">
                <tr>
                  <td>{{ c.id }}</td>
                  <td>{{ c.nombre }}</td>
                  <td>
                    <button
                      class="btn btn-small bg-green"
                      @click="asignarPc(c)"
                    >
                      <i class="fa fa-check"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="modal-pcAsignadas" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Computadoras disponibles</h5>
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
                </tr>
              </thead>
              <tbody v-for="c in pcsAsignadas" :key="c.id">
                <tr>
                  <td>{{ c.id }}</td>
                  <td>{{ c.nombre }}</td>

                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["list"],
  data() {
    return {
      alumnos: [],
      computadorasDisp: [],
      pcsAsignadas:[],
      nombre: "",
    };
  },
  created() {
    axios.get("/alumnos/getAlumnos").then((response) => {
      this.alumnos = response.data;
    });
    axios.get("/computadores/getComputadoresDisp").then((response) => {
      this.computadorasDisp = response.data;
      console.log(this.computadorasDisp);
    });
  },
  methods: {
    async addNewAlumno() {
      const res = await axios.post("/alumnos/crearAlumnos", {
        nombre: this.nombre,
      });
      this.listar();
      alert(res.data["message"]);
    },
    async listar() {
      const res = await axios.get("/alumnos/getAlumnos");
      this.alumnos = res.data;
    },
    async listarPcDisp() {
      const res = await axios.get("/computadores/getComputadoresDisp");
      this.computadorasDisp = res.data;
    },
    mostrarPcDisponibles(item) {
      $("#modal-alumnosPc").attr("data-id", item.id);
      $("#modal-alumnosPc").modal("show");
    },
   async  mostrarPcAsignadas(alumno){
      const res = await axios.post("/alumnos/getPcAsignadas",{id:alumno.id});
      this.pcsAsignadas = res.data;
      $("#modal-pcAsignadas").modal('show');

    },
    async asignarPc(item) {
      var id_alumno = $("#modal-alumnosPc").attr("data-id");
      const res = await axios.post("/alumnos/asignarPC", {
        id_pc: item.id,
        alumno_id: id_alumno,
      });
      await this.listar();
      await this.listarPcDisp();
      alert(res.data["message"]);
    },
  },
};
</script>
