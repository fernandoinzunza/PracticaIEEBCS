<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Numero: {{aula.id }}</div>
      <div class="card-body">
        <div class="row">
          Nombre del aula:
          <p>{{ aula.nombre }}</p>
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
  props: ["aula"],
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
