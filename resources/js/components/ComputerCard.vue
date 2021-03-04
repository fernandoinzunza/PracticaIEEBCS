<template>
  <div class="container">
    <div class="card">
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
          <button class="btn btn-small bg-green" @click="detalles()">
            Asignar alumno
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["computador"],
  data() {
    return {
      info: [],
     key : this.$vnode.key 
    };
  },
  methods: {
    detalles() {
      $("#modal-Pc").attr("data-id",this.$vnode.key);
      $("#modal-Pc").modal("show");
    }
    
  }
};
</script>
