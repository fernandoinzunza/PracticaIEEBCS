<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">Agregar un aula</div>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1"
                >Agrega un nombre para el aula</label
              >
              <input
                v-model="nombre"
                class="form-control"
                name="nombre"
                aria-describedby="emailHelp"
                placeholder="Nombre:"
              />
            </div>
            <button @click="addNewAula" type="button" class="btn btn-primary">
              Agregar
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row card" v-for="a in aulas" :key="a.id">
      <div class="card-header">Numero: {{ a.id }}</div>
      <div class="card-body">
        <div class="row">
          Nombre del aula:
          <p>{{ a.nombre }}</p>
        </div>
      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col-sm-6">
            <button class="btn btn-small bg-green" @click="detalles(a)">
              Agregar PC
            </button>
          </div>
          <div class="col-sm-6">
            <button
              class="btn btn-small btn-primary"
              @click="computadorasLigadas(a)"
            >
              Ver PC's de este aula
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="modal-aula" tabindex="-1" role="dialog">
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
              <tbody v-for="c in computadoras" :key="c.id">
                <tr>
                  <td>{{ c.id }}</td>
                  <td>{{ c.nombre }}</td>

                  <td>
                    <button
                      class="btn btn-small bg-green"
                      @click="agregarComputadora(c)"
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
    <div class="modal" id="modal-computadoras" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Computadoras en este aula</h5>
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
              <tbody v-for="c in computadorasLig" :key="c.id">
                <tr>
                  <td>{{ c.id }}</td>
                  <td>{{ c.nombre }}</td>
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
      aulas: [],
      computadoras: [],
      computadorasLig: [],
      nombre: "",
    };
  },
  created() {
    axios.get("/aulas/getAulas").then((response) => {
      this.aulas = response.data;
    });
    axios.get("/computadores/getComputadores").then((response) => {
      this.computadoras = response.data;
    });
  },
  methods: {
    async listar() {
      const res = await axios.get("/aulas/getAulas");
      this.aulas = res.data;
    },
    async addNewAula() {
      const agr = await axios.post("/aulas/crearAula", { nombre: this.nombre });
      this.listar();
      alert(agr.data["message"]);
    },
    async computadorasLigadas(item) {
      const res = await axios.post("/aulas/computadoras", { id: item.id });
      this.computadorasLig = res.data;
      $("#modal-computadoras").modal("show");
    },
    async agregarComputadora(item)
    {
      $("#modal-aula").attr("data-idPC", item.id);
      var id_aula = $("#modal-aula").attr("data-id");
      console.log(id_aula);
      const res = await axios.post("/aulas/agregarPC", { id: item.id,aula_id:id_aula });
      alert(res.data["message"])
    },
    detalles(item) {
      console.log(this.$vnode.key)
      $("#modal-aula").attr("data-id",item.id);
      $("#modal-aula").modal("show");
    },
  },
};
</script>
