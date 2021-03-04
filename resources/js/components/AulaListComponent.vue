<template>
  <div class="row">
    <div class="col-sm-12">
      <aula-card
        v-for="aula in aulas"
        :key="aula.id"
        :aula="aula"
      ></aula-card>
    </div>
    
  </div>
</template>
<script>
export default {
  data() {
    return {
      aulas: [],
      computadoras:[]
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
    agregarComputadora(selected) {
      axios
        .post("/computadores/asignar", {
          id: $("#modal-aula").attr("data-id"),
          alumno_id: selected.id,
        })
        .then((response) => {
          axios.get("/computadores/getComputadores").then((response) => {
            this.computadoras = response.data;
          });

          $("#modal-aula").modal("hide");
          alert(response.data.message);
          //let items = this.$emit("getData", this.search, this.pageSize);
        });
    },
  },
};
</script>